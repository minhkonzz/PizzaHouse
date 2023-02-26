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

    private $time; 
    public function setTime($time) {
      $this->time = date_create($time);
    }
    public function getTime() {
      return $this->time;
    }

    private $note; 
    public function setNote($note) {
      $this->note = $note;
    }
    public function getNote() {
      return $this->note;
    }

    private $order_products; 
    public function setOrderProducts($order_products) {
      $this->setOrderProducts($order_products);
    } 
    public function getOrderProducts() {
      return $this->order_products;
    }

    function __construct($customer_id, $pay_id, $state_id, $note, $order_products) {
      parent::__construct(ORDER_ID_PREFIX); 
      $this->setCustomerId($customer_id); 
      $this->setPaymentMethodId($pay_id);
      $this->setStateId($state_id); 
      $this->setNote($note);
      $this->setOrderProducts($order_products);
    }

    // no mapped 
  }
?>