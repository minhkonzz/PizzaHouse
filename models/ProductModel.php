<?php 

  // namespace PZHouse\Models;

  class ProductModel extends Model {

    // no-mapped
    public static function selectAllProducts() {
      $query_str = Database::table("tbl_product")->select();
      $res = parent::performQuery([[
        "query_str" => $query_str, 
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
            ->select("tbl_addon_value.id as addon_val_id", "tbl_addon.id as addon_id", "apply_product_price", "addon_name", "addon_val", "addon_val_price")
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
          "apply_product_price" => $apply_product_price,
          "addon_val_id" => $addon_val_id,
          "addon_val" => $addon_val, 
          "addon_val_price" => $addon_val_price
        ) = $addon_option;
        if (!isset($return_result["addons"][$addon_id])) {
          $return_result["addons"][$addon_id]["addon_name"] = $addon_name; 
          $return_result["addons"][$addon_id]["apply_product_price"] = $apply_product_price;
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
  }
?>