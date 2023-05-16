<?php 
  $router->get("/quan-ly-nhan-vien", "StaffController@getAllStaff"); 
  $router->get("/quan-ly-nhan-vien/vi-tri", "StaffController@getAllRoles");
  $router->get("/quan-ly-nhan-vien/them-bo-phan", "StaffController@showAddRolePage");
  $router->get("/quan-ly-nhan-vien/bo-phan/0", "StaffController@getUnRoleEmployees");
  $router->get("/quan-ly-nhan-vien/bo-phan/:role_id", "StaffController@getRoleById");
  $router->get("/quan-ly-nhan-vien/bo-phan/:role_id/users", "StaffController@getEmployeesByRoleId");
  $router->post("/quan-ly-nhan-vien/bo-phan", "StaffController@createRole");
  $router->put("/quan-ly-nhan-vien/bo-phan", "StaffController@updateRoleById");
  $router->delete("/quan-ly-nhan-vien/bo-phan/:role_id", "StaffController@deleteRoleById"); 
?>