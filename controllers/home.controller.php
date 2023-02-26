<?php 
  class HomeController extends Controller {

    public function init() {
      parent::renderView(
        "Home", 
        "./views/home/home.php"
      );
    }
  }
?>