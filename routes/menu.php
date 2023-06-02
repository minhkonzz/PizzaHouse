<?php   
  $router->get("/thuc-don", "MenuController@init"); 
  $router->get("/thuc-don/danh-muc", "MenuController@getAllCategories");
  $router->get("/thuc-don/danh-muc/:category_id", "MenuController@getAllMenuByCategory");
  $router->get("/thuc-don/danh-muc/:category_id/san-pham", "MenuController@getProductsByCategory");
  $router->get("/thuc-don/:product_id", "MenuController@getProductById");
?>