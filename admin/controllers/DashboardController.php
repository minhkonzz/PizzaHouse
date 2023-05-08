<?php 

  // namespace PZHouse\Admin\Controllers;

  class DashboardController extends Controller {
    public function init(Request $req, $params = []) {
      echo "init DashboardController";
      if (isset($_SESSION["user_info"])) {
        echo "<pre>";
        echo json_encode($_SESSION["user_info"]);
      }
    }
  }
?>