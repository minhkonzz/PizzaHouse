<?php 
  // namespace PZHouse\Admin\Controllers;
   // use Jumbojett\OpenIDConnectClient;
   class AuthController extends Controller {
      public function init(Request $req, $params = []) {
         // Generate a random state parameter for CSRF security
         $_SESSION['oauth_state'] = bin2hex(random_bytes(10));

         // Create the PKCE code verifier and code challenge
         $_SESSION['oauth_code_verifier'] = bin2hex(random_bytes(50));
         $hash = hash('sha256', $_SESSION['oauth_code_verifier'], true);
         $code_challenge = rtrim(strtr(base64_encode($hash), '+/', '-_'), '=');

         // Build the authorization URL by starting with the authorization endpoint
         $authorization_endpoint = $_ENV['OKTA_OAUTH2_ISSUER'] . "/v1/authorize";
         $authorize_url = $authorization_endpoint . '?' . http_build_query([
            'response_type' => 'code',
            'client_id' => $_ENV['OKTA_OAUTH2_CLIENT_ID'],
            'state' => $_SESSION['oauth_state'],
            'redirect_uri' => $_ENV['OKTA_OAUTH2_REDIRECT_URI'],
            'code_challenge' => $code_challenge,
            'code_challenge_method' => 'S256',
            'scope' => 'openid profile email',
         ]);
         header('Location: '.$authorize_url);
      }

      public function handleAuthorizationCode(Request $req, $params = []) {
         try {
            $payloads = $req->getPayloads();
            if (empty($payloads['state']) || $payloads['state'] != $_SESSION['oauth_state']) 
               throw new Exception("state does not match");
           
            if (!empty($payloads['error'])) 
               throw new Exception("authorization server returned an error: ".$_GET['error']);
           
            if (empty($payloads['code'])) 
               throw new Exception("this is unexpected, the authorization server redirected without a code or an error");
           
             // Exchange the authorization code for an access token and ID token 
             // by making a request to the token endpoint
            $token_endpoint = $_ENV["OKTA_OAUTH2_ISSUER"] . "/v1/token";
           
            $req_sender = new RequestSender($token_endpoint);
            $response = json_decode($req_sender->post(http_build_query([
               'grant_type' => 'authorization_code',
               'code' => $_GET['code'],
               'code_verifier' => $_SESSION['oauth_code_verifier'],
               'redirect_uri' => $_ENV['OKTA_OAUTH2_REDIRECT_URI'],
               'client_id' => $_ENV['OKTA_OAUTH2_CLIENT_ID'],
               'client_secret' => $_ENV['OKTA_OAUTH2_CLIENT_SECRET'],
            ])), true);
           
            if (isset($response['error'])) 
               throw new Exception("token endpoint returned an error: ".$response['error']);
           
            if (!isset($response['access_token'])) 
               throw new Exception("token endpoint did not return an error or an access token");
           
             // Lưu Access token trả về vào Session hiện tại
            $_SESSION['okta_access_token'] = $response['access_token'];
           
            if (isset($response['refresh_token']))
               $_SESSION['okta_refresh_token'] = $response['refresh_token'];
           
            if (isset($response['id_token']))
               $_SESSION['okta_id_token'] = $response['id_token'];
           
            header("Location: " . ROOT_ADMIN_CLIENT); 
         } catch (Exception $e) {}
      }
   }
?>