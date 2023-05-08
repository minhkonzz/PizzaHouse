<?php 

  // namespace PZHouse\Admin\Models;

  class StaffModel extends Model {
     public static function selectAllStaff() {
        $req_sender = new RequestSender($_ENV["OKTA_DOMAIN"] . "/api/v1/users"); 
        return json_decode($req_sender->get(OKTA_API_REQUEST_HEADERS), true);
     }     
  }
?>  