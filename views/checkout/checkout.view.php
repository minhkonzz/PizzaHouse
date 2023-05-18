<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php", 
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared; 
  ?>
  <main>
    <div class="checkout__main">
      <div class="checkout__main-left">
        <div class="checkout__section">
          <div class="checkout__section__header">
            <ion-icon name="location-outline"></ion-icon>
            <p class="checkout__section__header__title">THÔNG TIN KHÁCH HÀNG</p>
          </div>
          <div class="checkout__section__main">
            <div class="customer__detail">
              <div>
                <p class="checkout__section__main__title">NGƯỜI MUA HÀNG</p>
                <input type="text" name="buyer_name" placeholder="Họ và tên">
                <input type="text" name="buyer_email" placeholder="Email">
                <input type="text" name="buyer_phone" placeholder="Điện thoại">
                <div style="display: flex; align-items: center; margin-top: 6px;">
                  <label style="font-size: 13px;">Bạn muốn nhận hàng trực tiếp tại shop?</label>
                  <input style="margin-left: 10px;" name="get-in-shop-checker" type="checkbox">
                </div>
              </div>
              <div>
                <p class="checkout__section__main__title">NGƯỜI NHẬN HÀNG</p>
                <input type="text" name="receiver_name" placeholder="Họ và tên">
                <input type="text" name="receiver_phone" placeholder="Điện thoại">
              </div>
            </div>
            <div style="margin-top: 22px;">
              <p class="checkout__section__main__title">ĐỊA CHỈ NHẬN HÀNG</p>
              <div class="address__detail">
                <input type="text" name="buyer_address" placeholder="Địa chỉ">
                <select name="checkout_district">
                  <option value="Đống Đa">Đống Đa</option>
                  <option value="Cầu Giấy">Cầu Giấy</option>
                  <option value="Long Biên">Long Biên</option>
                </select>
                <select name="checkout_city">
                  <option value="Hà Nội">Hà Nội</option>
                  <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                </select>
                <select name="checkout_ward">
                  <option value="Nam Đồng">Nam Đồng</option>
                  <option value="Khâm Thiên">Khâm Thiên</option>
                  <option value="Khương Trung">Khương Trung</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="checkout__section">
          <div class="checkout__section__header">
            <ion-icon name="wallet-outline"></ion-icon>
            <p class="checkout__section__header__title">HÌNH THỨC THANH TOÁN</p>
          </div>
          <div class="checkout__section__main payments">
            <?php list("pay_methods" => $pay_methods) = $response->getBody(); ?>
            <div>
              <?php foreach (array_filter($pay_methods, fn($e) => $e["is_online_pay"] === 0) as $pay_method): 
                list("id" => $pay_method_id, "pay_method" => $method_name) = $pay_method ?>
                <div style="display: flex;">
                  <input type="radio" name="checkout-pay-method" value="<?= htmlspecialchars(json_encode(["pay_method_id" => $pay_method_id])) ?>">
                  <button class="payment-button inst">
                    <span class="payment-button__decor"></span>
                    <p class="payment-button__txt"><?= $method_name ?></p>
                  </button>
                </div>
              <?php endforeach ?>
            </div>
            <div>
              <button class="payment-button onl">
                <span class="payment-button__decor"></span>
                <p class="payment-button__txt">Thanh toán trực tuyến</p>
              </button>
              <ul id="online-payments">
                <?php foreach (array_filter($pay_methods, fn($e) => $e["is_online_pay"] === 1) as $online_pay_method): 
                  list("id" => $online_pay_method_id, "pay_method" => $method_name, "thumbnail" => $pay_method_thumbnail, "payment_endpoint" => $payment_endpoint, "type" => $type) = $online_pay_method ?>
                  <li class="online-payment">
                    <div class="online-payment__select">
                      <input type="radio" name="checkout-pay-method" value="<?= htmlspecialchars(json_encode(["pay_method_id" => $online_pay_method_id, "online_pay" => ["endpoint" => $payment_endpoint, "type" => $type]])) ?>">
                      <img src="<?= ROOT_CLIENT . "public/images/online-pays/" . $pay_method_thumbnail ?>" alt="">
                    </div>
                    <p class="online-payment__txt"><?= $method_name ?></p>
                  </li>
                <?php endforeach ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="checkout__main-right">
        <div class="checkout__section">
          <div class="checkout__section__header">
            <ion-icon name="cart-outline"></ion-icon>
            <p class="checkout__section__header__title">THÔNG TIN ĐƠN HÀNG</p>
          </div>
          <div class="checkout__section__main">
            <!-- list products order -->
            <div>
            <?php 
              foreach ($cart_items as $cart_item):
                list("product_name" => $product_name, "product_image" => $product_image, "addons" => $addons, "total_price" => $total_price, "qty_add" => $qty_add) = $cart_item; ?>
                <div style="border-bottom: .8px solid gray; display: flex; justify-content: space-between; align-items: center;">
                  <div style="display: flex; align-items: center;">
                    <img width="50" height="50" src="<?= ROOT_CLIENT . "public/images/products/" . $product_image ?>">
                    <div style="margin-left: 8px;">
                      <p style="font-size: 12px; font-weight: 700;"><?= $product_name ?></p>
                      <p style="opacity: .7; font-size: 12px; margin-top: 4px; line-height: 1.5;"><?= implode(", ", $addons) ?></p>
                    </div>
                  </div>
                  <span style="font-size: 12px;"><?= $qty_add ?>x</span>
                  <span style="font-size: 12px;"><?= number_format($total_price) ?>đ</span>
                </div>
            <?php endforeach ?>
            </div>
            <div style="padding: 12px 14px; background-color: rgb(240, 240, 240); margin-top: 20px;">
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center; border-bottom: .8px solid rgb(210, 210, 210);">
                <span style="font-size: 13px; font-weight: 500;">Tạm tính</span>
                <span style="font-size: 13px; font-weight: 500; color: var(--primary-color);"><?= number_format($cart_total) ?>đ</span>
              </div>
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 600; font-size: 14px;">Thành tiền</span>
                <span style="font-weight: 600; font-size: 14px; color: var(--primary-color);"><?= number_format($cart_total) ?>đ</span>
              </div>
            </div>
            <textarea id="checkout__order-note" placeholder="Ghi chú"></textarea>
            <div class="checkout__confirm-buttons">
              <button class="checkout__confirm-button" id="make-order-btn" type="submit">Thanh toán</button>
              <button class="checkout__confirm-button" id="explore-more-btn"><a href="<?= ROOT_CLIENT . "thuc-don" ?>">XEM THÊM SẢN PHẨM</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
</div>
<script src="<?= ROOT_CLIENT . "public/scripts/checkout/checkout1.js" ?>"></script>