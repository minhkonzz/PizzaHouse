<?php 
  class StaffModel extends Model {
    public static function selectAllStaff() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_staff")
          ->select(
            "tbl_staff.id as staff_id", 
            "name", 
            "role", 
            "is_activated", 
            "tbl_staff.created_at as created_at"
          )
          ->join("tbl_role", "tbl_role.id", "=", "tbl_staff.role_id"),
        "is_fetch" => "staff"
      ]]);
      return $res["staff"];
    }

    public static function selectAllRoles() {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_role")
          ->select(
            "tbl_role.id as role_id", 
            "role", 
            "count(tbl_staff.id) as total_staff"
          )
          ->join("tbl_staff", "tbl_staff.role_id", "=", "tbl_role.id")
          ->groupBy("role_id"),
        "is_fetch" => "roles"
      ]]);
      return $res["roles"];
    }
  }
?>  