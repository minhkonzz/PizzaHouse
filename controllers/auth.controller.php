<?php 
  class AuthController extends Controller {
    public function init(Request $request = null, $params = []) {
      parent::view(
        __ROOT__ . "views/auth/auth.php", 
        new Response()
      );
    }

    public function login(Request $request = null, $params = []) {
      parent::view(
        __ROOT__ . "views/auth/auth.php",
        new Response()
      );
    }

    public function signup(Request $request = null, $params = []) {
      parent::view(
        __ROOT__ . "views/auth/auth.php", 
        new Response()
      );
    }
  }
?>