<?php 
  $router->get("/quan-ly-nhan-vien", "StaffController@getAllStaff"); 
  $router->get("/quan-ly-nhan-vien/vi-tri", "StaffController@getAllRoles");
  $router->get("/quan-ly-nhan-vien/them-bo-phan", "StaffController@showAddRolePage");
?>