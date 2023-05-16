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
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
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

    public function getUnRoleEmployees(Request $req, $params = []) {
       try {
          $employees = StaffModel::selectUnRoleEmployees();
          if (!isset($employees)) throw new InternalErrorException(); 
          return (new Response($employees))->withJson();
       } catch (InternalErrorException $e) {
          return (new Response([], $e->getCode(), $e->getMessage()))->withJson(); 
       }
    }

    public function getRoleById(Request $req, $params = []) {
       try {
          $role = StaffModel::selectRoleById($params["role_id"]); 
          if (!isset($role) || isset($role["errorCode"])) throw new InternalErrorException(); 
          if (parent::isJsonOnly($req, $role)) return (new Response($role))->withJson();
          parent::view(
            ROOT_ADMIN, 
            ["title" => "Cập nhật bộ phận " . $role["id"]], 
            "staff/role-detail.view.php", 
            "staff/add-role.style.css", 
            "bundle.view.php",
            new Response($role)
          );
       } catch (InternalErrorException $e) {
          return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
       }
    }

    public function getEmployeesByRoleId(Request $req, $params = []) {
       try {
          $role_users = StaffModel::selectEmployeesByRoleId($params["role_id"]); 
          if (!isset($role_users) || $role_users === false) throw new InternalErrorException();
          return (new Response($role_users))->withJson();
       } catch (InternalErrorException $e) {
          return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
       }
    }

    public function createRole(Request $req, $params = []) {
       try {
          $payloads = $req->getPayloads();
          $role_created = StaffModel::addRole($payloads);
          if (!isset($role_created) || $role_created === false) throw new InternalErrorException(); 
          return (new Response())->withJson();
       } catch (InternalErrorException $e) {
          return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
       }
    }

    public function updateRoleById(Request $req, $params = []) {
       try {
          
       } catch (InternalErrorException $e) {
          return (new Response([], $e->getCode, $e->getMessage()))->withJson();
       }
    }

    public function deleteRoleById(Request $req, $params = []) {
       try {
          $response = StaffModel::deleteRoleById($params["role_id"]); 
          if (!isset($response) || $response === false) throw new InternalErrorException(); 
          return (new Response())->withJson();
       } catch (InternalErrorException $e) {
          return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
       }
    }
  }
?>