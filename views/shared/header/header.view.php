<style><?php include "header.css" ?></style>
<header>
   <div class="header-above">
      <div class="header-above__main">
         <div class="header-above__left">
            <span><ion-icon name="alarm"></ion-icon></span>
            <p>Giờ mở cửa: 8h - 21h</p>
         </div>
         <ul class="header-above__center">
            <li><button><ion-icon name="search"></ion-icon></button></li>
            <li><button><ion-icon name="person"></ion-icon></button></li>
            <li><button><ion-icon name="cart"></ion-icon></button></li>
            <li><button><ion-icon name="heart"></ion-icon></button></li>
         </ul>
         <div class="header-above__right">
            <div>
               <span><ion-icon name="person-outline"></ion-icon></span>
               <p>Tài khoản</p>
            </div>
            <div>
               <span><ion-icon name="heart-outline"></ion-icon></span>
               <p>Danh sách yêu thích</p>
            </div>
         </div>
      </div>
   </div>
   <nav>
      <button id="sidebar-nav__btn"><ion-icon name="menu"></ion-icon></button>
      <ul>
         <li><a href="/pizza-complete-version/">TRANG CHỦ</a></li>
         <li><a href="/pizza-complete-version/thuc-don">THỰC ĐƠN</a></li>
         <li><a href="/pizza-complete-version/dich-vu">DỊCH VỤ</a></li>
         <li><a href="/pizza-complete-version/tin-tuc">TIN TỨC</a></li>
      </ul>
      <div class="nav__center">
         <img src="<?= ROOT_CLIENT . "public/images/header_logo.png" ?>">
      </div>
      <div class="nav__right">
         <div class="nav__right__p nav__contact">
            <ion-icon name="call"></ion-icon>
            <span class="nav__right__title">19001984</span>
         </div>
         <?php if ($view_path !== __ROOT__ . "views/cart/cart.view.php") { ?>
         <div class="nav__right__p nav__cart">
            <?php 
               list("items" => $cart_items, "cart_total" => $cart_total) = $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__;
               $cart_qty = array_reduce($cart_items, fn($acc, $cur) => $acc + $cur["qty_add"], 0);
            ?>
            <ion-icon name="cart"></ion-icon>
            <span class="nav__cart__title-md-sm nav__right__title"><?= $cart_qty ?></span>
            <span class="nav__cart__title-lg nav__right__title"><?= $cart_qty ?> số lượng - <?= number_format($cart_total) ?>đ</span>
            <div class="nav__cart__view">
               <div class="cart-main__items">
                  <?php 
                     foreach ($cart_items as $cart_item_id => $cart_item): 
                        list("product_image" => $product_image, "product_name" => $product_name, "qty_add" => $qty_add, "addons" => $addons, "total_price" => $total_price) = $cart_item; ?>
                        <div class="nav__cart-item">
                           <img src="<?= ROOT_CLIENT . "public/images/products/" . $product_image ?>" alt="__k">
                           <div class="nav__cart-item__detail">
                           <p><?= $product_name ?> x <?= number_format($qty_add) ?></p>
                           <p><?= implode(", ", $addons) ?></p>
                           <p><?= number_format($total_price) ?>đ</p>
                           </div>
                           <button class="remove-cart-item-btn" data-cart-id="<?= $cart_item_id ?>"><ion-icon name="trash"></ion-icon></button>
                        </div>
                  <?php endforeach ?>
               </div>
               <div class="nav__cart__total">
                  <span>Tổng tiền:</span>
                  <span><?= number_format($cart_total) ?>đ</span>
               </div>
               <div class="nav__cart__options">
                  <button class="nav__cart__option"><a href="./gio-hang" href="#">GIỎ HÀNG</a></button>
                  <button class="nav__cart__option"><a href="./thanh-toan" href="#">THANH TOÁN</a></button>
               </div>
            </div>
         </div>
         <?php } ?>
         <div class="nav__right__p nav__user">
            <button class="nav__login">Liên hệ đặt bàn</button>
         </div>
      </div>
   </nav>
</header>
<script src="<?= ROOT_CLIENT . "public/scripts/cart.js" ?>"></script>