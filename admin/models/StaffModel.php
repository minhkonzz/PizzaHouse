<?php
  // namespace PZHouse\Admin\Models;

   class StaffModel extends Model {
      public static function selectAllStaff() {
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/users"); 
         return json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true);
      }     

      public static function selectAllRoles() {
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/groups");
         $roles = json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true); 
         return array_map(function($e) use ($req_sender) {
            list("id" => $role_id, "created" => $created, "profile" => $role_info, "_links" => $role_links) = $e;
            $role_name = $role_info["name"] ?? "";
            if ($role_name === "Everyone") return null;
            $req_sender->setUrl($_ENV["OKTA_DOMAIN"] . "/api/v1/groups/$role_id/users"); 
            $role_count = count(json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true));
            return [
               "role_id" => $role_id, 
               "role_name" => $role_name,
               "created" => $created, 
               "role_count" => $role_count       
            ];
         }, $roles);
      }

      public static function selectRoleById($id) {
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/groups/$id"); 
         $role = json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true);
         if (!isset($role) || isset($role["errorCode"])) return false; 
         list("name" => $role_name, "description" => $role_desc) = $role["profile"];
         return [
            "id" => $role["id"], 
            "name" => $role_name, 
            "description" => $role_desc
         ];
      }

      public static function selectEmployeesByRoleId($id) {
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/groups/$id/users"); 
         $role_users = json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true);
         return !isset($role_users) || isset($role_users["errorCode"]) ? false : array_map(function($e) {
            list("firstName" => $first_name, "lastName" => $last_name, "employeeNumber" => $employee_number) = $e["profile"];
            return [
               "id" => $e["id"], 
               "created" => DateTime::createFromFormat("Y-m-d\TH:i:s.u\Z", $e["created"])->format("Y-m-d H:i:s"), 
               "firstName" => $first_name, 
               "lastName" => $last_name, 
               "employeeNumber" => $employee_number
            ];
         }, $role_users);
      }

      public static function selectUnRoleEmployees() {
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/users?search=profile.roleId+eq+%22%22"); 
         return json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true); 
      }

      public static function addRole($new_role) {
         list("name" => $role_name, "description" => $desc, "employeeIds" => $employee_ids) = $new_role;  
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/groups");
         $created_role = json_decode($req_sender->post(json_encode([
            "profile" => [
               "name" => $role_name, 
               "description" => $desc
            ]
         ]), OKTA_API_REQUEST_HEADERS), true);
         if ((!isset($created_role) && empty($created_role)) || isset($created_role["errorCode"])) return false;
         foreach ($employee_ids as $employee_id) {
            $req_sender->setUrl($_ENV["OKTA_DOMAIN"] . "/api/v1/groups/" . $created_role["id"] . "/users/" . $employee_id);
            $response = $req_sender->put(json_encode([]), OKTA_API_REQUEST_HEADERS);
            if (isset($response["errorCode"])) return false;  
         }
         return true;
      }

      public static function deleteRoleById($id) {
         $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/groups/$id"); 
         $response = json_decode($req_sender->delete(OKTA_API_REQUEST_HEADERS), true); 
         return !isset($response["errorCode"]);
      }
   }
?>  