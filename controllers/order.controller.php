<?php 
	class OrderController extends Controller {

		function __construct() {
			parent::__construct();
		}

		public function init(Request $req = null, $params = []) {
			$this->toCheckout($req, $params);
		}

		public function toCheckout(Request $req, $params = []) {
			try {
				$body_response = [
					"cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__, 
					"pay_methods" => PaymentModel::getAllPaymentMethods()
				];
				if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
				parent::view(
					__ROOT__,
					"Pizza House Việt Nam - Thanh toán",
					"checkout/checkout.view.php",
					"checkout/checkout.style.css",
					"bundle.view.php", 
					new Response($body_response)
				);
			} catch (InternalErrorException $e) {
				return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
			}
		}

		public function createNewOrder(Request $req, $params = []) {
			try {
				list("items" => $cart_items, "cart_total" => $cart_total) = $_SESSION[__CART_SESSION_KEY__];
				$new_order = new Order(array_merge(
					["customer_id" => $_SESSION["customer"]["id"] ?? null],
					$req->getPayloads(),
					["order_items" => $cart_items],
					["total" => $cart_total]
				));
				if (!OrderModel::addOrder($new_order)) throw new InternalErrorException();
				return (new Response())->withJson();
			} catch (InternalErrorException $e) {
				return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
			}
		}
	}
?>
