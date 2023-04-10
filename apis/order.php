<?php 
	// $app->get("/thanh-toan", function() {
	// 	$controller = new OrderController();
	// 	if (nonnull($controller) && method_exists($controller, "init")) {
	// 		$controller->init();
	// 		unset($controller);
	// 	}
	// });

	$router->get("/thanh-toan", "OrderController@init");

	// $app->post("/thanh-toan", function($req_data) {
	// 	$controller = new OrderController(); 
	// 	if (nonnull($controller) && method_exists($controller, "showMakeOrderResponse")) {
	// 		$checkout_payload = array_strtonum($req_data["request_data"]);
	// 		$_SESSION["customer"]["id"] = "CM001";
	// 		$controller->showMakeOrderResponse($checkout_payload); 
	// 		unset($controller);
	// 	}
	// });

	$router->post("/thanh-toan", "OrderController@showMakeOrderResponse");
?>
