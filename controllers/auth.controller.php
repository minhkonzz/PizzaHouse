<?php 
  class AuthController extends Controller {
    public function init(Request $request = null, $params = []) {
      parent::view(
        "Auth",
        "views/auth/auth.view.php", 
        new Response()
      );
    }

    public function login(Request $request = null, $params = []) {
      $requested_payloads = $request->getPayloads();
      $email = $requested_payloads["email"]; 
      $password = $requested_payloads["password"];
      $customer = CustomerModel::getCustomerByEmail($email);
      if (nonnull($customer)) {
        $customer_password = $customer["password"];
        if ($customer_password === $password) {
          $token = new Token([], $customer, '', time() + 3600);
          try {
            $encryptor = new JweJwtEncryptor();
            if (nonnull($encryptor)) {
              $secret_key = bin2hex(random_bytes(__SECRET_KEY_LENGTH__)); 
              $encrypted_token = $encryptor->encode($token->getPayload(), $secret_key);
              $token->setToken($encrypted_token);
            }
          } catch (EncryptionException $e) {
            // handle if can't create encrypted token
          }
          setcookie("auth_token", $token->getToken(), $token->getExpireAt(), "/", "", true, true);
          parent::view(
            "PizzaHouse VietNam - Trang chủ", 
            "views/home/home.view.php",
            new Response()
          );
        }
      }
    }

    public function signup(Request $request = null, $params = []) {
      parent::view(
        "Auth",
        "views/auth/auth.view.php", 
        new Response()
      );
    }
  }
?>