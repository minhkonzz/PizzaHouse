<?php 
  $router->get("/danh-sach-khach-hang", "CustomerController@init");
  $router->get("/danh-sach-khach-hang/:customer_id", "CustomerController@getCustomerById");
?>