<?php 
   // define("ROOT_ADMIN", $_SERVER["DOCUMENT_ROOT"] . "/pizza-complete-version/admin/");
   // define("ROOT_ADMIN_CLIENT", "/pizza-complete-version/admin/");
   // define("OKTA_API_REQUEST_HEADERS", [
   //    "Accept: application/json", 
   //    "Content-Type: application/json", 
   //    "Authorization: SSWS " . $_ENV["OKTA_ACCESS_TOKEN"]
   // ]);

   define("ROOT_ADMIN", $_SERVER["DOCUMENT_ROOT"] . "/admin/");
   define("ROOT_ADMIN_CLIENT", $_ENV["DOMAIN"] . "/admin/");
   define("OKTA_API_REQUEST_HEADERS", [
      "Accept: application/json", 
      "Content-Type: application/json", 
      "Authorization: SSWS " . $_ENV["OKTA_ACCESS_TOKEN"]
   ]);
?>