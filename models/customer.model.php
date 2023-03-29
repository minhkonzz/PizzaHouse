<?php 
  class CustomerModel extends Model {
    
    function __construct() {
      parent::__construct(CUSTOMER_ID_PREFIX);
    }

    public static function getCustomerByEmail($email) {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_customer")
          ->select("id", "name", "usr", "address", "email", "phone", "password")
          ->where("email", ":email"), 
        "is_fetch" => "customer", 
        "params" => [ "email" => $email ]
      ]]);
      return $res["customer"][0];
    }
  }
?>