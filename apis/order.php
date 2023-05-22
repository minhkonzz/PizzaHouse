<?php 
	$router->get("/thanh-toan", "OrderController@init");
	$router->get("/thanh-toan/resp", "OrderController@redirectToPaymentResultPage");
	$router->post("/thanh-toan", "OrderController@createNewOrder");
	$router->get("/thanh-toan/test-redirect", "OrderController@testRedirect");
?>
