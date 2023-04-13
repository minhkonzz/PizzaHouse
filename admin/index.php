<?php 
  require_once "../helper/functions.php";
  require_once "../configs/constants.php";

  require_once "../core/controller.core.php";
  require_once "../controllers/exception.controller.php";

  foreach ([
    "database", 
    "model", 
    "request", 
    "response", 
    "router"
  ] as $core) require_once "../core/$core.core.php";

  foreach ([
    "category",
    "discount"
  ] as $model) require_once "../models/$model.model.php";

  foreach ([
    "auth",
    "catalog",
    "staff",
    "dashboard",
    "customer",
    "test"
  ] as $controller) {
    $require = "controllers/$controller.controller.php";
    require_once $controller[0] === "@" ? "../" . $require : $require;
  }

  foreach ([
    "access-denied", 
    "auth", 
    "decryption", 
    "encryption", 
    "method-not-allowed",
    "internal-error",
    "not-found"
  ] as $exception) require_once "../exceptions/$exception.exception.php";

  foreach ([
    "encryption", 
    "jwt-encryptor", 
    "middleware"
  ] as $interface) require_once "../interfaces/$interface.interface.php";

  foreach ([
    "auth"
  ] as $middleware) require_once "../middlewares/$middleware.middleware.php";

  $router = new Router();

  foreach ([
    "auth", 
    "test",
    "category", 
    "staff",
    "dashboard",
    "article", 
    "discount",
    "customer"
  ] as $api) require_once "apis/$api.api.php";
?>