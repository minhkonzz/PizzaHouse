<?php 
	// namespace PZHouse\Controllers;

	// use PZHouse\Core\Controller; 
	// use PZHouse\Core\Request; 
	// use PZHouse\Core\Response; 
	// use PZHouse\Classes\Order;
	// use PZHouse\Models\PaymentModel; 
	// use PZHouse\Exceptions\InternalErrorException; 

	class OrderController extends Controller {

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

		private function isPaid($payloads) {
			if ($_SESSION["ORDER"]["PAYMENT_TYPE"] === "MOMO") {
				return isset($payloads["transId"]) && isset($payloads["resultCode"]) && $payloads["resultCode"] === 0;
			}
			if ($_SESSION["ORDER"]["PAYMENT_TYPE"] === "VNPAY") {
				if (!isset($payloads["vnp_ResponseCode"]) || $payloads["vnp_ResponseCode"] !== "00") return false; 
				$vnp_HashSecret = "QGJSRPICZPLMFPBJJUQIVQYXYWLXCIMJ";
				$vnp_SecureHash = $payloads['vnp_SecureHash'];
				$inputData = array();
				foreach ($payloads as $k => $v) if (substr($k, 0, 4) == "vnp_") $inputData[$k] = $v;
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
				$_SESSION["ORDER"]["EXTRA"]["is_paid"] = $this->isPaid($payloads);
				if ($_SESSION["ORDER"]["EXTRA"]["is_paid"]) if (!OrderModel::addOrder($_SESSION["ORDER"]["EXTRA"])) throw new InternalErrorException();
				$body_response = [
					"paid" => $_SESSION["ORDER"]["EXTRA"]["is_paid"],
					"pay_methods" => PaymentModel::getAllPaymentMethods()
				];
				parent::view(
					__ROOT__, 
					["title" => "Thanh toán", "path" => ["Trang chủ", "Giỏ hàng", "Thanh toán"]],
					"checkout/checkout.view.php",
					"checkout/checkout.style.css",
					"bundle.view.php", 
					new Response($body_response)
				);
				unset($_SESSION["ORDER"]);
				$_SESSION[__CART_SESSION_KEY__] = __CART_INITIAL__;
			} catch (InternalErrorException $e) {
				echo "thrown to InternalErrorException";
				return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
			}
		}

		public function createNewOrder(Request $req, $params = []) {
			try {
				$payloads = $req->getPayloads();
				$customer = isset($_COOKIE["user"]) ? json_decode($_COOKIE["user"]) : null;
				list("items" => $cart_items, "cart_total" => $cart_total) = $_SESSION[__CART_SESSION_KEY__];
				$new_order = new Order(array_merge(
					["customer_id" => $customer !== null ? $customer->id : null],
					$payloads["order"],
					["order_items" => $cart_items],
					["total" => $cart_total]
				));
				$_SESSION["ORDER"]["EXTRA"] = [
					"id" => $new_order->getId(), 
					"customer_id" => $new_order->getCustomerId(),
					"buyer_name" => $new_order->getBuyerName(), 
					"buyer_phone" => $new_order->getBuyerPhone(), 
					"buyer_email" => $new_order->getBuyerEmail(), 
					"receiver_name" => $new_order->getReceiverName(), 
					"receiver_phone" => $new_order->getReceiverPhone(), 
					"receive_address" => $new_order->getReceiveAddress(), 
					"city" => $new_order->getCity(), 
					"district" => $new_order->getDistrict(), 
					"ward" => $new_order->getWard(), 
					"pay_method_id" => $new_order->getPaymentMethodId(), 
					"state_id" => $new_order->getStateId(),
					"note" => $new_order->getNote(), 
					"is_paid" => $new_order->getIsPaid(), 
					"is_take_in_shop" => (int)$new_order->getIsTakeInShop(), 
					"total" => $new_order->getTotal(),
					"order_items" => $new_order->getOrderItems()
				];
				if (isset($payloads["online_pay"])) {
					list("endpoint" => $endpoint, "type" => $type) = $payloads["online_pay"]; 
					$_SESSION["ORDER"]["PAYMENT_TYPE"] = strtoupper($type);
					$payment_url = "";
					switch (strtoupper($type)) {
						case "MOMO": {
							$payment_url .= PaymentModel::processMomoPayment($endpoint, $_SESSION["ORDER"]["EXTRA"]); 
						}
						case "VNPAY": {
							$payment_url .= PaymentModel::processVnpayPayment($endpoint, $_SESSION["ORDER"]["EXTRA"]);
						}
					}
					return (new Response(["payment_url" => $payment_url]))->withJson();
				}
				if (!OrderModel::addOrder($_SESSION["ORDER"]["EXTRA"])) throw new InternalErrorException();
				return (new Response())->withJson();
				echo json_encode($_SESSION["ORDER"]["EXTRA"]);
			} catch (InternalErrorException $e) {
				return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
			}
		}
	}
?>
