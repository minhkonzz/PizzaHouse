<?php 
  class ProductController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllProducts($req, $params);
    }

    public function getAllProducts(Request $req, $params = []) {
      try {
        $products = ProductModel::selectAllProducts(); 
        if (parent::isJsonOnly($req, $products)) return (new Response($products))->withJson();
        parent::view(
          ROOT_ADMIN,
          "Pizza House VietNam - Quản lý sản phẩm",
          "catalog/products/products.view.php",
          "catalog/products/products.style.css",
          "bundle.view.php",
          new Response(["products" => $products])
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getProductById(Request $req, $params = []) {
      try {
        $product = ProductModel::selectProductById($params["product_id"]);
        if (parent::isJsonOnly($req, $product)) return (new Response($product))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }      
    }

    public function createNewProduct(Request $req, $params = []) {
      try {

      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function updateProductById(Request $req, $params = []) {
      try {

      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function deleteProductById(Request $req, $params = []) {
      try {

      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>