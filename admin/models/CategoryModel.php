<?php 

  // namespace PZHouse\Admin\Models;

  class CategoryModel extends Model {
    public static function selectAllCategories() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_category")
          ->select(
            "tbl_category.id as category_id", 
            "category_name", 
            "tbl_category.created_at as created_at", 
            "ifnull(count(tbl_product.id), 0) as total_products", 
          )
          ->join("tbl_product", "tbl_category.id", "=", "tbl_product.category_id", "LEFT")
          ->groupBy("tbl_category.id"),
        "is_fetch" => "categories"
      ]]);
      return $res["categories"];
    }

    public static function addCategory($category) {
      $query_str = "INSERT INTO tbl_category (id, category_name) VALUES (:id, :category_name)"; 
      return parent::performQuery([[
        "query_str" => $query_str, 
        "params" => [
          "id" => $category->getId(), 
          "category_name" => $category->getCategoryName()
        ]
      ]]);
    }

    public static function selectCategoryById($id) {
      $query_str = Database::table("tbl_category")
        ->select("id", "category_name")
        ->where("id", ":id");
      $res = parent::performQuery([[
        "query_str" => $query_str, 
        "is_fetch" => "category", 
        "params" => [ "id" => $id ]
      ]]);
      return $res["category"][0];
    }

    public static function updateCategoryById($category) {
      return parent::performQuery([[
        "query_str" => "UPDATE tbl_category SET category_name = :category_name WHERE id = :id", 
        "params" => [
          "id" => $category->getId(), 
          "category_name" => $category->getCategoryName()
        ]
      ]]);
    } 

    public static function deleteCategoryById($id) {
      return parent::performQuery([[
        "query_str" => "UPDATE tbl_category SET is_deleted = 1 WHERE id = :id", 
        "params" => [ "id" => $id ]
      ]]);
    }

    public static function selectTotalCategories() {
       $res = parent::performQuery([[
          "query_str" => "SELECT COUNT(*) as total_records FROM tbl_category", 
          "is_fetch" => "count"
       ]]);
       return $res["count"][0]["total_records"];
    }

    public static function selectCategoriesWithLimit($start_index, $max_records) {
      return parent::fetchRecordsWithLimit(
        Database::table("tbl_category")
          ->select(
            "tbl_category.id as category_id", 
            "category_name", 
            "tbl_category.created_at as created_at", 
            "ifnull(count(tbl_product.id), 0) as total_products", 
          )
          ->join("tbl_product", "tbl_category.id", "=", "tbl_product.category_id", "LEFT")
          ->groupBy("tbl_category.id"), 
        $start_index, 
        $max_records
      );
    }
  }
?>