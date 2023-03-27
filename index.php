<?php header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE'); ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0;">
<style><?php include "views/global.css"; ?></style>
<script 
  src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
  integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
  crossorigin="anonymous" 
  referrerpolicy="no-referrer">
</script>
<script src="public/scripts/parallax/parallax.min.js"></script>
<script src="public/scripts/parallax/parallax.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<?php 
  require_once "helper/functions.php";

  // configs
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
  require_once "controllers/exception.controller.php";

  // models
  require_once "models/category.model.php";
  require_once "models/product.model.php";
  require_once "models/addon.model.php";
  require_once "models/payment.model.php";
  require_once "models/order.model.php";

  $router = new Router();
  require_once "apis/home.php";
  require_once "apis/menu.php";
  require_once "apis/cart.php";
  require_once "apis/order.php";
?>
