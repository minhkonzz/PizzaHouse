<?php 
  class AuthController extends Controller {
    public function init(Request $req = null, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Đăng nhập",
        "auth/auth.view.php",
        "auth/auth.style.css", 
        "bundle.view.php", 
        new Response()
      );
    }

    public function login(Request $req = null, $params = []) {
      $requested_payloads = $req->getPayloads();
      $email = $requested_payloads["email"]; 
      $password = $requested_payloads["password"];
      try {
        $customer = CustomerModel::getCustomerByEmail($email);
        if (!isset($customer) || empty($customer))
          throw new AuthException();
        $customer_password = $customer["password"];
        if ($customer_password !== $password) 
          throw new AuthException("Mật khẩu đăng nhập không đúng");
        $token = new JWTToken([], $customer, '', time() + 3600);
        $encryptor = new JweJwtEncryptor();
        if (!isset($encryptor) || empty($encryptor)) 
          throw new EncryptionException();
        $secret_key = bin2hex(random_bytes(__SECRET_KEY_LENGTH__));
        $encrypted_token = $encryptor->encode($token->getPayload(), $secret_key);
        $token->setToken($encrypted_token);
        setcookie("auth_token", $token->getToken(), $token->getExpireAt(), "/", "", true, true);
        parent::view(
          "PizzaHouse VietNam - Trang chủ", 
          "home/home.view.php",
          "", 
          "bundle.view.php",
          new Response([
            "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
          ])
        );
      } 
      catch (AuthException $e) {} 
      catch (EncryptionException $e) {}
    
    }

    public function signup(Request $request = null, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Đăng nhập",
        "auth/auth.view.php",
        "auth/auth.style.css", 
        "bundle.view.php", 
        new Response([])
      );
    }
  }
?>