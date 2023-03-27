<?php 

	// $app->get("/gio-hang", function() {
	// 	$cart_controller = new CartController();
	// 	if ($cart_controller) $cart_controller->init();
	// 	unset($cart_controller);
	// });

	$router->get("/gio-hang", "CartController@init"); 

	// $app->post("/cart/add", function($req_data) {
	// 	$cart_controller = new CartController();
	// 	if ($cart_controller) {
	// 		$cart_item = array_strtonum($req_data["request_data"]); // standardized data
	// 		$cart_controller->addToCart($cart_item);
	// 		unset($cart_controller);
	// 	} 
	// });
	$router->post("/gio-hang", "CartController@addToCart");

	// $app->get("/cart/remove/:cart_id", function($req_data, $params) {
	// 	$cart_controller = new CartController();
	// 	if ($cart_controller) {
	// 		$cart_id_remove = $params["cart_id"];
	// 		$cart_controller->removeFromCart($cart_id_remove);
	// 		unset($cart_controller);
	// 	}
	// });	

	$router->delete("/gio-hang/:cart_id", "CartController@removeFromCart");

	// $app->put("cart/update", function($req_data) {
	// 	$cart_controller = new CartController();
	// 	if ($cart_controller) {
	// 		$cart_updates = array_strtonum($req_data["request_data"]); 
	// 		$cart_controller->updateCart($cart_updates);
	// 		unset($cart_controller);
	// 	}
	// }); 

	$router->put("/gio-hang/:cart_id", "CartController@updateCart");
?>