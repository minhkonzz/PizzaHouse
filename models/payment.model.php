<?php 
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
	}
?>