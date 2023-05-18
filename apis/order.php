<?php 
	$router->get("/thanh-toan", "OrderController@init");
	$router->get("/thanh-toan/resp", "OrderController@redirectToPaymentResultPage");
	$router->post("/thanh-toan", "OrderController@createNewOrder");
	$router->post("/thanh-toan/momo", "OnlinePaymentController@momoProcess");
	$router->post("/thanh-toan/vn-pay", "OnlinePaymentController@vnpayProcess");

?>
