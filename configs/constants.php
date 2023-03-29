<?php 
  define("__ROOT__", $_SERVER["DOCUMENT_ROOT"] . "/pizza-complete-version/");
  define("__CONTROLLER_ACTION_DEFAULT__", "ExceptionController@handle");
  define("__CART_SESSION_KEY__", "cart");
  define("__CART_INITIAL__", [ "list" => [], "cart_total" => 0 ]);
  define("__SECRET_KEY_LENGTH__", 40);
?>