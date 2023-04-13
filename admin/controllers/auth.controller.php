<?php 
  class AuthController extends Controller {

    public function init(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN,
        "Pizza House VietNam - Đăng nhập quản trị", 
        "login/login.view.php", 
        "login/login.style.css", 
        "bundle.view.php",
        new Response([]),
        false
      );
    }

    public function login() {}
  }
?>