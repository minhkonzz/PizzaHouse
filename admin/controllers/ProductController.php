<?php 
  // namespace PZHouse\Admin\Controllers;

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
          ["title" => "Quản lý sản phẩm"],
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
        list(
          "product_id" => $product_id, 
          "product_name" => $product_name, 
          "product_image" => $product_image, 
          "product_price" => $product_price,
          "product_category" => $category_id, 
          "product_description" => $product_description,
          "addon_options" => $addon_options 
        ) = $req->getPayloads();
        $new_product = new Product($product_name, $product_image, $product_price, $category_id, $product_description, $addon_options, $product_id);
        if (!ProductModel::addProduct($new_product)) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function updateProductById(Request $req, $params = []) {
      try {
        if (!ProductModel::updateProductById($req->getPayloads())) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function deleteProductById(Request $req, $params = []) {
      try {
        if (!ProductModel::deleteProductById($params["product_id"])) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>