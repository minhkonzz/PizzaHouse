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
      $query_str = Database::table("tbl_product")->selectAll();
      return parent::perform($query_str, true);
    }  
  }
?>