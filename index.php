<meta name="viewport" content="width=device-width, initial-scale=1.0;">
<style><?php include "views/global.css"; ?></style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="public/scripts/parallax/parallax.min.js"></script>
<script src="public/scripts/parallax/parallax.js"></script>
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
<?php 
  // import cores 
  require_once "core/querybuilder.core.php";
  require_once "core/database.core.php";
  require_once "core/model.core.php";
  require_once "core/controller.core.php";
  require_once "core/app.core.php";

  // import models 
  require_once "models/category.model.php";
  require_once "models/customer.model.php";
  require_once "models/order.model.php";
  require_once "models/product.model.php";

  //import controllers 
  require_once "controllers/home.controller.php";
  require_once "controllers/menu.controller.php";

  $app = new App;
?>
