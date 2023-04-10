<?php 
  class HomeController extends Controller {

    function __construct() {
      parent::__construct();
    }

    public function init(Request $req = null, $params = []) {
      parent::view(
        __ROOT__,
        "Pizza House Việt Nam - Trang chủ", 
        "home/home.view.php",
        "", 
        "bundle.view.php",
        new Response([
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ])
      );
    }
  }
?>