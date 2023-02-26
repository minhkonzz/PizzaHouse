<?php 
  require_once "core/router.core.php";

  $router = new Router(new Request);

  $router->get("/", function() {
    echo '<h1 style="color: blue;">Hello World</h1>';
  });
?>