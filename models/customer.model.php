<?php 
  class CustomerModel extends Model {
    
    function __construct() {
      parent::__construct(CUSTOMER_ID_PREFIX);
    }
  }
?>