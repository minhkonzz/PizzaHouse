<?php 
  // namespace PZHouse\Admin\Controllers;

  class StaffController extends Controller {

    public function init(Request $req, $params = []) {
      $this->getAllStaff($req, $params);
    }

    public function getAllStaff(Request $req, $params = []) {
      try {
        $body_response = [ 
          "staff" => StaffModel::selectAllStaff(), 
          "roles" => StaffModel::selectAllRoles()
        ];
        parent::view(
          ROOT_ADMIN,
          ["title" => "Quản lý nhân viên"], 
          "staff/staff.view.php", 
          "staff/staff.style.css",
          "bundle.view.php",
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function showAddRolePage(Request $req, $params = []) {
      try {
        parent::view(
          ROOT_ADMIN, 
          ["title" => "Thêm bộ phận"],
          "staff/add-role.view.php", 
          "staff/add-role.style.css", 
          "bundle.view.php", 
          new Response()
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>