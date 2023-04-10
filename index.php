<?php 
  // helpers
  require_once "helper/functions.php";

  // classes 
  require_once "classes/jwttoken.class.php";
  
  require_once "configs/constants.php";
  require_once "configs/id-prefix.php";

  // cores 
  require_once "core/database.core.php";
  require_once "core/model.core.php";
  require_once "core/controller.core.php";
  require_once "core/cache.core.php";
  require_once "core/request.core.php";
  require_once "core/response.core.php";
  require_once "core/router.core.php";

  // controllers
  require_once "controllers/home.controller.php";
  require_once "controllers/menu.controller.php";
  require_once "controllers/product.controller.php";
  require_once "controllers/cart.controller.php";
  require_once "controllers/order.controller.php";
  require_once "controllers/auth.controller.php";
  require_once "controllers/article.controller.php";
  require_once "controllers/service.controller.php";
  require_once "controllers/contact.controller.php";
  require_once "controllers/exception.controller.php";

  // models
  require_once "models/category.model.php";
  require_once "models/product.model.php";
  require_once "models/addon.model.php";
  require_once "models/payment.model.php";
  require_once "models/order.model.php";
  require_once "models/customer.model.php";

  // exceptions
  require_once "exceptions/auth.exception.php";
  require_once "exceptions/not-found.exception.php";
  require_once "exceptions/access-denied.exception.php";
  require_once "exceptions/method-not-allowed.exception.php";
  require_once "exceptions/encryption.exception.php";
  require_once "exceptions/decryption.exception.php";

  // interfaces
  require_once "interfaces/encryption.interface.php";
  require_once "interfaces/jwt-encryptor.interface.php";
  require_once "interfaces/middleware.interface.php";

  // middlewares
  require_once "middlewares/auth.middleware.php";

  // encryptors 
  require_once "security/encryptors/jwejwt.encryptor.php";

  $router = new Router();
  require_once "apis/home.php";
  require_once "apis/menu.php";
  require_once "apis/cart.php";
  require_once "apis/order.php";
  require_once "apis/auth.php";
  require_once "apis/article.php";
  require_once "apis/service.php";
?>
