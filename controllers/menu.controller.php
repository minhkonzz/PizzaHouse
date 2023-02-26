<?php 
  class MenuController extends Controller {
 
    function __construct() {
      $this->init();
    }

    private function init() {
      parent::renderView(
        "Menu",
        "./views/menu/menu1.php", [
          "categories" => CategoryModel::getAllCategories(),
          "products" => ProductModel::getAllProducts()
        ]
      );
    }
  }
?>