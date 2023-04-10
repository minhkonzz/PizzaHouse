<?php 
  class ServiceController extends Controller {
    function __construct() {
      parent::__construct();
    }

    public function init(Request $req = null, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Dịch vụ", 
        "services/services.view.php",
        "services/services.style.css",
        "bundle.view.php", 
        new Response([
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ])
      );
    }
  }
?>