<?php 

  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Request; 
  // use PZHouse\Core\Response; 

  class ServiceController extends Controller {

    public function init(Request $req, $params = []) {
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