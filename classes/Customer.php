<?php 
   class Customer extends DataInstance {

      private $name; 
      public function getName() {
         return $this->name; 
      }

      private $phone; 
      public function getPhone() {
         return $this->phone;
      }

      private $username; 
      public function getUsername() {
         return $this->username; 
      }

      private $address; 
      public function getAddress() {
         return $this->address;
      }

      private $email; 
      public function getEmail() {
         return $this->email;
      }

      private $password; 
      public function getPassword() {
         return $this->password;
      }

      function __construct($customer) {
         parent::__construct(CUSTOMER_ID_PREFIX, $customer["id"]); 
         $this->name = $customer["name"];
         $this->phone = $customer["phone"]; 
         $this->username = $customer["usr"];
         $this->address = $customer["address"]; 
         $this->email = $customer["email"];
         $this->password = $customer["password"];
      }
   }
?>