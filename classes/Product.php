<?php 
  // namespace PZHouse\Classes;

  // use PZHouse\Core\DataInstance;

  require_once __ROOT__ . "core/DataInstance.php";

  class Product extends DataInstance {
    
    private $name; 
    public function getName() {
      return $this->name;
    }

    private $image;  // image file name
    public function getImage() {
      return $this->image; 
    }

    private $price; 
    public function getPrice() {
      return $this->price; 
    }

    private $category_id;
    public function getCategoryId() {
      return $this->category_id;
    }

    private $description; 
    public function getDescription() {
      return $this->description; 
    }

    private $addon_options; 
    public function getAddonOptionIds() {
      return $this->addon_options;
    }

    function __construct($name, $image, $price, $category_id, $description, $addon_options, $id = "") {
      parent::__construct(PRODUCT_ID_PREFIX, $id);
      $this->name = $name;
      $this->image = $image; 
      $this->price = $price;
      $this->category_id = $category_id; 
      $this->description = $description; 
      $this->addon_options = $addon_options; 
    }
  }
?>