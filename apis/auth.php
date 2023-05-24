<?php
  $router->get("/dang-nhap", "AuthController@toLogin");
  $router->get("/dang-ky", "AuthController@toRegister");
  $router->post("/dang-ky", "AuthController@register");
  $router->post("/dang-nhap", "AuthController@login");
?>