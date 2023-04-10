<?php 
  class MenuController extends Controller {

    function __construct() {
      parent::__construct();
    }

    public function init(Request $request = null, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Thực đơn",
        "menu/menu.view.php", 
        "menu/menu.style.css",
        "bundle.view.php",
        new Response([
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__, 
          "categories" => CategoryModel::getAllCategories(),
          "products" => ProductModel::getAllProducts(),
          "addons" => AddonModel::getAllAddonsAndOptions()
        ])
      );
    }

    // $category_id 
    // public function showProductsByCategory(Request $request = null, $params = []) {
    //   $category_id = 0;
    //   parent::view(
    //     "Menu", 
    //     "views/menu/menu.php", 
    //     (new Response ())->withJson([
    //       "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__,
    //       "categories" => CategoryModel::getAllCategories(), 
    //       "products" => ProductModel::getProductsByCategory($category_id),
    //       "addons" => AddonModel::getAllAddonsAndOptions()
    //     ])
    //   );
    // }
  }
?>