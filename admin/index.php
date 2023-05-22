<?php 
  header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');

  require_once "../vendor/autoload.php";

  use Dotenv\Dotenv; 

  $dotenv = Dotenv::createImmutable($_SERVER["DOCUMENT_ROOT"] . ($_SERVER["SERVER_NAME"] === "localhost" ? "/pizza-complete-version/" : "/"));
  $dotenv->load();

  if (session_id() === "") session_start();

  $dirs = [
    "../helper", 
    "../configs", 
    "../classes", 
    "../core", 
    "models", 
    "controllers", 
    "../interfaces", 
    "middlewares", 
    "../security/encryptors", 
    "../exceptions"
  ];

  foreach ($dirs as $dir) {
    foreach (glob($dir."/*.php") as $file_path)
      if (file_exists($file_path)) require_once $file_path;
  }

  require_once "../controllers/ExceptionController.php";

  $router = new Router();
  foreach (glob("apis/*.php") as $file_path)
    if (file_exists($file_path)) require_once $file_path;
?>