<?php   
  $router->get("/thuc-don", "MenuController@init"); 
  $router->get("/thuc-don/danh-muc/:category_id", "MenuController@getProductsByCategory");
  $router->get("/thuc-don/:product_id", "MenuController@getProductById");
?>