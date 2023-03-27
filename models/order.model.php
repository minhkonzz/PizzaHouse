<?php 
  class OrderModel extends Model {
  
    // mapped
    private $customer_id; 
    public function setCustomerId($customer_id) {
      $this->customer_id = is_string($customer_id) ? $customer_id : "";
    }
    public function getCustomerId() { 
      return $this->customer_id;
    }

    private $buyer_name; 
    public function setBuyerName($buyer_name) {
      $this->buyer_name = is_string($buyer_name) ? $buyer_name : "";
    }

    public function getBuyerName() {
      return $this->buyer_name; 
    }

    private $buyer_email; 
    public function setBuyerEmail($buyer_email) {
      $this->buyer_email = is_string($buyer_email) ? $buyer_email : "";
    }
    public function getBuyerEmail() {
      return $this->buyer_email;
    }

    private $buyer_phone; 
    public function setBuyerPhone($buyer_phone) {
      $this->buyer_phone = is_string($buyer_phone) ? $buyer_phone : "";
    }
    public function getBuyerPhone() {
      return $this->buyer_phone; 
    }

    private $receiver_name; 
    public function setReceiverName($receiver_name) {
      $this->receiver_name = is_string($receiver_name) ? $receiver_name : ""; 
    } 
    public function getReceiverName() {
      return $this->receiver_name;
    }

    private $receiver_phone; 
    public function setReceiverPhone($receiver_phone) {
      $this->receiver_phone = is_string($receiver_phone) ? $receiver_phone : "";
    }
    public function getReceiverPhone() {
      return $this->receiver_phone; 
    }

    private $receive_address; 
    public function setReceiveAddress($receive_address) {
      $this->receive_address = is_string($receive_address) ? $receive_address : "";
    }
    public function getReceiveAddress() {
      return $this->receive_address;
    }

    private $is_take_in_shop;
    public function setIsTakeInShop($is_take_in_shop) {
      $this->is_take_in_shop = $is_take_in_shop;
    } 
    public function getIsTakeInShop() {
      return $this->is_take_in_shop;
    }

    private $city; 
    public function setCity($city) {
      $this->city = is_string($city) ? $city : ""; 
    } 
    public function getCity() {
      return $this->city; 
    }

    private $ward;
    public function setWard($ward) {
      $this->ward = is_string($ward) ? $ward : "";
    }
    public function getWard() {
      return $this->ward; 
    }

    private $district; 
    public function setDistrict($district) {
      $this->district = is_string($district) ? $district : "";
    }
    public function getDistrict() {
      return $this->district; 
    }

    private $pay_id; 
    public function setPaymentMethodId($pay_id) {
      $this->pay_id = is_string($pay_id) ? $pay_id : "";
    }
    public function getPaymentMethodId() {
      return $this->pay_id;
    }

    private $state_id; 
    public function setStateId($state_id) {
      $this->state_id = is_string($state_id) ? $state_id : "";
    }
    public function getStateId() {
      return $this->state_id;
    }

    private $note; 
    public function setNote($note) {
      $this->note = $note;
    }
    public function getNote() {
      return $this->note;
    }

    function __construct($order) {
      parent::__construct(ORDER_ID_PREFIX); 
      $this->setCustomerId($order["customer_id"]); 
      $this->setBuyerName($order["buyer_name"]); 
      $this->setBuyerEmail($order["buyer_email"]);
      $this->setBuyerPhone($order["buyer_phone"]);
      $this->setReceiverName($order["receiver_name"]);
      $this->setReceiverPhone($order["receiver_phone"]);
      $this->setReceiveAddress($order["receive_address"]); 
      $this->setCity($order["city"]); 
      $this->setDistrict($order["district"]);
      $this->setWard($order["ward"]);  
      $this->setPaymentMethodId($order["pay_method_id"]);
      $this->setStateId("ODS001"); 
      $this->setNote($order["note"]);
      $this->setIsTakeInShop($order["take_in_shop"]);
    }

    // no-mapped 
    public static function createOrder($new_order) { 
      $queries = [[
		    "query_str" => "INSERT INTO tbl_order (id, customer_id, buyer_name, buyer_email, buyer_phone, receiver_name, receiver_phone, receive_address, take_in_shop, district, city, city_state, order_state_id, pay_method_id, note) VALUES (:id, :customer_id, :buyer_name, :buyer_email, :buyer_phone, :receiver_name, :receiver_phone, :receive_address, :take_in_shop, :district, :city, :city_state, :order_state_id, :pay_method_id, :note)", 
        "params" => [
    			"id" => $new_order->getId(), 
    			"customer_id" => $new_order->getCustomerId(), 
    			"buyer_name" => $new_order->getBuyerName(), 
    			"buyer_email" => $new_order->getBuyerEmail(), 
    			"buyer_phone" => $new_order->getBuyerPhone(), 
    			"receiver_name" => $new_order->getReceiverName(), 
    			"receiver_phone" => $new_order->getReceiverPhone(), 
    			"receive_address" => $new_order->getReceiveAddress(), 
    			"take_in_shop" => $new_order->getIsTakeInShop(),
    			"district" => $new_order->getDistrict(), 
    			"city" => $new_order->getCity(), 
    			"city_state" => $new_order->getWard(), 
    			"order_state_id" => $new_order->getStateId(), 
    			"pay_method_id" => $new_order->getPaymentMethodId(), 
    			"note" => $new_order->getNote()
		    ]		
	    ]];  
      $order_item_options = [];
      $queries = array_merge($queries, array_map(function($cart_item, $cart_id) use ($new_order, &$order_item_options) {
        list("product_id" => $product_id, "qty_add" => $qty_add, "addons" => $addons) = $cart_item;
  	    $addon_val_ids = array_map(fn($addon) => $addon["addon_val_id"], $addons);
  	    foreach ($addon_val_ids as $addon_val_id) {
  		    array_push($order_item_options, [
  			    "query_str" => "INSERT INTO tbl_order_item_option VALUES (:product_id, :order_id, :addon_val_id, :cart_id)", 
  			    "params" => [
    				  "product_id" => $product_id, 
      				"order_id" => $new_order->getId(), 
      				"addon_val_id" => $addon_val_id, 
      				"cart_id" => $cart_id
  			    ]
  		    ]);
  	    }
        return [
        	"query_str" => "INSERT INTO tbl_order_item VALUES (:id, :order_id, :quantity)",
  		    "params" => [
      			"id" => $cart_id,
      			"order_id" => $new_order->getId(), 
      			"quantity" => $qty_add	
  		    ]
        ];
      }, $_SESSION[__CART_SESSION_KEY__]["list"], array_keys($_SESSION[__CART_SESSION_KEY__]["list"])));
      $queries = array_merge($queries, $order_item_options); 
      print_r($queries);
      return parent::performQuery($queries);
    }
  }
?>
