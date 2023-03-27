<?php 
	class PaymentModel extends Model {

		// mapped
		private $pay_method_name; 

		public function setPayMethodName($pay_method_name) {
			$this->pay_method_name = is_string($pay_method_name) ? $pay_method_name : "";
		}

		public function getPayMethodName() { return $this->pay_method_name; }

		function __construct() {
			parent::__construct(PAYMENT_METHOD_ID_PREFIX); 
		}

		// no-mapped
		public static function getAllPaymentMethods() {
			$query_res = parent::performQuery([[
				"query_str" => Database::table("tbl_pay_method")->select("id", "pay_method"), 
				"is_fetch" => "payment_methods"
			]]);
			return $query_res["payment_methods"];
		}
	}
?>