<?php
  $router->get("/dang-nhap", "AuthController@init");
  $router->post("/dang-nhap", "AuthController@login");
  $router->post("/dang-ky", "AuthController@register");
?>