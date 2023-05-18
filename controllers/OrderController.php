<?php 
	// namespace PZHouse\Controllers;

	// use PZHouse\Core\Controller; 
	// use PZHouse\Core\Request; 
	// use PZHouse\Core\Response; 
	// use PZHouse\Classes\Order;
	// use PZHouse\Models\PaymentModel; 
	// use PZHouse\Exceptions\InternalErrorException; 

	class OrderController extends Controller {

		private $order = null;

		public function init(Request $req = null, $params = []) {
			$this->toCheckout($req, $params);
		}

		public function toCheckout(Request $req, $params = []) {
			try {
				$body_response = [ "pay_methods" => PaymentModel::getAllPaymentMethods() ];
				if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
				parent::view(
					__ROOT__,
					["title" => "Thanh toán", "path" => ["Trang chủ", "Giỏ hàng", "Thanh toán"]],
					"checkout/checkout.view.php",
					"checkout/checkout.style.css",
					"bundle.view.php", 
					new Response($body_response)
				);
			} catch (InternalErrorException $e) {
				return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
			}
		}

		public function redirectToPaymentResultPage(Request $req, $params = []) {
			try {
				$payloads = $req->getPayloads();
				if (isset($payloads["transId"]) && isset($payloads["resultCode"]) && $payloads["resultCode"] === 0)
					$this->order->setIsPaid(true); 

				$is_paid = $this->order->getIsPaid(); 
				if ($is_paid) {
					if (!OrderModel::addOrder($this->order)) throw new InternalErrorException();
					
				}
				parent::view(
					ROOT_ADMIN, 
					["title" => "Thanh toán", "path" => ["Trang chủ", "Giỏ hàng", "Thanh toán"]],
					"checkout/checkout.view.php",
					"checkout/checkout.style.css",
					"bundle.view.php", 
					new Response(["paid" => $is_paid])
				);
			} catch (InternalErrorException $e) {
				return (new Response([], $e->getCode(), $e->getMessgae()))->withJson();
			}
		}

		public function createNewOrder(Request $req, $params = []) {
			try {
				$payloads = $req->getPayloads();
				list("items" => $cart_items, "cart_total" => $cart_total) = $_SESSION[__CART_SESSION_KEY__];
				$new_order = new Order(array_merge(
					["customer_id" => $_SESSION["customer"]["id"] ?? null],
					$payloads["order"],
					["order_items" => $cart_items],
					["total" => $cart_total]
				));
				if (isset($payloads["online_pay"])) {
					$this->order = $new_order;
					list("endpoint" => $endpoint, "type" => $type) = $payloads["online_pay"]; 
					switch (strtoupper($type)) {
						case "MOMO": {
							PaymentModel::processMomoPayment($endpoint, $new_order); 
							break; 
						}
						case "VNPAY": {
							PaymentModel::processVnpayPayment($endpoint, $new_order);
							break;
						}
					}
				}
				if (!OrderModel::addOrder($new_order)) throw new InternalErrorException();
				return (new Response())->withJson();
			} catch (InternalErrorException $e) {
				return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
			}
		}
	}
?>
