<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller; 
  // use PZHouse\Core\Request; 
  // use PZHouse\Core\Response; 
  // use PZHouse\Models\CategoryModel; 
  // use PZHouse\Models\ProductModel;
  // use PZHouse\Models\AddonModel;
  // use PZHouse\Exceptions\InternalErrorException;

  class MenuController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllMenu($req, $params);
    }

    public function getAllMenu(Request $req, $params = []) {
      try {
        $body_response = [
          "categories" => CategoryModel::selectAllCategories(),
          "products" => ProductModel::selectAllProducts(), 
          "addons" => AddonModel::selectAllAddonsAndOptions()
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

    public function getAllMenuByCategory(Request $req, $params = []) {
      try {
        $body_response = [
          "categories" => CategoryModel::selectAllCategories(),
          "products" => ProductModel::selectProductsByCategory($params["category_id"]), 
          "addons" => AddonModel::selectAllAddonsAndOptions()
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

    public function getAllCategories(Request $req, $params = []) {
      try {
        $categories = CategoryModel::selectAllCategories(); 
        if ($categories === false) throw new InternalErrorException(); 
        return (new Response($categories))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getProductsByCategory(Request $req, $params = []) {
      try {
        $products = ProductModel::selectProductsByCategory($params["category_id"]); 
        if ($products === false) throw new InternalErrorException();
        return (new Response($products))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
    
    public function getProductById(Request $req, $params = []) {
      try {
        $product = ProductModel::selectProductById($params["product_id"]); 
        if ($product === false) throw new InternalErrorException(); 
        $body_response = [ "product" => $product ];
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        $product_name = $product["product_name"] ?? "";
        parent::view(
          __ROOT__, 
          [
            "title" => $product_name ?? "", 
            "path" =>  ["Trang chủ", "Thực đơn", $product_name]
          ],
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