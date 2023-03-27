<?php 
  class CartController extends Controller {

    function __construct() {
      parent::__construct();
    }

    public function init() {
      parent::view(
        "Pizza House - Giỏ hàng", 
        __ROOT__ . "views/cart/cart.php", [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ]
      ); 
    }

    public function addToCart($new_item) {
      // foreach ($_SESSION["cart"]["list"] as $cart_id => $cart_item) {
      //   $item_addon_option_ids = array_map(fn($e) => e["addon_val_id"], $cart_item["addons"]);
      //   $new_addon_option_ids = array_map(fn($e) => e["addon_val_id"], $new_item["addons"]);

      //   $d1 = array_diff($item_addon_option_ids, $new_addon_option_ids);
      //   $d2 = array_diff($new_addon_option_ids, $item_addon_option_ids);
      //   if (count($d1) === 0 && count($d2) === 0) {
      //     $_SESSION["cart"]["list"][$cart_id]["qty_add"] += $new_item["qty_add"];
      //     return;
      //   }
      // }
      $_SESSION[__CART_SESSION_KEY__]["list"][uniqid("CART")] = $new_item;
      $_SESSION[__CART_SESSION_KEY__]["cart_total"] = !isset($_SESSION[__CART_SESSION_KEY__]["cart_total"]) ? 
      $new_item["total_price"] * $new_item["qty_add"] : 
      $_SESSION[__CART_SESSION_KEY__]["cart_total"] + ($new_item["total_price"] * $new_item["qty_add"]);
    }

    public function removeFromCart($cart_id_remove) {
      if (isset($_SESSION[__CART_SESSION_KEY__]["list"][$cart_id_remove]) && !empty($_SESSION[__CART_SESSION_KEY__]["list"][$cart_id_remove])) {
        list("total_price" => $total_price, "qty_add" => $qty_add) = $_SESSION[__CART_SESSION_KEY__]["list"][$cart_id_remove];
        $_SESSION[__CART_SESSION_KEY__]["cart_total"] -= $total_price * $qty_add;
        unset($_SESSION[__CART_SESSION_KEY__]["list"][$cart_id_remove]);
      }
      parent::view(
        "Pizza House - Giỏ hàng", 
        __ROOT__ . "views/cart/cart.php", [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__
        ]
      ); 
    }

    public function updateCart($cart_updates) {
      foreach ($cart_updates as $k => $v) {
        if (isset($_SESSION[__CART_SESSION_KEY__]["list"][$k])) {
          $_SESSION[__CART_SESSION_KEY__]["list"][$k]["qty_add"] = $v;
          list("total_price" => $total_price, "qty_add" => $qty_add) = $_SESSION[__CART_SESSION_KEY__]["list"][$k];
          $_SESSION[__CART_SESSION_KEY__]["cart_total"] += $total_price * $qty_add;
        }
      } 
    }
  }
?>