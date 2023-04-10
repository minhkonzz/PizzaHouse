<?php   
  // $app->get("/thuc-don", function() {
  //   $controller = new MenuController(); 
  //   if (nonnull($controller) && method_exists($controller, "init")) {
  //     $controller->init();
  //     unset($controller);
  //   }
  // });

  $router->get("/thuc-don", "MenuController@init"); 

  // $app->get("/thuc-don/danh-muc/:category_id", function($req_data, $params) {
  //   $controller = new MenuController();
  //   if (nonnull($controller) && method_exists($controller, "showProductsByCategory")) {
  //     $controller->showProductsByCategory($params["category_id"]);
  //     unset($controller);
  //   }
  // });

  $router->get("/thuc-don/danh-muc/:category_id", "MenuController@showProductsByCategory");

  // $app->get("/thuc-don/:product_id", function($req_data, $params) {
  //   $controller = new ProductController();
  //   if (nonnull($controller) && method_exists($controller, "showProductDetail")) {
  //     $controller->showProductDetail($params["product_id"]);
  //     unset($controller);
  //   }
  // });

  $router->get("/thuc-don/san-pham", "ProductController@init");
  $router->get("/thuc-don/:product_id", "MenuController@showProductDetail");
?>