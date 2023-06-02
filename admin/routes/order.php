<?php
  $router->get("/quan-ly-dat-hang", "OrderController@init");
  $router->get("/quan-ly-dat-hang/:order_id", "OrderController@getOrderById");
?>