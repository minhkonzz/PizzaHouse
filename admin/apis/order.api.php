<?php
  $router->get("/don-hang", "OrderController@showOrderDetail");
  $router->get("/quan-ly-dat-hang", "OrderController@init");
?>