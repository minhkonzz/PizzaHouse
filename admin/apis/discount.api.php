<?php 
  $router->get("/quan-ly-uu-dai-dich-vu", "CatalogController@showAllDiscounts");
  $router->get("/quan-ly-uu-dai-dich-vu/tao-uu-dai", "CatalogController@redirectToAddDiscount");
?>