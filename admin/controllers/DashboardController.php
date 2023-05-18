<?php 

  // namespace PZHouse\Admin\Controllers;

  class DashboardController extends Controller {
    public function init(Request $req, $params = []) {
      try {
         parent::view(
            ROOT_ADMIN, 
            ["title" => "Thống kê hoạt động"], 
            "dashboard/dashboard.view.php", 
            "dashboard/dashboard.style.css", 
            "bundle.view.php", 
            new Response()
         );
      } catch (InternalErrorException $e) {
         return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>