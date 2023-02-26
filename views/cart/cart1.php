<style><?php include "cart1.css"; ?></style>
<div style="height: 0;">
  <?php 
    require_once "./views/header/header.php";
    require_once "./views/short_banner/short_banner.php";
  ?>
  <main style="max-width: 1200px; margin: 80px auto;">
    <p style="text-align: center; font-size: 18px; text-transform: uppercase; font-weight: 700; border-bottom: .8px solid gray; padding: 14px 0;">GIỎ HÀNG</p>
    <!-- List cart items -->
    <div style="display: flex; flex-direction: column;">
      <div>
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: .8px solid rgb(220, 220, 220); padding: 8px 0;">
          <div style="display: flex; align-items: center; column-gap: 1rem;">
            <img width="120" height="120" src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="__l">
            <div>
              <p style="text-transform: uppercase; font-size: 15px; font-weight: 600;">Pizza bò thượng hạng</p>
              <p style="opacity: .8; font-size: 12px; font-weight: 500; margin-top: 6px;">Cỡ lớn, đế mỏng, loại bánh mềm</p>
            </div>
          </div>
          <div>
            <p style="font-size: 13px; font-weight: 600; margin: 12px 0;">Đơn giá: 295.000đ</p>
            <div style="margin: 12px 0;">
              <span style="font-size: 13px; font-weight: 600;">Số lượng</span>
              <input style="border: .5px solid gray; margin-left: 8px; padding: 10px 8px; width: 100px;" type="number" value="2" min="1" max="100">
            </div>
            <p style="font-size: 13px; font-weight: 600; margin: 12px 0;">Thành tiền: 295.000đ</p>
          </div>
          <div style="padding: 0 22px;">
            <button><a style="color: var(--primary-color); font-size: 24px;" href=""><ion-icon name="trash"></ion-icon></a></button>
          </div>
        </div>
        <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: .8px solid rgb(220, 220, 220); padding: 8px 0;">
          <div style="display: flex; align-items: center; column-gap: 1rem;">
            <img width="120" height="120" src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="__l">
            <div>
              <p style="text-transform: uppercase; font-size: 15px; font-weight: 600;">Pizza bò thượng hạng</p>
              <p style="opacity: .8; font-size: 12px; font-weight: 500; margin-top: 6px;">Cỡ lớn, đế mỏng, loại bánh mềm</p>
            </div>
          </div>
          <div>
            <p style="font-size: 13px; font-weight: 600; margin: 12px 0;">Đơn giá: 295.000đ</p>
            <div style="margin: 12px 0;">
              <span style="font-size: 13px; font-weight: 600;">Số lượng</span>
              <input style="border: .5px solid gray; margin-left: 8px; padding: 10px 8px; width: 100px;" type="number" value="2" min="1" max="100"> 
            </div>
            <p style="font-size: 13px; font-weight: 600; margin: 12px 0;">Thành tiền: 295.000đ</p>
          </div>
          <div style="padding: 0 22px;">
            <button><a style="color: var(--primary-color); font-size: 24px;" href=""><ion-icon name="trash"></ion-icon></a></button>
          </div>
        </div>
      </div>
      <div style="margin-top: 60px; align-self: flex-end; text-align: right;">
        <p style="font-size: 16px; color: var(--primary-color); font-weight: 600;">Tạm tính: 350.000đ</p>
        <div style="margin-top: 20px;">
          <button style="padding: 14px 20px; background-color: var(--primary-color); margin-right: 10px;"><a style="color: #fff; font-weight: 600;" href="#">XEM THÊM SẢN PHẨM</a></button>
          <button style="padding: 14px 20px; background-color: var(--primary-color);"><a style="color: #fff; font-weight: 600;" href="#">THANH TOÁN</a></button>
        </div>
      </div>
    </div>
  </main>
  <?php require_once "./views/footer/footer.php";?>
</div>  