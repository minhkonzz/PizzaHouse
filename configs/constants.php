<?php 
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/pizza-complete-version/");
  define("ROOT_CLIENT", "/pizza-complete-version/");
  define("__EXCEPTION__", "ExceptionController@handle");
  define("__CART_SESSION_KEY__", "cart");
  define("__CART_INITIAL__", [ "items" => [], "cart_total" => 0 ]);
  define("__SECRET_KEY_LENGTH__", 40);
  define("PAGE_TITLE_PREFIX", "Pizza House Việt Nam - ");

  // define("__ROOT__", $_SERVER["DOCUMENT_ROOT"]);
  // define("ROOT_CLIENT", $_ENV["DOMAIN"]);
  // define("__EXCEPTION__", "ExceptionController@handle");
  // define("__CART_SESSION_KEY__", "cart");
  // define("__CART_INITIAL__", [ "items" => [], "cart_total" => 0 ]);
  // define("__SECRET_KEY_LENGTH__", 40);

  define("ROOT_ADMIN", $_SERVER["DOCUMENT_ROOT"] . "/pizza-complete-version/admin/");
  define("ROOT_ADMIN_CLIENT", "/pizza-complete-version/admin/");
  define("OKTA_API_REQUEST_HEADERS", [
    "Accept: application/json", 
    "Content-Type: application/json", 
    "Authorization: SSWS " . $_ENV["OKTA_ACCESS_TOKEN"]
  ]);

   // define("ROOT_ADMIN", $_SERVER["DOCUMENT_ROOT"] . "/admin/");
   // define("ROOT_ADMIN_CLIENT", $_ENV["DOMAIN"] . "/admin/");
   // define("OKTA_API_REQUEST_HEADERS", [
   //    "Accept: application/json", 
   //    "Content-Type: application/json", 
   //    "Authorization: SSWS " . $_ENV["OKTA_ACCESS_TOKEN"]
   // ]);
?>