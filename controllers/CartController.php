<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller;
  // use PZHouse\Core\Request; 
  // use PZHouse\Core\Response; 
  // use PZHouse\Exceptions\InternalErrorException;

  class CartController extends Controller {

    public function init(Request $req, $params = []) {
      $this->getCart($req, $params); 
    }

    public function getCart(Request $req, $params = []) {
      try {
        parent::view(
          __ROOT__, 
          [ "title" => "Giỏ hàng", "path" => ["Trang chủ", "Giỏ hàng"]], 
          "cart/cart.view.php", 
          "cart/cart.style.css", 
          "bundle.view.php",
          new Response()
        );      
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function addToCart(Request $req, $params = []) {
      try {
        $new_item = $req->getPayloads(); 
        $existed = false;
        list("product_id" => $product_id, "addons" => $addons, "qty_add" => $new_qty_add) = $new_item;
        foreach ($_SESSION[__CART_SESSION_KEY__]["items"] as $cart_item_id => $cart_item) {
          if ($cart_item["product_id"] !== $product_id) continue;
          $new_item_addon_val_ids = array_keys($addons);
          $cart_item_addon_val_ids = array_keys($cart_item["addons"]);
          if (count(array_diff($new_item_addon_val_ids, $cart_item_addon_val_ids)) === 0 && count(array_diff($cart_item_addon_val_ids, $new_item_addon_val_ids)) === 0) {
            $_SESSION[__CART_SESSION_KEY__]["items"][$cart_item_id]["qty_add"] += $new_qty_add;
            $existed = true; 
          }
        }
        if (!$existed) $_SESSION[__CART_SESSION_KEY__]["items"][uniqid("CART")] = $new_item;
        $_SESSION[__CART_SESSION_KEY__]["cart_total"] = !isset($_SESSION[__CART_SESSION_KEY__]["cart_total"]) ? 
        $new_item["total_price"] * $new_item["qty_add"] : 
        $_SESSION[__CART_SESSION_KEY__]["cart_total"] + ($new_item["total_price"] * $new_item["qty_add"]);
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function removeFromCart(Request $req, $params = []) {
      try {
        $cart_id_remove = $params["cart_id"];
        list("total_price" => $total_price, "qty_add" => $qty_add) = $_SESSION[__CART_SESSION_KEY__]["items"][$cart_id_remove];
        $_SESSION[__CART_SESSION_KEY__]["cart_total"] -= $total_price * $qty_add;
        unset($_SESSION[__CART_SESSION_KEY__]["items"][$cart_id_remove]);
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function updateCart(Request $req, $params = []) {
      try {
        $cart_updates = $req->getPayloads(); 
        foreach ($cart_updates as $k => $v) {
          if (isset($_SESSION[__CART_SESSION_KEY__]["items"][$k])) {
            list("total_price" => $total_price, "qty_add" => $qty_add) = $_SESSION[__CART_SESSION_KEY__]["items"][$k];
            $_SESSION[__CART_SESSION_KEY__]["items"][$k]["qty_add"] = $v;
            $_SESSION[__CART_SESSION_KEY__]["cart_total"] += $total_price * $v - $total_price * $qty_add;
          }
        } 
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>