<?php 
	// namespace PZHouse\Middlewares;

	// use PZHouse\Interfaces\IMiddleware;

	use Jumbojett\OpenIDConnectClient;

	class AuthMiddleware implements IMiddleware {
		public function process(Request $request, $handler) {
			if (isset($_SESSION["auth_token"])) {
				$config = [
					'issuer' => 'https://dev-71827950.okta.com',
					'clientId' => '0oa99inwegxIDatIr5d7',
					'clientSecret' => '4h9tmkQ6fLlGe7TlDoC3JGV33pTGI2kJnvG3zZry',
					'scope' => 'openid profile email phone'
				];
				$oidc = new OpenIDConnectClient($config['issuer'], $config['clientId'], $config['clientSecret']);
				$oidc->addScope($config["scope"]); 
				$oidc->setAccessToken($_SESSION["auth_token"]); 
				$_SESSION["user_info"] = $oidc->requestUserInfo();
				return [1, $handler];
			}
			$handler = "AuthController@init"; 
			return [1, $handler];
		}
	}
?>