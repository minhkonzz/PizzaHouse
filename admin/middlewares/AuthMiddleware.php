<?php 
   class AuthMiddleware implements IMiddleware {
      public function process(Request $req, $handler) {
         if (empty($_SESSION["okta_id_token"])) $handler = "AuthController@init";
         return [1, $handler];
      }
   }
?>