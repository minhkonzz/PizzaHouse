<?php 
  class DataInstance {
    protected $id = null; 

    function __construct($id_prefix = "") {
      $this->generateId($id_prefix);
    }

    private function generateId($id_prefix) {
      $this->id = $id_prefix.time(); 
    }

    public function getId() {
      return $this->id;
    }
  }
?>