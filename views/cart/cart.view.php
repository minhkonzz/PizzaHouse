<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php",
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared;
  ?>
  <main id="cart-main">
    <p class="cart-main__title">GIỎ HÀNG</p>
    <div class="cart-main__detail">
    <?php 
      if (count($cart_items) > 0) { ?>
      <div class="cart-main__items">
        <?php foreach ($cart_items as $cart_item_id => $cart_item): 
          list("product_image" => $product_image, "product_name" => $product_name, "addons" => $product_addons, "total_price" => $total_price, "qty_add" => $qty_add) = $cart_item; ?>
          <div class="cart-main__item">
            <div class="cart-main__item__overview">
              <img src="<?= ROOT_CLIENT . "public/images/products/" . $product_image ?>" alt="__l">
              <div>
                <p class="cart-main__item__name"><?= $product_name ?></p>
                <p class="cart-main__item__options"><?= implode(", ", $product_addons) ?></p>
              </div>
            </div>
            <div class="cart-main__item__prices">
              <p class="cart-main__item__price-origin">Đơn giá: <?= number_format($total_price) ?>đ</p>
              <div class="cart-main__item__qty">
                <span style="font-size: 13px; font-weight: 600;">Số lượng</span>
                <input data-cart-id="<?= $cart_item_id ?>" class="cart-qty-inp" style="border: .5px solid gray; margin-left: 8px; padding: 10px 8px; width: 100px;" type="number" value="<?= $qty_add ?>" min="1" max="100">
              </div>
              <p style="font-size: 13px; font-weight: 600; margin: 12px 0;">Thành tiền: <?= number_format($total_price * $qty_add) ?>đ</p>
            </div>
            <div style="padding: 0 22px;">
              <button class="remove-cart-item-btn" data-cart-id="<?= $cart_item_id ?>" style="color: var(--primary-color); font-size: 24px;"><ion-icon name="trash"></ion-icon></button>
            </div>
          </div>
        <?php endforeach ?>
      </div>
      <?php } else echo '<p style="text-align: center; opacity: .6;">Không có dữ liệu</p>' ?>
      <div style="margin-top: 20px; align-self: flex-end; text-align: right;">
        <button id="update-cart-btn" style="padding: 14px 20px; background-color: var(--primary-color); margin-bottom: 60px;">CẬP NHẬT GIỎ HÀNG</button>
        <p style="font-size: 16px; color: var(--primary-color); font-weight: 600;">Tạm tính: <?= number_format($cart_total) ?>đ</p>
        <div style="margin-top: 20px;">
          <button style="padding: 14px 20px; background-color: var(--primary-color); margin-right: 10px;"><a style="color: #fff; font-weight: 600;">XEM THÊM SẢN PHẨM</a></button>
          <button style="padding: 14px 20px; background-color: var(--primary-color);"><a href="<?= ROOT_CLIENT . "thanh-toan" ?>" style="color: #fff; font-weight: 600;">THANH TOÁN</a></button>
        </div>
      </div>
    </div>
  </main>
  <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
</div>  
<script src="<?= ROOT_CLIENT . "public/scripts/cart/cart.js" ?>"></script>