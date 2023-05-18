<?php 
   // namespace PZHouse\Models; 

	class PaymentModel extends Model {
		public static function getAllPaymentMethods() {
			$res = parent::performQuery([[
				"query_str" => Database::table("tbl_pay_method")
					->select("id", "pay_method", "is_online_pay", "thumbnail")
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
         $amount = $order->getTotal();
         $orderId = $new_order->getId();
         $redirectUrl = "http://localhost/pizza-complete-version/thanh-toan/resp";
         $ipnUrl = "http://localhost/pizza-complete-version/thanh-toan/resp";
         $extraData = "";
         $requestId = time() . "";
         $requestType = "payWithATM";
         //before sign HMAC SHA256 signature
         $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;
         $signature = hash_hmac("sha256", $rawHash, $serectkey);
         $data = array('partnerCode' => $partnerCode,
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
				'signature' => $signature);
         $result = execPostRequest($endpoint, json_encode($data));
         $jsonResult = json_decode($result, true);
         header('Location: ' . $jsonResult['payUrl']);
		}
	}
?>