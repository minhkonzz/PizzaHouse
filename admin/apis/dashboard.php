<?php 
  $router->get("/", "DashboardController@init")->applyMiddlewares("AuthMiddleware");
  $router->get("/tong-quan", "DashboardController@init")->applyMiddlewares("AuthMiddleware");
?>