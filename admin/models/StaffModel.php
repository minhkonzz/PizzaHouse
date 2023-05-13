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
  }
?>  