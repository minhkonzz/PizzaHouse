<?php 
  $router->get("/quan-ly-thuc-don/san-pham", "ProductController@getAllProducts");
  $router->get("/quan-ly-thuc-don/san-pham/:product_id", "ProductController@getProductById");
  $router->put("/quan-ly-thuc-don/san-pham/:product_id", "ProductController@updateProductById");
  $router->post("/quan-ly-thuc-don/san-pham", "ProductController@createNewProduct");
  $router->delete("/quan-ly-thuc-don/san-pham/:product_id", "ProductController@deleteProductById");
?>