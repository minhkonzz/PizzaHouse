<?php 
  require_once "core/router.core.php";

  $router = new Router(new Request);

  $router->get("/thuc-don", function() {
    header("location: http://localhost/pizza-client/menu");
  });

?>