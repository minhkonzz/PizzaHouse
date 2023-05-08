<?php 

  // namespace PZHouse\Admin\Models;

  class ProductModel extends Model {
    public static function selectAllProducts() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_product")
          ->select("tbl_product.id as product_id", "product_name", "tbl_category.id as category_id", "category_name", "price", "image", "currency", "tbl_product.created_at as product_created_at")
          ->join("tbl_category", "tbl_product.category_id", "=", "tbl_category.id"),
        "is_fetch" => "products"
      ]]);
      return $res["products"];
    }

    public static function selectProductsByCategory($category_id) { 
      $query_res = parent::performQuery([[
        "query_str" => Database::table("tbl_product")->select()->where("category_id", ":category_id"), 
        "is_fetch" => "products", 
        "params" => [ "category_id" => $category_id ]
      ]]);
      return $query_res["products"];
    }

    public static function selectProductById($id) {
      $return_result = [];
      $res = parent::performQuery([
        [
          "query_str" => Database::table("tbl_product")
            ->select("product_name", "category_name", "price", "image", "description", "currency", "tbl_product.id as product_id", "tbl_category.id as category_id")
            ->join("tbl_category", "tbl_product.category_id", "=", "tbl_category.id")
            ->where("tbl_product.id", ":product_id"),
          "is_fetch" => "product_ov",
          "params" => [ "product_id" => $id ]
        ],
        [
          "query_str" => Database::table("tbl_addon_value")
            ->select("tbl_addon_value.id as addon_val_id", "tbl_addon.id as addon_id", "addon_name", "addon_val", "addon_val_price")
            ->join("tbl_addon", "tbl_addon.id", "=", "tbl_addon_value.addon_id")
            ->join("tbl_product_addon_value", "tbl_addon_value.id", "=", "tbl_product_addon_value.addon_value_id")
            ->where("tbl_product_addon_value.product_id", ":product_id"), 
          "is_fetch" => "product_addons",
          "params" => [ "product_id" => $id ]
        ]
      ]);
      list(
        "product_id" => $product_id,
        "product_name" => $product_name, 
        "category_id" => $category_id,
        "category_name" => $category_name,
        "price" => $price, 
        "image" => $image, 
        "description" => $description, 
        "currency" => $currency 
      ) = $res["product_ov"][0];
      $return_result["id"] = $product_id;
      $return_result["product_name"] = $product_name;
      $return_result["category_id"] = $category_id; 
      $return_result["category_name"] = $category_name;
      $return_result["price"] = $price; 
      $return_result["image"] = $image; 
      $return_result["description"] = $description; 
      $return_result["currency"] = $currency; 
      $return_result["addons"] = array();
      foreach ($res["product_addons"] as $addon_option) {
        list(
          "addon_id" => $addon_id,
          "addon_name" => $addon_name, 
          "addon_val_id" => $addon_val_id,
          "addon_val" => $addon_val, 
          "addon_val_price" => $addon_val_price
        ) = $addon_option;
        if (!isset($return_result["addons"][$addon_id])) {
          $return_result["addons"][$addon_id]["addon_name"] = $addon_name; 
          $return_result["addons"][$addon_id]["addon_options"][$addon_val_id] = [
            "addon_val" => $addon_val, 
            "addon_val_price" => $addon_val_price
          ];
          continue;
        }
        $return_result["addons"][$addon_id]["addon_options"][$addon_val_id] = [
          "addon_val" => $addon_val, 
          "addon_val_price" => $addon_val_price
        ];
      }
      return $return_result;
    }

    public static function addProduct($new_product) {
      return parent::performQuery(array_merge(
        [[
          "query_str" => "INSERT INTO tbl_product (id, product_name, category_id, price, description, image) VALUES (:id, :product_name, :category_id, :price, :description, :image)", 
          "params" => [
            "id" => $new_product->getId(), 
            "product_name" => $new_product->getName(), 
            "category_id" => $new_product->getCategoryId(), 
            "price" => $new_product->getPrice(),
            "description" => $new_product->getDescription(), 
            "image" => $new_product->getImage()
          ]
        ]], 
        array_map(fn($e) => [
          "query_str" => "INSERT INTO tbl_product_addon_value VALUES (:addon_value_id, :product_id)", 
          "params" => [
            "addon_value_id" => $e, 
            "product_id" => $new_product->getId()
          ]
        ], $new_product->getAddonOptionIds())
      ));
    }

    public static function updateProductById($updated_product) {
      $addon_options_change = $updated_product["addon_options_change"]; 
      unset($updated_product["addon_options_change"]);
      $queries = [];
      if (count($updated_product) > 0) {
        $queries[] = [
          "query_str" => "UPDATE tbl_product SET " . implode(", ", array_map(fn($e) => "$e = :$e", array_keys($updated_product))) . " WHERE id = :id",
          "params" => $updated_product
        ];
      } 
      return parent::performQuery(
        array_merge($queries, array_map(function($e) {
          list("addon_option_id" => $addon_option_id, "status" => $status) = $e;
          switch ($status) {
            case "ADD": 
              return [
                "query_str" => "INSERT INTO tbl_product_addon_value VALUES (:addon_option_id, :product_id)",
                "params" => [
                  "addon_option_id" => $addon_option_id, 
                  "product_id" => $updated_product["id"]
                ] 
              ];
            case "DELETE":
              return [
                "query_str" => "DELETE FROM tbl_product_addon_value WHERE addon_value_id = :addon_value_id AND product_id = :product_id",
                "params" => [
                  "addon_value_id" => $addon_option_id, 
                  "product_id" => $updated_product["id"]
                ] 
              ];
          }
        }, $addon_options_change))
      );
    }

    public static function deleteProductById($id) {
      return parent::performQuery([[
        "query_str" => "DELETE FROM tbl_product WHERE id = :id", 
        "params" => [ "id" => $id ]
      ]]);
    }
  }
?>