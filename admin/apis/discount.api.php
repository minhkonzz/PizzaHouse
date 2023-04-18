<?php 
  $router->get("/quan-ly-uu-dai-dich-vu", "DiscountController@getAllDiscounts");
  $router->get("/quan-ly-uu-dai-dich-vu/tao-uu-dai", "DiscountController@redirectToAddDiscount");
?>