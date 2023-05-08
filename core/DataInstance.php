<?php 

  // namespace PZHouse\Core;

  class DataInstance {
    protected $id = null; 

    function __construct($prefix = "", $id = "") {
      if (empty($id)) {
        $this->generateId($prefix);
        return;
      }
      $this->id = $id; 
    }

    private function generateId($prefix) {
      $this->id = $prefix.time(); 
    }

    public function getId() {
      return $this->id;
    }
  }
?>