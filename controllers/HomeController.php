<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller;
  // use PZHouse\Core\Request; 
  // use PZHouse\Core\Response;

  class HomeController extends Controller {

    public function init(Request $req, $params = []) {
      parent::view(
        __ROOT__,
        "Pizza House Việt Nam - Trang chủ", 
        "home/home1.view.php",
        "", 
        "bundle.view.php",
        new Response()
      );
    }
  }
?>