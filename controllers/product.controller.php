<?php
  require_once "./models/product.model.php";
  
  class ProductController extends Controller {
    
    function __contruct() {
      parent::__construct();
    }

    // params: $product_id
    // public function showProductDetail(Request $request = null, $params = []) {
    //   parent::view(
    //     "Product - " . $product_id, 
    //     "views/product-detail/product-detail1.php",
    //     (new Response())->withJson([ 
    //       "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__,
    //       "product" => ProductModel::getProductDetail($product_id)
    //     ])
    //   );
    // }
  }
?>