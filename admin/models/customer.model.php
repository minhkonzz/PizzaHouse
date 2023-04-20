<?php 
  class CustomerModel extends Model {
    public static function selectAllCustomers() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_customer")
          ->select("tbl_customer.id as customer_id", "name", "count(tbl_order.customer_id) as total_order", "phone", "email")
          ->join("tbl_order", "tbl_customer.id", "=", "tbl_order.customer_id", "LEFT")
          ->groupBy("tbl_customer.id"), 
        "is_fetch" => "customers"
      ]]);
      return $res["customers"];
    }

    public static function selectCustomerById($id) {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_customer")
          ->select("tbl_customer.id as customer_id", "usr", "name", "count(tbl_order.customer_id) as total_order", "phone", "email", "tbl_customer.created_at as created_at")
          ->join("tbl_order", "tbl_customer.id", "=", "tbl_order.customer_id", "LEFT")
          ->where("tbl_customer.id", ":id")
          ->groupBy("tbl_customer.id"), 
        "is_fetch" => "customer",
        "params" => [ "id" => $id ]
      ]]);
      return $res["customer"];
    }
  }
?>