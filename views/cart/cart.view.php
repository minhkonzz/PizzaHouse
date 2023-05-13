<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php",
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared;
  ?>
  <main>
    <div id="cart-main">
      <p class="cart-main__title">GIỎ HÀNG</p>
      <div class="cart-main__detail">
      <?php 
        list("items" => $cart_items, "cart_total" => $cart_total) = $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__;
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
              <div class="cart-main__item__calc">
                <div class="cart-main__item__prices">
                  <div class="cart-main__item__price__part">
                    <span>Đơn giá:</span>
                    <span><?= number_format($total_price) ?>đ</span>
                  </div>
                  <div class="cart-main__item__price__part">
                    <span>Số lượng</span>
                    <input data-cart-id="<?= $cart_item_id ?>" class="cart-qty-inp" style="border: .5px solid gray; margin-left: 8px; padding: 10px 8px; width: 100px;" type="number" value="<?= $qty_add ?>" min="1" max="100">
                  </div>
                  <div class="cart-main__item__price__part">
                    <span>Thành tiền:</span>
                    <span><?= number_format($total_price * $qty_add) ?>đ</span>
                  </div>
                </div>
                <div class="remove-cart-item">
                  <button class="remove-cart-item-btn icon" data-cart-id="<?= $cart_item_id ?>"><ion-icon name="trash"></ion-icon></button>
                  <button class="remove-cart-item-btn norm" data-cart-id="<?= $cart_item_id ?>">
                    <ion-icon name="trash"></ion-icon>
                    Xóa sản phẩm
                  </button>
                </div>
              </div>
            </div>
          <?php endforeach ?>
        </div>
        <?php } else echo '<p style="text-align: center; opacity: .6; margin-top: 15px;">Không có dữ liệu</p>' ?>
        <div class="cart-main__confirm">
          <button class="cart__button" id="update-cart-btn">CẬP NHẬT GIỎ HÀNG</button>
          <p class="cart-main__total">Tạm tính: <?= number_format($cart_total) ?>đ</p>
          <div class="cart__confirm-buttons">
            <button class="cart__button explore-more"><a href="<?= ROOT_CLIENT . "thuc-don" ?>">XEM THÊM SẢN PHẨM</a></button>
            <button class="cart__button"><a href="<?= ROOT_CLIENT . "thanh-toan" ?>">THANH TOÁN</a></button>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
</div>  