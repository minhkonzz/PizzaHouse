<?php 
  foreach (["/", "/trang-chu"] as $home_route) 
    $router->get($home_route, "HomeController@init");
?>