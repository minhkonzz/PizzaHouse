<?php 
	// namespace PZHouse\Models;

  	class OrderModel extends Model {
    	public static function addOrder($new_order) { 
			$order_items = $new_order->getOrderItems();
			$customer_id = $new_order->getCustomerId();
      $queries = [[
		    "query_str" => $customer_id ? "INSERT INTO tbl_order (id, customer_id, buyer_name, buyer_email, buyer_phone, receiver_name, receiver_phone, receive_address, take_in_shop, district, city, ward, order_state_id, pay_method_id, note, total) VALUES (:id, :customer_id, :buyer_name, :buyer_email, :buyer_phone, :receiver_name, :receiver_phone, :receive_address, :take_in_shop, :district, :city, :ward, :order_state_id, :pay_method_id, :note, :total)" : "INSERT INTO tbl_order (id, buyer_name, buyer_email, buyer_phone, receiver_name, receiver_phone, receive_address, take_in_shop, district, city, ward, order_state_id, pay_method_id, note, total) VALUES (:id, :buyer_name, :buyer_email, :buyer_phone, :receiver_name, :receiver_phone, :receive_address, :take_in_shop, :district, :city, :ward, :order_state_id, :pay_method_id, :note, :total)", 
        "params" => $customer_id ? [
    			"id" => $new_order->getId(), 
    			"customer_id" => $new_order->getCustomerId(), 
    			"buyer_name" => $new_order->getBuyerName(), 
    			"buyer_email" => $new_order->getBuyerEmail(), 
    			"buyer_phone" => $new_order->getBuyerPhone(), 
    			"receiver_name" => $new_order->getReceiverName(), 
    			"receiver_phone" => $new_order->getReceiverPhone(), 
    			"receive_address" => $new_order->getReceiveAddress(), 
    			"take_in_shop" => $new_order->getIsTakeInShop(),
    			"district" => $new_order->getDistrict(), 
    			"city" => $new_order->getCity(), 
    			"ward" => $new_order->getWard(), 
    			"order_state_id" => $new_order->getStateId(), 
    			"pay_method_id" => $new_order->getPaymentMethodId(), 
    			"note" => $new_order->getNote(), 
					"total" => $new_order->getTotal()
		    ] : 
				[
    			"id" => $new_order->getId(), 
    			"buyer_name" => $new_order->getBuyerName(), 
    			"buyer_email" => $new_order->getBuyerEmail(), 
    			"buyer_phone" => $new_order->getBuyerPhone(), 
    			"receiver_name" => $new_order->getReceiverName(), 
    			"receiver_phone" => $new_order->getReceiverPhone(), 
    			"receive_address" => $new_order->getReceiveAddress(), 
    			"take_in_shop" => $new_order->getIsTakeInShop(),
    			"district" => $new_order->getDistrict(), 
    			"city" => $new_order->getCity(), 
    			"ward" => $new_order->getWard(), 
    			"order_state_id" => $new_order->getStateId(), 
    			"pay_method_id" => $new_order->getPaymentMethodId(), 
    			"note" => $new_order->getNote(), 
					"total" => $new_order->getTotal()
		    ]
	    ]];  
      $order_item_options = [];
      $queries = array_merge($queries, array_map(function($cart_item, $cart_id) use ($new_order, &$order_item_options) {
        list(
					"product_id" => $product_id, 
					"product_name" => $product_name, 
					"product_image" => $product_image, 
					"category_name" => $category_name,
					"total_price" => $total_price, 
					"qty_add" => $qty_add, 
					"addons" => $addons) = $cart_item;
  	    foreach ($addons as $addon_val) {
  		    array_push($order_item_options, [
  			    "query_str" => "INSERT INTO tbl_order_item_option VALUES (:order_item_id, :addon_val)", 
  			    "params" => [
      				"order_item_id" => $cart_id, 
							"addon_val" => $addon_val
  			    ]
  		    ]);
  	    }
        return [
        	"query_str" => "INSERT INTO tbl_order_item (id, order_id, order_product_name, order_product_image, order_product_category, order_product_price, quantity) VALUES (:id, :order_id, :product_name, :product_image, :product_category, :last_price, :quantity)",
  		    "params" => [
      			"id" => $cart_id,
      			"order_id" => $new_order->getId(), 
						"product_name" => $product_name, 
						"product_image" => $product_image, 
						"product_category" => $category_name,
						"last_price" => $total_price,
      			"quantity" => $qty_add	
  		    ]
        ];
      }, $order_items, array_keys($order_items)));
      $queries = array_merge($queries, $order_item_options); 
      return parent::performQuery($queries);
    }
  }
?>
