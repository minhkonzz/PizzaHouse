<?php
  class ProductController extends Controller {
    
    function __contruct() {
      parent::__construct();
    }

    public function init(Request $req = null, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Sản phẩm",
        "product-detail/product-detail2.php",
        "product-detail/product-detail.style.css", 
        "bundle.view.php",
        new Response([
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ])
      );
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