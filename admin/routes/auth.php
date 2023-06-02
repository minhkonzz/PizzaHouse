<?php 
  $router->get("/dang-nhap", "AuthController@init");
  $router->get("/dang-nhap/authorization-code/callback", "AuthController@handleAuthorizationCode");
?>