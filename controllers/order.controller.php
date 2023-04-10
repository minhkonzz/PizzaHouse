<?php 
	class OrderController extends Controller {

		function __construct() {
			parent::__construct();
		}

		public function init(Request $req = null, $params = []) {
			parent::view(
				__ROOT__,
				"Pizza House Việt Nam - Thanh toán",
				"checkout/checkout.view.php",
				"checkout/checkout.style.css",
				"bundle.view.php", 
				(new Response())->withJson([
					"payment_methods" => PaymentModel::getAllPaymentMethods(),
					"cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
				])
			);
		}

		// params: $checkout_payload
		public function showMakeOrderResponse(Request $request = null, $params = []) {
			$new_order = new OrderModel([
				"customer_id" => $_SESSION["customer"]["id"], 
				"buyer_name" => $checkout_payload["buyer_name"], 
				"buyer_email" => $checkout_payload["buyer_email"], 
				"buyer_phone" => $checkout_payload["buyer_phone"], 
				"receiver_name" => $checkout_payload["receiver_name"],
				"receiver_phone" => $checkout_payload["receiver_phone"], 
				"receive_address" => $checkout_payload["receive_address"], 
				"take_in_shop" => $checkout_payload["take_in_shop"],
				"district" => $checkout_payload["district"], 
				"city" => $checkout_payload["city"], 
				"ward" => $checkout_payload["ward"], 
				"pay_method_id" => $checkout_payload["pay_method_id"], 
				"note" => $checkout_payload["note"]
			]);
		   $create_order_status = OrderModel::createOrder($new_order);
			parent::view(
				__ROOT__, 
				"Pizza House Việt Nam - Thanh toán", 
				"checkout/checkout.view.php",
				"checkout/checkout.style.css", 
				"bundle.view.php", 
				(new Response())->withJson([
					"cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__,
					"created_order" => $new_order,
					"create_order_status" => $create_order_status
				])
			);
		}
	}
?>
