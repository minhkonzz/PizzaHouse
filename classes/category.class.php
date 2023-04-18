<?php 
  class Category {

    private $id; 
    private $category_name; 

    function __construct($id, $category_name) {
      $this->id = $id; 
      $this->category_name = $category_name; 
    }

    public function getId() { 
      return $this->id; 
    }

    public function getCategoryName() {
      return $this->category_name;
    }
  }
?>