<?php 
  // namespace PZHouse\Admin\Controllers;

  class StaffController extends Controller {

    public function init(Request $req, $params = []) {
      $this->getAllStaff($req, $params);
    }

    public function getAllStaff(Request $req, $params = []) {
      try {
        $body_response = [ "staff" => StaffModel::selectAllStaff() ];
        parent::view(
          ROOT_ADMIN,
          "Pizza House VietNam - Quản lý nhân viến", 
          "staff/staff.view.php", 
          "staff/staff.style.css",
          "bundle.view.php",
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>