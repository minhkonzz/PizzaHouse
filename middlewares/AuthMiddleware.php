<?php 
	// namespace PZHouse\Middlewares;

	// use PZHouse\Interfaces\IMiddleware;
	class AuthMiddleware implements IMiddleware {
		public function process(Request $request, $handler) {
			if (!isset($_COOKIE["user"])) $handler = "AuthController@toLogin";
         return [1, $handler];
		}
	}
?>