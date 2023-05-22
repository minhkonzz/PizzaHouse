<?php 
	// namespace PZHouse\Controllers;

	// use PZHouse\Core\Controller; 
	// use PZHouse\Core\Request; 
	// use PZHouse\Core\Response; 
	// use PZHouse\Classes\Order;
	// use PZHouse\Models\PaymentModel; 
	// use PZHouse\Exceptions\InternalErrorException; 

	class OrderController extends Controller {

		private $order;
		private $payment_type = "COD";

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

		public function testRedirect(Request $req, $params = []) {
			return PaymentModel::testRedirect();
		}

		private function isPaid($payloads) {
			if ($this->payment_type === "MOMO") {
				return isset($payloads["transId"]) && isset($payloads["resultCode"]) && $payloads["resultCode"] === 0;
			}
			if ($this->payment_type === "VNPAY") {
				if (!isset($payloads["vnp_ResponseCode"]) || $payloads["vnp_ResponseCode"] !== "00") return false; 
				$vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";
				$vnp_SecureHash = $payloads['vnp_SecureHash'];
				$inputData = array();
				foreach ($payloads as $k => $v) if (substr($key, 0, 4) == "vnp_") $inputData[$k] = $v;
				unset($inputData['vnp_SecureHash']);
       		ksort($inputData);
        		$i = 0;
        		$hashData = "";
        		foreach ($inputData as $k => $v) {
            	if ($i == 1) $hashData = $hashData . '&' . urlencode($k) . "=" . urlencode($v);
            	else {
               	$hashData = $hashData . urlencode($k) . "=" . urlencode($v);
                	$i = 1;
            	}
        		}
        		$secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
				return $secureHash === $vnp_SecureHash;
			}
			return false;
		}

		public function redirectToPaymentResultPage(Request $req, $params = []) {
			try {
				$payloads = $req->getPayloads();
				$this->order->setIsPaid($this->isPaid($payloads));
				$is_paid = $this->order->getIsPaid(); 
				if ($is_paid) if (!OrderModel::addOrder($this->order)) throw new InternalErrorException();
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
					$this->payment_type = strtoupper($type);
					switch ($this->payment_type) {
						case "MOMO": {
							return PaymentModel::processMomoPayment($endpoint, $new_order); 
						}
						case "VNPAY": {
							return PaymentModel::processVnpayPayment($endpoint, $new_order);
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
