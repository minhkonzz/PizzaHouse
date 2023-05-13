<?php 

  // namespace PZHouse\Classes;

  include_once __ROOT__ . "core/DataInstance.php";

  class Order extends DataInstance {

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

    private $total; 
    public function setTotal($total) {
      if ($total) {
        $this->total = $total; 
        return;
      } 
      if (count($this->order_items) > 0) 
        $this->total = array_reduce($order_items, fn($acc, $cur) => $acc + ($cur["total_price"] * $cur["qty_add"]), 0);
    }

    public function getTotal() {
      return $this->total;
    }

    private $order_items;
    public function setOrderItems($order_items) {
      $this->order_items = $order_items; 
    }

    public function getOrderItems() {
      return $this->order_items;
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
      $this->setTotal($order["total"]);
      $this->setOrderItems($order["order_items"]);
    }
  }
?>