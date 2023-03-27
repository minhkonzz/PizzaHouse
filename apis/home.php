<?php 
  // foreach (["/", "/trang-chu"] as $home_route)
  //   $app->get($home_route, function() {
  //     $controller = new HomeController();
  //     if (nonnull($controller) && method_exists($controller, "init")) {
  //       $controller->init();
  //       unset($controller);
  //     }
  //   });
  foreach (["/", "/trang-chu"] as $home_route) 
    $router->get($home_route, "HomeController@init");
?>