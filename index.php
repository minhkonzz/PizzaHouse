<?php
   header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); 
   date_default_timezone_set('Asia/Ho_Chi_Minh');

   require_once "vendor/autoload.php";

   use Dotenv\Dotenv; 

   $dotenv = Dotenv::createImmutable(__DIR__);
   $dotenv->load();

   if (session_id() === "") session_start();

   $dirs = [
      "helper",
      "configs",
      "classes", 
      "core", 
      "models", 
      "controllers", 
      "interfaces", 
      "middlewares", 
      "security/encryptors", 
      "exceptions"
   ];

   foreach ($dirs as $dir) {
      foreach (glob($dir."/*.php") as $file_path) {
         if (file_exists($file_path)) require_once $file_path;
      }
   }

   // init session
   $_SESSION[__CART_SESSION_KEY__] = $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__;

   $router = new Router();
   foreach (glob("apis/*.php") as $file_path) {
      if (file_exists($file_path)) require_once $file_path;
   }
?>