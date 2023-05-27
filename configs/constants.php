<?php 

  $is_local_env = $_SERVER["SERVER_NAME"] === "localhost";
  
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . ($is_local_env ? "/pizza-complete-version/" : "/"));
  
  define("ROOT_CLIENT", $is_local_env ? "/pizza-complete-version/" : "/");
  
  define("__EXCEPTION__", "ExceptionController@handle");
  define("__CART_SESSION_KEY__", "cart");
  define("__CART_INITIAL__", [ "items" => [], "cart_total" => 0 ]);
  define("__SECRET_KEY_LENGTH__", 40);
  define("PAGE_TITLE_PREFIX", "Pizza House Việt Nam - ");

  define("ROOT_ADMIN", $_SERVER["DOCUMENT_ROOT"] . ($is_local_env ? "/pizza-complete-version" : "") . "/admin/");
  
  define("ROOT_ADMIN_CLIENT", ($is_local_env ? "/pizza-complete-version" : "/admin/"));
  
  define("OKTA_REDIRECT_URI", ($is_local_env ? "http://localhost/pizza-complete-version/" : "http://" . $_SERVER["SERVER_NAME"] . "/") . $_ENV["OKTA_OAUTH2_REDIRECT_URI"]);
  
  define("OKTA_API_REQUEST_HEADERS", [
    "Accept: application/json", 
    "Content-Type: application/json", 
    "Authorization: SSWS " . $_ENV["OKTA_ACCESS_TOKEN"]
  ]); 

  define("DB_HOST", "localhost");
  define("DB_NAME", $is_local_env ? "pizza-house-db" : $_ENV["DB_NAME"]); 
  define("DB_USER", $is_local_env ? "root" : $_ENV["DB_USER"]); 
  define("DB_PASSWORD", $is_local_env ? "" : $_ENV["DB_PASSWORD"]); 
?>