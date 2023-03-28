<?php 
  class HomeController extends Controller {

    function __construct() {
      parent::__construct();
    }

    public function init(Request $request = null, $params = []) {
      parent::view(
        "Home", 
        __ROOT__ . "views/home/home.php",
        (new Response())->withJson([
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ])
      );
    }
  }
?>