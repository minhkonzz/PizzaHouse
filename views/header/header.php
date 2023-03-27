<style><?php include "header.css" ?></style>
<header>
  <div style="height: 50px; background-color: var(--primary-color);">
    <div style="display: flex; justify-content: space-between; align-items: center; max-width: 1200px; margin: 0 auto; height: 100%;">
      <div style="display: flex; align-items: center; column-gap: 1rem;">
        <span style="font-size: 28px; color: #f4ea8e;"><ion-icon name="alarm"></ion-icon></span>
        <p style="color: #f4ea8e; font-style: italic; font-weight: 600;">Giờ mở cửa: 8h - 21h</p>
      </div>
      <div style="display: flex; column-gap: 2.5rem;">
        <div style="display: flex; align-items: center; column-gap: .6rem;">
          <span style="color: #fff; font-size: 18px;"><ion-icon name="person-outline"></ion-icon></span>
          <p style="color: #fff; font-size: 14px; font-weight: 500;">Tài khoản</p>
        </div>
        <div style="display: flex; align-items: center; column-gap: .6rem;">
          <span style="color: #fff; font-size: 18px;"><ion-icon name="heart-outline"></ion-icon></span>
          <p style="color: #fff; font-size: 14px; font-weight: 500;">Danh sách yêu thích</p>
        </div>
      </div>
    </div>
  </div>
  <nav>
    <ul>
      <li><a href="#">TRANG CHỦ</a></li>
      <li><a href="#">THỰC ĐƠN</a></li>
      <li><a href="#">DỊCH VỤ</a></li>
      <li><a href="#">TIN TỨC</a></li>
    </ul>
    <div class="nav__center">
      <img src="http://pizzahouse.themerex.net/wp-content/uploads/2016/08/logo_main.png">
    </div>
    <div class="nav__right">
      <div class="nav__right__p nav__contact">
        <ion-icon name="call"></ion-icon>
        <span style="margin-left: 8px;">19001984</span>
      </div>
      <div class="nav__right__p nav__cart">
        <?php list("list" => $cart_items, "cart_total" => $cart_total) = $data["cart"]; ?>
        <ion-icon name="cart"></ion-icon>
        <span style="margin-left: 8px;"><?= array_reduce($cart_items, fn($acc, $cur) => $acc + $cur["qty_add"], 0) ?> số lượng - <?= number_format($cart_total) ?>đ</span>
        <div class="nav__cart__view">
          <div>
          <?php 
            foreach ($cart_items as $cart_item): 
              list("product_name" => $product_name, "qty_add" => $qty_add, "addons" => $addons, "total_price" => $total_price) = $cart_item; ?>
              <div style="display: flex; align-items: center; padding: 8px 0; border-bottom: .8px solid gray;">
                <img style="border: .8px solid rgb(230, 230, 230);" width="100" height="100" src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1614946190" alt="__k">
                <div style="margin-left: 8px;">
                  <p style="margin: 5px 0; font-weight: 600; font-size: 13px;"><?= $product_name ?> x <?= number_format($qty_add) ?></p>
                  <p style="margin: 5px 0; font-size: 11px; opacity: .8; line-height: 1.6;"><?= implode(", ", array_map(fn($e) => $e["addon_val"], $addons)) ?></p>
                  <p style="margin: 5px 0; font-size: 13px; font-weight: 500; color: var(--primary-color);" ><?= number_format($total_price) ?>đ</p>
                </div>
                <button><a style="color: var(--primary-color);" href="#"><ion-icon name="trash"></ion-icon></a></button>
              </div>
          <?php endforeach ?>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; border-top: .8px solid gray; border-bottom: .8px solid gray; padding: 20px 0;">
            <span>Tổng tiền:</span>
            <span><?= number_format($cart_total) ?>đ</span>
          </div>
          <div style="display: flex; justify-content: space-between; margin-top: 10px;">
            <button style="width: 45%; padding: 15px 0; background-color: var(--primary-color);"><a href="./gio-hang" style="color: #fff; text-transform: uppercase;font-size: 14px; font-weight: 600;" href="#">GIỎ HÀNG</a></button>
            <button style="width: 45%; padding: 15px 0; background-color: var(--primary-color);"><a href="./thanh-toan" style="color: #fff; text-transform: uppercase; font-size: 14px; font-weight: 600;" href="#">THANH TOÁN</a></button>
          </div>
        </div>
      </div>
      <div class="nav__right__p nav__user">
        <button class="nav__login">Liên hệ đặt bàn</button>
      </div>
    </div>
  </nav>
</header>
<script type="text/javascript">
  window.addEventListener("scroll", function() {
    const headerElement = document.querySelector("header");
    headerElement.classList.toggle("sticky", window.scrollY > 0);
  });
</script>