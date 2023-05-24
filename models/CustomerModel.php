<?php 
  // namespace PZHouse\Models;
  
  class CustomerModel extends Model {

    public static function selectCustomerByEmail($email) {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_customer")
          ->select("id", "name", "usr", "address", "email", "phone", "password")
          ->where("email", ":email"), 
        "is_fetch" => "customer", 
        "params" => [ "email" => $email ]
      ]]);
      return $res["customer"][0] ?? false;
    }

    public static function createCustomer($new_customer) {
      return parent::performQuery([[
        "query_str" => "INSERT INTO tbl_customer (id, name, usr, address, email, phone, password) VALUES (:id, :name, :usr, :address, :email, :phone, :password)", 
        "params" => [
          "id" => $new_customer->getId(), 
          "name" => $new_customer->getName(), 
          "usr" => $new_customer->getUsername(), 
          "address" => $new_customer->getAddress(), 
          "email" => $new_customer->getEmail(), 
          "phone" => $new_customer->getPhone(), 
          "password" => $new_customer->getPassword()
        ]
      ]]);
    }
  }
?>