<?php 
  $router->get("/quan-ly-thuc-don/san-pham", "ProductController@getAllProducts");
  $router->get("/quan-ly-thuc-don/san-pham/:product_id", "ProductController@getProductById");
  $router->post("/quan-ly-thuc-don/san-pham", "ProductController@createNewProduct");
?>