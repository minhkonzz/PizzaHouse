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

      public function toLogin(Request $req, array $params = []) {
         parent::view(
            __ROOT__, 
            ["title" => "Đăng nhập", "path" => ["Trang chủ", "Đăng nhập"]],
            "auth/auth.view.php",
            "auth/auth.style.css", 
            "bundle.view.php", 
            new Response(["auth_type" => "login"])
         );
      }

      public function toRegister(Request $req, array $params = []) {
         parent::view(
            __ROOT__, 
            ["title" => "Đăng nhập", "path" => ["Trang chủ", "Đăng ký"]],
            "auth/auth.view.php",
            "auth/auth.style.css", 
            "bundle.view.php", 
            new Response(["auth_type" => "register"])
         );
      }

     public function login(Request $req, array $params = []) {
        try {
           list("customerEmail" => $email, "customerPassword" => $password) = $req->getPayloads();
           $customer = new Customer(CustomerModel::selectCustomerByEmail($email));
           if (!isset($customer) || empty($customer)) throw new AuthException("Không tìm thấy user có email đã nhập");
           if (!password_verify($password, $customer->getPassword())) throw new AuthException("Mật khẩu đăng nhập không đúng");
           $token = new JWTToken([], $customer, '', time() + 300);
           $encryptor = new JWEEncryptor();
           if (!isset($encryptor) || empty($encryptor)) throw new EncryptException();
           $secret_key = bin2hex(random_bytes(__SECRET_KEY_LENGTH__));
           $encrypted_token = $encryptor->encode($token->getPayload(), $secret_key);
           $token->setToken($encrypted_token);
           setcookie("auth_token", "aaa", $token->getExpireAt(), "/");
           setcookie("user", json_encode([
              "id" => $customer->getId(), 
              "name" => $customer->getName(), 
              "phone" => $customer->getPhone(), 
              "email" => $customer->getEmail(),
              "username" => $customer->getUsername(), 
              "address" => $customer->getAddress()
           ]), $token->getExpireAt(), "/");
           return (new Response())->withJson();
        } 
        catch (AuthException $e) {} 
        catch (EncryptException $e) {}
     }

     public function register(Request $req, array $params = []) {
        try {
           list("customerName" => $name, "customerPhone" => $phone, "customerAddress" => $address, "customerEmail" => $email, "customerUsername" => $username, "customerPassword" => $pwd) = $req->getPayloads();
           if (!empty(CustomerModel::selectCustomerByEmail($email))) throw new AuthException();
           $new_customer = new Customer(["name" => $name, "phone" => $phone, "usr" => $username, "address" => $address, "email" => $email, "password" => password_hash($pwd, PASSWORD_DEFAULT)]);
           if (!CustomerModel::createCustomer($new_customer)) throw new InternalErrorException();
           return (new Response())->withJson();
        } catch (InternalErrorException $e) {   
           return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
        } catch (AuthException $e) {}
     }
  }
?>