<?php 
  class CategoryModel extends Model {

    // mapped 
    // private $category_name;
    // public function getCategoryName() { return $this->category_name; }
    // public function setCategoryName($category_name) {
    //   $this->category_name = is_string($category_name) ? $category_name : "";
    // }

    // function __construct($category_name = "") {
    //   parent::__construct(CATEGORY_ID_PREFIX);
    //   $this->setCategoryName($category_name);
    // }

    // no-mapped 
    public static function getAllCategories() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_category")
          ->select("id", "category_name", "created_at")
          ->where("is_deleted", 0), 
        "is_fetch" => "categories"
      ]]);
      return $res["categories"];
    }
  }
?>