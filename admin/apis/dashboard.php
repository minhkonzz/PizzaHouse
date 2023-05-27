<?php 
  $router->get("/", "DashboardController@init")->applyMiddlewares("GET", "/", "AuthMiddleware");
  $router->get("/tong-quan", "DashboardController@init")->applyMiddlewares("GET", "/tong-quan", "AuthMiddleware");
?>