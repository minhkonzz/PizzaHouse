<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php", 
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared; 
  ?>
  <main class="checkout">
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
              <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 2rem;">
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
            <div>
              <input type="radio" name="checkout_pay_method" value="">
              <button style="background: #1bbc9b; height: 42px; overflow: hidden; padding: 0 14px 0 0; position: relative; margin-left: 8px;">
                <span style="background: #129b7f; position: absolute; display: block; width: 50px; height: 300px; transform: translate(-40%, -40%) rotate(25deg);"></span>
                <p style="margin-left: 55px; font-size: 14px; color: #fff; font-weight: 700;">Thanh toán khi nhận hàng</p>
              </button>
            </div>
            <div>
              <input type="radio" name="checkout_pay_method" value="">
              <button style="background: #3199d8; height: 42px; overflow: hidden; padding: 0 14px 0 0; position: relative; margin-left: 8px;">
                <span style="background: #1a7cbd; position: absolute; display: block; width: 50px; height: 300px; transform: translate(-40%, -40%) rotate(25deg);"></span>
                <p style="margin-left: 55px; font-size: 14px; color: #fff; font-weight: 700;">Thanh toán trực tuyến</p>
              </button>
              <ul style="width: 320px; background: rgb(240, 240, 240); margin-top: 15px; padding: 0 12px;">
                <li style="position: relative; border-bottom: .8px solid rgb(220, 220, 220); padding: 0 12px; height: 40px;">
                  <div style="position: absolute; display: flex; align-items: center; top: 50%; transform: translateY(-50%);">
                    <input type="radio">
                    <img style="margin-left: 12px;" width="60" src="https://upload.wikimedia.org/wikipedia/commons/thumb/b/b5/PayPal.svg/2560px-PayPal.svg.png" alt="">
                  </div>
                  <p style="position: absolute; right: 8%; font-size: 13px; opacity: .8; top: 50%; transform: translateY(-50%);">Thanh toán qua Paypal</p>
                </li>
                <li></li>
                <li></li>
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
              <div style="border-bottom: .8px solid gray; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                  <img width="50" height="50" src="<?= ROOT_CLIENT . "public/images/products/banh-flan.png" ?>">
                  <div style="margin-left: 8px;">
                    <p style="font-size: 12px; font-weight: 700;">Bánh Flan</p>
                    <p style="opacity: .7; font-size: 12px; margin-top: 4px; line-height: 1.5;">Loại bánh mềm, đế mỏng</p>
                  </div>
                </div>
                <span style="font-size: 12px;">4x</span>
                <span style="font-size: 12px;">75000đ</span>
              </div>
            </div>
            <div style="padding: 12px 14px; background-color: rgb(240, 240, 240); margin-top: 20px;">
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center; border-bottom: .8px solid rgb(210, 210, 210);">
                <span style="font-size: 13px; font-weight: 500;">Tạm tính</span>
                <span style="font-size: 13px; font-weight: 500; color: var(--primary-color);">150000đ</span>
              </div>
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 600; font-size: 14px;">Thành tiền</span>
                <span style="font-weight: 600; font-size: 14px; color: var(--primary-color);">150000đ</span>
              </div>
            </div>
            <textarea id="checkout__order-note" placeholder="Ghi chú"></textarea>
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
              <button id="make-order-btn" type="submit">Thanh toán</button>
              <button id="explore-more-btn"><a href="./thuc-don">XEM THÊM SẢN PHẨM</a></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
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