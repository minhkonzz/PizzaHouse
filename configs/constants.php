<?php 
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/pizza-complete-version/");
  define("ROOT_CLIENT", "/pizza-complete-version/");
  define("ROOT_ADMIN", $_SERVER["DOCUMENT_ROOT"] . "/pizza-complete-version/admin/");
  define("ROOT_ADMIN_CLIENT", "/pizza-complete-version/admin/");
  define("__CONTROLLER_ACTION_DEFAULT__", "ExceptionController@handle");
  define("__CART_SESSION_KEY__", "cart");
  define("__CART_INITIAL__", [ "items" => [], "cart_total" => 0 ]);
  define("__SECRET_KEY_LENGTH__", 40);
?>