<?php 
	class AuthMiddleware implements IMiddleware {

		public function process(Request $request, $handler) {
			$user = false; 
			if (!$user) {
				$handler = "AuthController@init";
				return [0, $handler];
			}
			return [1, $handler];
		}
	}
?>