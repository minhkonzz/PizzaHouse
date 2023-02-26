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
        <ion-icon name="cart"></ion-icon>
        <span style="margin-left: 8px;">0 số lượng - 0đ</span>
        <div class="nav__cart__view">
          <div>
            <div style="display: flex; align-items: center; padding: 8px 0; border-bottom: .8px solid gray;">
              <img style="border: .8px solid rgb(230, 230, 230);" width="100" height="100" src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1614946190" alt="__k">
              <div style="margin-left: 8px;">
                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">Pizza gà phô mai thịt heo xông khói x 3</p>
                <p style="margin: 5px 0; font-size: 11px; opacity: .8;">Kích cỡ vừa, đế mỏng</p>
                <p style="margin: 5px 0; font-size: 13px; font-weight: 500; color: var(--primary-color);" >230.000đ</p>
              </div>
              <button><a style="color: var(--primary-color);" href="#"><ion-icon name="trash"></ion-icon></a></button>
            </div>
            <div style="display: flex; align-items: center; padding: 8px 0;">
              <img style="border: .8px solid rgb(230, 230, 230);" width="100" height="100" src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1614946190" alt="__k">
              <div style="margin-left: 8px;">
                <p style="margin: 5px 0; font-weight: 600; font-size: 13px;">Pizza gà phô mai thịt heo xông khói x 3</p>
                <p style="margin: 5px 0; font-size: 11px; opacity: .8;">Kích cỡ vừa, đế mỏng</p>
                <p style="margin: 5px 0; font-size: 13px; font-weight: 500; color: var(--primary-color);" >230.000đ</p>
              </div>
              <button><a style="color: var(--primary-color);" href="#"><ion-icon name="trash"></ion-icon></a></button>
            </div>
          </div>
          <div style="display: flex; justify-content: space-between; align-items: center; border-top: .8px solid gray; border-bottom: .8px solid gray; padding: 20px 0;">
            <span>Tổng tiền:</span>
            <span>879.000đ</span>
          </div>
          <div style="display: flex; justify-content: space-between; margin-top: 10px;">
            <button style="width: 45%; padding: 15px 0; background-color: var(--primary-color);"><a style="color: #fff; text-transform: uppercase; font-size: 14px; font-weight: 600;" href="#">GIỎ HÀNG</a></button>
            <button style="width: 45%; padding: 15px 0; background-color: var(--primary-color);"><a style="color: #fff; text-transform: uppercase; font-size: 14px; font-weight: 600;" href="#">THANH TOÁN</a></button>
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