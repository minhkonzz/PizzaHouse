<?php 
  class CategoryModel extends Model {

    public static function selectAllCategories() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_category")
          ->select("id", "category_name", "created_at")
          ->where("is_deleted", 0), 
        "is_fetch" => "categories"
      ]]);
      return $res["categories"];
    }

    // public static function addCategory($category) {
    //   $query_str = "INSERT INTO tbl_category (id, category_name) VALUES (:id, :category_name)"; 
    //   return parent::performQuery([[
    //     "query_str" => $query_str, 
    //     "params" => [
    //       "id" => $category->getId(), 
    //       "category_name" => $category->getCategoryName()
    //     ]
    //   ]]);
    // }

    // public static function selectCategoryById($id) {
    //   $query_str = Database::table("tbl_category")
    //     ->select("id", "category_name")
    //     ->where("id", ":id")
    //     ->where("is_deleted", 0);
    //   $res = parent::performQuery([[
    //     "query_str" => $query_str, 
    //     "is_fetch" => "category", 
    //     "params" => [ "id" => $id ]
    //   ]]);
    //   return $res["category"][0];
    // }

    // public static function updateCategoryById($category) {
    //   return parent::performQuery([[
    //     "query_str" => "UPDATE tbl_category SET category_name = :category_name WHERE id = :id", 
    //     "params" => [
    //       "id" => $category->getId(), 
    //       "category_name" => $category->getCategoryName()
    //     ]
    //   ]]);
    // } 

    // public static function deleteCategoryById($id) {
    //   return parent::performQuery([[
    //     "query_str" => "UPDATE tbl_category SET is_deleted = 1 WHERE id = :id", 
    //     "params" => [ "id" => $id ]
    //   ]]);
    // }
  }
?>