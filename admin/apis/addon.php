<?php 
  $router->get("/quan-ly-thuc-don/thuoc-tinh", "AddonController@getAllAddons");
  $router->get("/quan-ly-thuc-don/thuoc-tinh/detail", "AddonController@getAllAddonsAndOptions");
  $router->get("/quan-ly-thuc-don/thuoc-tinh/:addon_id", "AddonController@getAddonById");
  $router->post("/quan-ly-thuc-don/thuoc-tinh", "AddonController@createNewAddon");
  $router->put("/quan-ly-thuc-don/thuoc-tinh/:addon_id", "AddonController@updateAddonById");
  $router->delete("/quan-ly-thuc-don/thuoc-tinh/:addon_id", "AddonController@deleteAddonById");
?>