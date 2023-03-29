<?php
  $router->get("/dang-nhap", "AuthController@init");
  $router->post("/dang-nhap", "AuthController@login");
?>