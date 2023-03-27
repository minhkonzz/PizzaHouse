<?php

  require_once "./models/product.model.php";

  class ProductController extends Controller {

    function __contruct() {
      parent::__construct();
    }

    public function showProductDetail($product_id) {
      parent::view(
        "Product - " . $product_id, 
        __ROOT__ . "views/product-detail/product-detail1.php", [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__,
          "product" => ProductModel::getProductDetail($product_id)
        ]
      );
    }
  }
?>