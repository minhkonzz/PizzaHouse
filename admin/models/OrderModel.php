<?php 

  // namespace PZHouse\Admin\Models;

  class OrderModel extends Model {
    public static function selectAllOrders() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_order")
          ->select(
            "tbl_order.id as order_id", 
            "receive_address", 
            "total", 
            "name", 
            "order_state", 
            "tbl_order.created_at as created_at"
          )
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

    public static function selectOrderById($id) {
      $raw_order = parent::performQuery([
          [
          "query_str" => Database::table("tbl_order")
            ->select(
              "tbl_order.id as order_id", 
              "order_state_id", 
              "tbl_customer.id as customer_id", 
              "name", 
              "receive_address", 
              "receiver_name", 
              "receiver_phone", 
              "buyer_name", 
              "buyer_phone", 
              "buyer_email", 
              "district", 
              "ward",
              "city",
              "note",
              "total"
            )
            ->join("tbl_customer", "tbl_order.customer_id", "=", "tbl_customer.id")
            ->join("tbl_order_state", "tbl_order.order_state_id", "=", "tbl_order_state.id")
            ->where("tbl_order.id", ":id"),
          "is_fetch" => "order",
          "params" => [ "id" => $id ]
        ], 
        [
          "query_str" => Database::table("tbl_order_item")
            ->select(
              "tbl_order_item.id as order_item_id",
              "order_product_name", 
              "order_product_image", 
              "order_product_category", 
              "order_product_price", 
              "quantity", 
              "addon_val"
            )
            ->join("tbl_order", "tbl_order.id", "=", "tbl_order_item.order_id")
            ->join("tbl_order_item_option", "tbl_order_item.id", "=", "tbl_order_item_option.order_item_id")
            ->where("tbl_order.id", ":order_id"),
          "is_fetch" => "order_items", 
          "params" => ["order_id" => $id]
        ]  
      ]);
      $order_items = []; 
      foreach ($raw_order["order_items"] as $order_items_option) {
        list(
          "order_item_id" => $order_item_id,  
          "order_product_name" => $order_product_name, 
          "order_product_image" => $order_product_image, 
          "order_product_category" => $order_product_category,
          "order_product_price" => $order_product_price,
          "quantity" => $quantity, 
          "addon_val" => $addon_val
        ) = $order_items_option;
        if (!isset($order_items[$order_item_id])) {
          $order_items[$order_item_id]["order_product_name"] = $order_product_name; 
          $order_items[$order_item_id]["order_product_image"] = $order_product_image; 
          $order_items[$order_item_id]["order_product_category"] = $order_product_category;  
          $order_items[$order_item_id]["order_product_price"] = $order_product_price;
          $order_items[$order_item_id]["quantity"] = $quantity;
          $order_items[$order_item_id]["addon_vals"] = [ $addon_val ];
          continue; 
        }
        $order_items[$order_item_id]["addon_vals"][] = $addon_val;
      }
      return [
        "meta" => $raw_order["order"][0], 
        "items" => $order_items
      ];
    }
  }
?>















