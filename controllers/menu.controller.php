<?php 
  class MenuController extends Controller {

    function __construct() {
      parent::__construct();
    }

    public function init() {

      parent::view(
        "Menu",
        __ROOT__ . "views/menu/menu.php", [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__, 
          "categories" => CategoryModel::getAllCategories(),
          "products" => ProductModel::getAllProducts(),
          "addons" => AddonModel::getAllAddonsAndOptions()
        ]
      );
    }

    public function showProductsByCategory($category_id) {
      parent::view(
        "Menu", 
        __ROOT__ . "views/menu/menu.php", [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__,
          "categories" => CategoryModel::getAllCategories(), 
          "products" => ProductModel::getProductsByCategory($category_id),
          "addons" => AddonModel::getAllAddonsAndOptions()
        ]
      );
    }
  }
?>