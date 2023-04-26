<?php 
  class MenuController extends Controller {

    function __construct() {
      parent::__construct();
    }

    public function init(Request $req, $params = []) {
      $this->getAllMenu($req, $params);
    }

    public function getAllMenu(Request $req, $params = []) {
      try {
        $body_response = [
          "categories" => CategoryModel::selectAllCategories(),
          "products" => ProductModel::selectAllProducts(), 
          "addons" => AddonModel::selectAllAddonsAndOptions(),
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ];
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        parent::view(
          __ROOT__, 
          "Pizza House Việt Nam - Thực đơn", 
          "menu/menu.view.php", 
          "menu/menu.style.css", 
          "bundle.view.php", 
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getProductsByCategory(Request $req, $params = []) {
      try {
        $body_response = [
          "categories" => CategoryModel::selectAllCategories(),
          "products" => ProductModel::selectProductsByCategory($params["category_id"]), 
          "addons" => AddonModel::selectAllAddonsAndOptions(),
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ];  
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        parent::view(
          __ROOT__, 
          "Pizza House Việt Nam - Thực đơn",
          "menu/menu.view.php", 
          "menu/menu.style.css", 
          "bundle.view.php", 
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
    
    public function getProductById(Request $req, $params = []) {
      try {
        $body_response = [
          "product" => ProductModel::selectProductById($params["product_id"]), 
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ];  
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        parent::view(
          __ROOT__, 
          "Pizza House Việt Nam - Chi tiết sản phẩm",
          "product-detail/product-detail2.view.php", 
          "product-detail/product-detail.style.css", 
          "bundle.view.php", 
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>