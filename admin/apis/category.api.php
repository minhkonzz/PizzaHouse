<?php 
  $router->get("/quan-ly-thuc-don/danh-muc", "CategoryController@getAllCategories");
  $router->get("/quan-ly-thuc-don/danh-muc/:category_id", "CategoryController@getCategoryById");
  $router->post("/quan-ly-thuc-don/danh-muc", "CategoryController@createNewCategory");
  $router->put("/quan-ly-thuc-don/danh-muc/:category_id", "CategoryController@updateCategoryById");
  $router->delete("/quan-ly-thuc-don/danh-muc/:category_id", "CategoryController@deleteCategoryById");
?>