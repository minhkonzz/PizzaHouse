<?php 
  class ProductModel extends Model {

    // mapped
    private $category_id;
    public function getCategoryId() { return $this->category_id; }
    public function setCategoryId($category_id) {
      $this->category_id = is_string($category_id) ? $category_id : "";
    }
    
    private $product_name; 
    public function getProductName() { return $this->product_name; }
    public function setProductName($product_name) {
      $this->product_name = is_string($product_name) ? $product_name : "";
    }

    private $price;
    public function getPrice() { return $this->price; }
    public function setPrice($price) {
      $this->price = is_numeric($price) ? $price : 0; 
    } 

    private $description; 
    public function getDescription() { return $this->description; }
    public function setDescription($description) {
      $this->description = is_string($description) ? $description : "";
    }

    function __construct($category_id, $product_name, $price, $description) {
      parent::__construct(PRODUCT_ID_PREFIX);
      $this->setCategoryId($category_id);
      $this->setProductName($product_name);
      $this->setPrice($price);
      $this->setDescription($description);
    }

    // no-mapped
    public static function getAllProducts() {
      $query_str = Database::table("tbl_product")->select();
      $res = parent::performQuery([[
        "query_str" => $query_str, 
        "is_fetch" => "products"
      ]]); 
      return $res["products"];
    }  

    public static function getProductsByCategory($category_id) { 
      $query_res = parent::performQuery([[
        "query_str" => Database::table("tbl_product")->select()->where("category_id", ":category_id"), 
        "is_fetch" => "products", 
        "params" => [ "category_id" => $category_id ]
      ]]);
      return $query_res["products"];
    }

    public static function getProductDetail($product_id) {
      $return_result = [];
      $res = parent::performQuery([
        [
          "query_str" => Database::table("tbl_product")
            ->select("product_name", "category_name", "price", "image", "description", "currency", "tbl_product.id as product_id")
            ->join("tbl_category", "tbl_product.category_id", "=", "tbl_category.id")
            ->where("tbl_product.id", ":product_id"),
          "is_fetch" => "product_ov",
          "params" => [ "product_id" => $product_id ]
        ],
        [
          "query_str" => Database::table("tbl_addon_value")
            ->select("tbl_addon_value.id as addon_val_id", "tbl_addon.id as addon_id", "addon_name", "addon_val", "addon_val_price")
            ->join("tbl_addon", "tbl_addon.id", "=", "tbl_addon_value.addon_id")
            ->join("tbl_product_addon_value", "tbl_addon_value.id", "=", "tbl_product_addon_value.addon_value_id")
            ->where("tbl_product_addon_value.product_id", ":product_id"), 
          "is_fetch" => "product_addons",
          "params" => [ "product_id" => $product_id ]
        ]
      ]);
      list(
        "product_id" => $id,
        "product_name" => $product_name, 
        "category_name" => $category_name,
        "price" => $price, 
        "image" => $image, 
        "description" => $description, 
        "currency" => $currency 
      ) = $res["product_ov"][0];
      $return_result["id"] = $id;
      $return_result["product_name"] = $product_name; 
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
  }
?>