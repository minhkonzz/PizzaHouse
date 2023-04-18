<?php 
  class CustomerController extends Controller {
    public function init(Request $req, $params = []) {
      parent::view(
        ROOT_ADMIN, 
        "Pizza House Việt Nam - Quản lý khách hàng", 
        "customers/customers.view.php",
        "customers/customers.style.css",
        "bundle.view.php",
        new Response([])
      );
    }
  }
?>