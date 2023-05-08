<?php 
  // namespace PZHouse\Models;

  class CategoryModel extends Model {

    public static function selectAllCategories() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_category")
          ->select("id", "category_name", "created_at"),
          // ->where("is_deleted", 0), 
        "is_fetch" => "categories"
      ]]);
      return $res["categories"];
    }
  }
?>