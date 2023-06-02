<?php 
  class ProductController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllProducts($req, $params);
    }

    public function getAllProducts(Request $req, array $params = []) {
      try {
        $payloads = $req->getPayloads(); 
        $total_products = ProductModel::selectTotalProducts(); 
        list("total_pages" => $total_pages, "limit" => $limit, "page" => $page) = parent::paging($payloads, $total_products); 
        $body_response = [
           "products" => ProductModel::selectAllProducts(($page - 1) * $limit, $limit), 
           "current_page" => $page, 
           "total_pages" => $total_pages
        ]; 
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        parent::view(
          ROOT_ADMIN,
          ["title" => "Quản lý sản phẩm"],
          "catalog/products/products1.view.php",
          "catalog/products/products.style.css",
          "bundle.view.php",
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getProductById(Request $req, array $params = []) {
      try {
        $product = ProductModel::selectProductById($params["product_id"]);
        return (new Response($product))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }      
    }

    public function createNewProduct(Request $req, array $params = []) {
      try {
        list(
          "name" => $name, 
          "image" => $image, 
          "price" => $price,
          "category" => $category_id, 
          "description" => $description,
          "addon_options" => $addon_options 
        ) = $req->getPayloads();
        $new_product = new Product($name, $image, $price, $category_id, $description, $addon_options);
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