<?php 
  // namespace PZHouse\Classes;

  // use PZHouse\Core\DataInstance;

  include_once __ROOT__ . "core/DataInstance.php";

  class Category extends DataInstance {

    private $category_name; 
    public function getCategoryName() {
      return $this->category_name;
    }

    function __construct($category_name) {
      parent::__construct(CATEGORY_ID_PREFIX);
      $this->category_name = $category_name; 
    }
  }
?>