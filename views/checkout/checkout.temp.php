<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php", 
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared; 
  ?>
  <main class="checkout">
    <?php 
      $create_order_status = $data["create_order_status"] ?? null; 
      if (nonnull($create_order_status)) { ?>
      <p style="color: green; font-size: 18px;">Đặt hàng thành công</p>
    <?php } ?>
    <div class="checkout__header">
      <p class="checkout__title">THANH TOÁN</p>
    </div>
    <div class="checkout__main">
      <div class="checkout__main-left">
        <div class="checkout__section">
          <div class="checkout__section__header">
            <ion-icon name="location-outline"></ion-icon>
            <p class="checkout__section__header__title">THÔNG TIN KHÁCH HÀNG</p>
          </div>
          <div class="checkout__section__main">
            <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 2rem;">
              <div>
                <p>NGƯỜI MUA HÀNG</p>
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_name" placeholder="Họ và tên">
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_email" placeholder="Email">
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_phone" placeholder="Điện thoại">
                <div>
                  <label style="font-size: 13px;">Bạn muốn nhận hàng trực tiếp tại shop?</label>
                  <input name="get-in-shop-checker" type="checkbox">
                </div>
              </div>
              <div>
                <p>NGƯỜI NHẬN HÀNG</p>
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="receiver_name" placeholder="Họ và tên">
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="receiver_phone" placeholder="Điện thoại">
              </div>
            </div>
            <div style="margin-top: 22px;">
              <p style="text-transform: uppercase;">ĐỊA CHỈ NHẬN HÀNG</p>
              <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 2rem;">
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_address" placeholder="Địa chỉ">
                <select style="width: 100%; height: 40px; border: .8px solid gray;" name="checkout_district">
                  <option value="Đống Đa">Đống Đa</option>
                  <option value="Cầu Giấy">Cầu Giấy</option>
                  <option value="Long Biên">Long Biên</option>
                </select>
                <select style="width: 100%; height: 40px; border: .8px solid gray;" name="checkout_city">
                  <option value="Hà Nội">Hà Nội</option>
                  <option value="Hồ Chí Minh">Hồ Chí Minh</option>
                </select>
                <select style="width: 100%; height: 40px; border: .8px solid gray;" name="checkout_ward">
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
          <div class="checkout__section__main">
          <?php foreach($data["payment_methods"] as $pay_method): 
            list("id" => $pay_method_id, "pay_method" => $pay_method_name) = $pay_method; ?>
            <div>
              <input type="radio" name="checkout_pay_method" value="<?= $pay_method_id ?>">
              <label><?= $pay_method_name ?></label>
            </div>
          <?php endforeach ?>
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
            <?php list("list" => $cart_items, "cart_total" => $cart_total) = $data["cart"]; ?>
            <div>
            <?php foreach ($cart_items as $cart_item): 
              list("product_name" => $product_name, "product_image" => $product_image, "addons" => $addons, "total_price" => $total_price, "qty_add" => $qty_add) = $cart_item; ?>
              <!-- order item -->
              <div style="border-bottom: .8px solid gray; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                  <img width="50" height="50" src="<?= "./public/images/products/" . $product_image ?>">
                  <div style="margin-left: 8px;">
                    <p style="font-size: 12px; font-weight: 700;"><?= $product_name ?></p>
                    <p style="opacity: .7; font-size: 10px; margin-top: 4px; line-height: 1.5;"><?= implode(", ", array_map(fn($e) => $e["addon_val"], $addons)) ?></p>
                  </div>
                </div>
                <span style="font-size: 12px;"><?= number_format($qty_add) ?>x</span>
                <span style="font-size: 12px;"><?= number_format($total_price) ?>đ</span>
              </div>
            <?php endforeach ?>
            </div>
            <div style="padding: 12px 14px; background-color: rgb(220, 220, 220); margin-top: 20px;">
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center; border-bottom: .8px solid gray;">
                <span style="font-size: 13px; font-weight: 500;">Tạm tính</span>
                <span style="font-size: 13px; font-weight: 500; color: var(--primary-color);"><?= number_format($cart_total) ?>đ</span>
              </div>
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 600; font-size: 14px;">Thành tiền</span>
                <span style="font-weight: 600; font-size: 14px; color: var(--primary-color);"><?= number_format($cart_total) ?>đ</span>
              </div>
            </div>
            <textarea id="checkout__order-note" style="height: 120px; border: .8px solid gray; margin-top: 20px; width: 100%; padding: 12px; font-size: 12px;" placeholder="Ghi chú"></textarea>
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
              <button id="make-order-btn" style="padding: 12px 0; border: .8px solid #000; font-weight: 700; text-transform: uppercase; width: 48%;" type="submit">Thanh toán</button>
              <button style="padding: 12px 0; border: .8px solid #000; font-weight: 700; width: 48%"><a href="./thuc-don" style="text-transform: uppercase; text-decoration: none;">XEM THÊM SẢN PHẨM</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script>
  $(document).ready(() => {
    const p1 = /^[a-zA-ZÀ-ỹ\s]+$/ig
    const p2 = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/ig
    const p3 = /^[a-zA-Z0-9À-ỹ\s]+$/ig
    const p4 = /^[0-9]+$/ig

    $("#make-order-btn").click(() => {
      try {
        const errs = []
        const customerName = $("input[name=buyer_name]").val().match(p1)[0] || (errs.push("Tên người mua hàng không hợp lệ") && "")
        const customerEmail = $("input[name=buyer_email]").val().match(p2)[0] || (errs.push("Email người mua không hợp lệ") && "")
        const customerPhone = $("input[name=buyer_phone]").val().match(p4)[0] || (errs.push("Điện thoại người mua không hợp lệ") && "")
        const shipAddressDetail = $("input[name=buyer_address]").val().match(p3)[0] || (errs.push("Địa chỉ nhận hàng không hợp lệ") && "")
        const checkoutDistrict = $("select[name=checkout_district] option:selected").val()
        const checkoutCity = $("select[name=checkout_city] option:selected").val()
        const checkoutWard = $("select[name=checkout_ward] option:selected").val()
        const receiverName = $("input[name=receiver_name]").val().match(p1)[0] || (errs.push("Tên người nhận hàng không hợp lệ") && "")
        const receiverPhone = $("input[name=receiver_phone]").val().match(p4)[0] || (errs.push("Điện thoại người nhận hàng") && "")
        // console.log("receiver_phone ok")
        const getInShopCheck = $("input[name=get-in-shop-checker][type=checkbox]").prop("checked")
        const payMethodId = $("input[name=checkout_pay_method][type=radio]").val()
        const checkoutOrderNote = $("#checkout__order-note").val().match(p3)[0] || (errs.push("Ghi chú đơn hàng chứa ký tự không hợp lệ") && "")
        if (errs.length > 0) throw new Error(errs.join("\n"))
        $.ajax({
          url: "http://localhost/pizza-complete-version/thanh-toan", 
          method: "POST", 
          data: {
            "buyer_name": customerName, 
            "buyer_email": customerEmail, 
            "buyer_phone": customerPhone, 
            "receive_address": shipAddressDetail, 
            "receiver_name": receiverName, 
            "receiver_phone": receiverPhone, 
            "take_in_shop": getInShopCheck, 
            "district": checkoutDistrict, 
            "city": checkoutCity, 
            "ward": checkoutWard, 
            "pay_method_id": payMethodId,
            "note": checkoutOrderNote
          }
        }).done((response) => {
          console.log("response:", response)
        }).fail((jqXHR, textStatus, errorThrown) => {
          console.log("error:", jqXHR)
        })
      } catch (error) { alert(error.message) }
    })
  })
</script>