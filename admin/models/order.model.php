<?php 
  class OrderModel extends Model {
    public static function selectAllOrders() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_order")
          ->select("tbl_order.id as order_id", "receive_address", "total", "name", "order_state", "tbl_order.created_at as created_at")
          ->join("tbl_customer", "tbl_customer.id", "=", "tbl_order.customer_id")
          ->join("tbl_order_state", "tbl_order_state.id", "=", "tbl_order.order_state_id"), 
        "is_fetch" => "orders"
      ]]);
      return $res["orders"];
    }

    public static function selectAllOrderStates() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_order_state")
          ->select("id", "order_state"), 
        "is_fetch" => "order_states"
      ]]);
      return $res["order_states"];
    }

    public static function selectOrderById($id) {}
  }
?>