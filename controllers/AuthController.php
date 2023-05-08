<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller;
  // use PZHouse\Core\Request; 
  // use PZHouse\Core\Response;
  // use PZHouse\Classes\JWTToken;
  // use PZHouse\Security\Encryptors\JWEEncryptor; 
  // use PZHouse\Models\CustomerModel;
  // use PZHouse\Exceptions\AuthException; 
  // use PZHouse\Exceptions\EncryptException;

  class AuthController extends Controller {
    public function init(Request $req, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Đăng nhập",
        "auth/auth.view.php",
        "auth/auth.style.css", 
        "bundle.view.php", 
        new Response()
      );
    }

    public function login(Request $req, $params = []) {
      list("email" => $email, "password" => $password) = $req->getPayloads();
      try {
        $customer = CustomerModel::getCustomerByEmail($email);
        if (!isset($customer) || empty($customer)) throw new AuthException();

        $customer_password = $customer["password"];
        if ($customer_password !== $password) throw new AuthException("Mật khẩu đăng nhập không đúng");

        $token = new JWTToken([], $customer, '', time() + 3600);
        $encryptor = new JWEEncryptor();
        if (!isset($encryptor) || empty($encryptor)) throw new EncryptException();
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
      catch (EncryptException $e) {}
    }

    public function signup(Request $req, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Đăng nhập",
        "auth/auth.view.php",
        "auth/auth.style.css", 
        "bundle.view.php", 
        new Response()
      );
    }
  }
?>