<style><?php include "checkout1.css"; ?></style>
<div style="height: 0;">
  <?php 
    require_once "./views/header/header.php";
    require_once "./views/short_banner/short_banner.php";
  ?>
  <main class="checkout">
    <div class="checkout__header">
      <p class="checkout__title">THANH TOÁN</p>
    </div>
    <form class="checkout__main" method="POST" action="">
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
                  <input type="checkbox">
                </div>
              </div>
              <div>
                <p>NGƯỜI NHẬN HÀNG</p>
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_name" placeholder="Họ và tên">
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_phone" placeholder="Điện thoại">
              </div>
            </div>
            <div style="margin-top: 22px;">
              <p style="text-transform: uppercase;">ĐỊA CHỈ NHẬN HÀNG</p>
              <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: 2rem;">
                <input style="width: 100%; padding-left: 12px; height: 40px; border: .8px solid gray;" type="text" name="buyer_address" placeholder="Địa chỉ">
                <select style="width: 100%; height: 40px; border: .8px solid gray;" name="checkout_district">
                  <option>Đống Đa</option>
                </select>
                <select style="width: 100%; height: 40px; border: .8px solid gray;" name="checkout_city">
                  <option>Hà Nội</option>
                </select>
                <select style="width: 100%; height: 40px; border: .8px solid gray;" name="checkout_ward">
                  <option>Nam Đồng</option>
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
            <div>
              <input type="radio" name="checkout_pay_method">
              <label>Thanh toán khi nhận hàng</label>
            </div>
            <div>
              <input type="radio" name="checkout_pay_method">
              <label>Thanh toán trực tuyến</label>
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
              <!-- order item -->
              <div style="border-bottom: .8px solid gray; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                  <img width="50" height="50" src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1614946190">
                  <div style="margin-left: 8px;">
                    <p style="font-size: 12px; font-weight: 700;">Pizza bò Mehico thượng hạng</p>
                    <p style="opacity: .7; font-size: 10px; margin-top: 4px;">Cỡ lớn, đế mỏng, loại bánh mềm</p>
                  </div>
                </div>
                <span style="font-size: 12px;">1x</span>
                <span style="font-size: 12px;">329.000đ</span>
              </div>
              <div style="border-bottom: .8px solid gray; display: flex; justify-content: space-between; align-items: center;">
                <div style="display: flex; align-items: center;">
                  <img width="50" height="50" src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1614946190">
                  <div style="margin-left: 8px;">
                    <p style="font-size: 12px; font-weight: 700;">Pizza bò Mehico thượng hạng</p>
                    <p style="opacity: .7; font-size: 10px; margin-top: 4px;">Cỡ lớn, đế mỏng, loại bánh mềm</p>
                  </div>
                </div>
                <span style="font-size: 12px;">1x</span>
                <span style="font-size: 12px;">329.000đ</span>
              </div>
            </div>
            <div style="padding: 12px 14px; background-color: rgb(220, 220, 220); margin-top: 20px;">
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center; border-bottom: .8px solid gray;">
                <span style="font-size: 13px; font-weight: 500;">Tạm tính</span>
                <span style="font-size: 13px; font-weight: 500; color: var(--primary-color);">329.000đ</span>
              </div>
              <div style="padding: 10px 0; display: flex; justify-content: space-between; align-items: center;">
                <span style="font-weight: 600; font-size: 14px;">Thành tiền</span>
                <span style="font-weight: 600; font-size: 14px; color: var(--primary-color);">329.000đ</span>
              </div>
            </div>
            <textarea style="height: 120px; border: .8px solid gray; margin-top: 20px; width: 100%; padding: 12px; font-size: 12px;" placeholder="Ghi chú"></textarea>
            <div style="display: flex; justify-content: space-between; margin-top: 20px;">
              <input style="padding: 12px 0; border: .8px solid #000; font-weight: 700; text-transform: uppercase; width: 48%;" type="submit" value="Thanh toán">
              <button style="padding: 12px 0; border: .8px solid #000; font-weight: 700; width: 48%"><a style="text-transform: uppercase; text-decoration: none;" href="#">XEM THÊM SẢN PHẨM</a></button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </main>
  <?php require_once "./views/footer/footer.php"; ?>
</div>