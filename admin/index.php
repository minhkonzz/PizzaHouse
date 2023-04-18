<?php 
  require_once "../helper/functions.php";
  require_once "../configs/constants.php";

  require_once "../core/controller.core.php";
  require_once "../controllers/exception.controller.php";

  foreach([
    "category", 
    "jwttoken"
  ] as $class) require_once "../classes/$class.class.php";

  foreach ([
    "database", 
    "model", 
    "request", 
    "response", 
    "router"
  ] as $core) require_once "../core/$core.core.php";

  foreach ([
    "category",
    "discount",
    "addon",
    "product",
    "order"
  ] as $model) require_once "models/$model.model.php";

  foreach ([
    "auth",
    "category",
    "staff",
    "dashboard",
    "customer",
    "order",
    "product",
    "addon",
    "test"
  ] as $controller) {
    require_once "controllers/$controller.controller.php";
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
    "product",
    "staff",
    "dashboard",
    "article", 
    "discount",
    "customer",
    "order",
    "addon"
  ] as $api) require_once "apis/$api.api.php";
?>