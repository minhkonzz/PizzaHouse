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

		public static function testRedirect() {
			$url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html?vnp_Amount=546000&vnp_BankCode=NCB&vnp_Command=pay&vnp_CreateDate=20230518212031&vnp_CurrCode=VND&vnp_ExpireDate=20230518213531&vnp_IpAddr=%3A%3A1&vnp_Locale=vn&vnp_OrderInfo=Thanh+toan+GD%3A+8742&vnp_OrderType=other&vnp_ReturnUrl=C%3A%2Fxampp%2Fhtdocs%2Fpizza-complete-version%2Fthanh-toan%2Fresp&vnp_TmnCode=Y4U88XFK&vnp_TxnRef=8742&vnp_Version=2.1.0&vnp_SecureHash=6e1aaf7b56a6c0c8d1266660d3e570b6ace7a7ec89d0cd74f3e939b3a3a960578f66962aad1c9da80308e4fa86af7a670a8fe8523c182a04896d44b2c96f1ccf";
   		header("Location: " . $url);
		}

		public static function processVnpayPayment($endpoint, $new_order) {
			$vnp_TmnCode = "Y4U88XFK";
			$vnp_HashSecret = "DTHXNFNBUMNKFKQOZVHTXUXNUQUUXMTV";
			$vnp_Returnurl = __ROOT__ . "thanh-toan/resp";

			$vnp_TxnRef = rand(1, 10000); // Mã giao dịch thanh toán tham chiếu của merchant
			$vnp_Amount = $new_order->getTotal();
			$vnp_Locale = "vn"; 
			$vnp_BankCode = "NCB";
			$vnp_IpAddr = $_SERVER['REMOTE_ADDR']; // IP Khách hàng thanh toán

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
				"vnp_OrderInfo" => "Thanh toan GD: $vnp_TxnRef",
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
			header('Location: ' . $vnp_Url);
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