<?php 
  class ServiceController extends Controller {
    function __construct() {
      parent::__construct();
    }

    public function init(Request $request = null, $params = []) {
      parent::view(
        "PizzaHouse VietNam - Dịch vụ", 
        "views/services/services.view.php", 
        new Response(200, [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ])
      );
    }
  }
?>