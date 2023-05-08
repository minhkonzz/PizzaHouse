<?php 
  // namespace PZHouse\Admin\Controllers;

  class OrderController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllOrders($req, $params);
    }

    public function getAllOrders(Request $req, $params = []) {
      try {
        $body_response = [
          "orders" => OrderModel::selectAllOrders(),
          "order_states" => OrderModel::selectAllOrderStates()
        ];
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        parent::view(
          ROOT_ADMIN, 
          "Pizza House Việt Nam - Quản lý đặt hàng", 
          "orders/orders.view.php", 
          "orders/orders.style.css", 
          "bundle.view.php", 
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getOrderById(Request $req, $params = []) {
      try {
        $body_response = [
          "order" => OrderModel::selectOrderById($params["order_id"]), 
          "order_states" => OrderModel::selectAllOrderStates()
        ];
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson(); 
        parent::view(
          ROOT_ADMIN, 
          "Pizza House Việt Nam - Đơn hàng", 
          "orders/order.view.php", 
          "orders/order.style.css", 
          "bundle.view.php",
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>