<?php 
  class StaffController extends Controller {
    public function showAllEmployees(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN,
        "Pizza House VietNam - Quản lý nhân viến", 
        "staff/staff.view.php", 
        "staff/staff.style.css",
        "bundle.view.php",
        new Response([])
      );
    }
  }
?>