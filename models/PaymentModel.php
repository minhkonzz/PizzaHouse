<?php 
   // namespace PZHouse\Models; 

	class PaymentModel extends Model {
		public static function getAllPaymentMethods() {
			$res = parent::performQuery([[
				"query_str" => Database::table("tbl_pay_method")
					->select("id", "pay_method", "is_online_pay", "thumbnail", "payment_endpoint", "type")
					->where("is_activated", 1), 
				"is_fetch" => "payment_methods"
			]]);
			return $res["payment_methods"];
		}

		public static function processMomoPayment($endpoint, $new_order) {
         $partnerCode = 'MOMOBKUN20180529';
         $accessKey = 'klm05TvNBzhg7h7j';
         $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
         $orderInfo = "Thanh toán qua MoMo";
         $amount = $new_order->getTotal();
         $orderId = $new_order->getId();
         $redirectUrl = "http://localhost/pizza-complete-version/thanh-toan/resp";
         $ipnUrl = "http://localhost/pizza-complete-version/thanh-toan/resp";
         $extraData = "";
         $requestId = time() . "";
         $requestType = "payWithATM";
         $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
         $signature = hash_hmac("sha256", $rawHash, $secretKey);
         $data = json_encode(array(
				'partnerCode' => $partnerCode,
				'partnerName' => "Test",
				"storeId" => "MomoTestStore",
				'requestId' => $requestId,
				'amount' => $amount,
				'orderId' => $orderId,
				'orderInfo' => $orderInfo,
				'redirectUrl' => $redirectUrl,
				'ipnUrl' => $ipnUrl,
				'lang' => 'vi',
				'extraData' => $extraData,
				'requestType' => $requestType,
				'signature' => $signature
			));
			$req_sender = new RequestSender($endpoint);
         $jsonResult = json_decode($req_sender->post($data, array(
				'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
			)), true);
			unset($req_sender);
         header('Location: ' . $jsonResult['payUrl']);
		}
	}
?>