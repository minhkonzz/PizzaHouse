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

		public static function processVnpayPayment($endpoint, $new_order) {
			$vnp_TmnCode = "WE6AD37V";
			$vnp_HashSecret = "QGJSRPICZPLMFPBJJUQIVQYXYWLXCIMJ";
			$vnp_Returnurl = "http://" . ($_SERVER["SERVER_NAME"] == "localhost" ? "localhost/pizza-complete-version" : $_SERVER["SERVER_NAME"]). "/thanh-toan/resp";
			$vnp_TxnRef = $new_order["id"]; 
			$vnp_Amount = $new_order["total"] * 100;
			$vnp_Locale = "vn"; 
			$vnp_BankCode = "NCB";
			$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; 
			$inputData = array(
				"vnp_Version" => "2.1.0",
				"vnp_TmnCode" => $vnp_TmnCode,
				"vnp_Amount" => $vnp_Amount,
				"vnp_Command" => "pay",
				"vnp_CreateDate" => date('YmdHis'),
				"vnp_CurrCode" => "VND",
				"vnp_BankCode" => $vnp_BankCode,
				"vnp_IpAddr" => $vnp_IpAddr,
				"vnp_Locale" => $vnp_Locale,
				"vnp_OrderInfo" => "pizza_house_order",
				"vnp_OrderType" => "other",
				"vnp_ReturnUrl" => $vnp_Returnurl,
				"vnp_TxnRef" => $vnp_TxnRef,
				"vnp_ExpireDate" => date('YmdHis', strtotime('+15 minutes', strtotime(date("YmdHis"))))
			);

			ksort($inputData);
			$query = "";
			$i = 0;
			$hashdata = "";
			foreach ($inputData as $key => $value) {
				if ($i == 1) $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
				else {
					$hashdata .= urlencode($key) . "=" . urlencode($value);
					$i = 1;
				}
				$query .= urlencode($key) . "=" . urlencode($value) . '&';
			}

			$vnp_Url = $endpoint . "?" . $query;
			if (isset($vnp_HashSecret)) {
				$vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret); 
				$vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
			}
			// header('Location: ' . $vnp_Url);
			return $vnp_Url;
		}

		public static function processMomoPayment($endpoint, $new_order) {
         $partnerCode = 'MOMOBKUN20180529';
         $accessKey = 'klm05TvNBzhg7h7j';
         $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
         $orderInfo = "Thanh toán qua MoMo";
         $amount = $new_order["total"];
         $orderId = $new_order["id"];
         $redirectUrl = __ROOT__ . "thanh-toan/resp";
         $ipnUrl = __ROOT__ . "thanh-toan/resp";
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
         // header('Location: ' . $jsonResult['payUrl']);
			return $jsonResult["payUrl"];
		}
	}
?>