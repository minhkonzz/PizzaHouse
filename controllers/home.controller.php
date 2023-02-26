<?php 
  class HomeController extends Controller {
    function __construct() {
      parent::renderView(
        "Home", 
        "./views/home/home.php"
      );
    }
  }
?>