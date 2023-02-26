<?php 
  class MenuController extends Controller {

    public function init() {
      parent::renderView(
        "Menu",
        "./views/menu/menu1.php", [
          "categories" => CategoryModel::getAllCategories(),
          "products" => ProductModel::getAllProducts()
        ]
      );
    }

    public function danhmuc($category_id) {
      parent::renderView(
        "Menu", 
        "./views/menu/menu1.php", [
          "categories" => CategoryModel::getAllCategories(),
          "products" => ProductModel::getProductsByCategory($category_id)
        ]
      );
    }
  }
?>