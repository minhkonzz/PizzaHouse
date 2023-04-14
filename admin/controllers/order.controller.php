<?php 
  class OrderController extends Controller {
    public function init(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN, 
        "Pizza House Việt Nam - Đơn hàng", 
        "orders/orders.view.php", 
        "orders/orders.style.css", 
        "bundle.view.php", 
        new Response([])
      );
    }

    public function showOrderDetail(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN, 
        "Pizza House Việt Nam - Đơn hàng", 
        "orders/order.view.php", 
        "orders/order.style.css", 
        "bundle.view.php",
        new Response([])
      );
    }
  }
?>