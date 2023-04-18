<?php 
  class OrderController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllOrders();
    }

    public function getAllOrders(Request $req, $params = []) {
      try {
        $orders = OrderModel::selectAllOrders();
        if (parent::isJsonOnly($req, $orders)) return (new Response($orders))->withJson();
        parent::view(
          ROOT_ADMIN, 
          "Pizza House Việt Nam - Quản lý đặt hàng", 
          "orders/orders.view.php", 
          "orders/orders.style.css", 
          "bundle.view.php", 
          new Response(["orders" => $orders])
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getOrderById(Request $req, $params = []) {
      try {
        $order = OrderModel::selectOrderById($params["order_id"]); 
        if (parent::isJsonOnly($req, $order)) return (new Response($order))->withJson(); 
        parent::view(
          ROOT_ADMIN, 
          "Pizza House Việt Nam - Đơn hàng", 
          "orders/order.view.php", 
          "orders/order.style.css", 
          "bundle.view.php",
          new Response(["order" => $order])
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>