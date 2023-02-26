<style><?php include "checkout.css"; ?></style>
<div style="height: 0;">
  <?php 
    require_once "./views/header/header.php";
    require_once "./views/short_banner/short_banner.php";
  ?>
  <main class="checkout">
    <div class="checkout-main">
      <div class="checkout__login">
        <div class="checkout__login__header">
          <p class="checkout__login__header__title">
            Returning customer?
            <span class="checkout__login__header__popup-link">Click here to login</span>
          </p>
        </div>
        <form class="checkout__login__main">
          <div class="checkout__login__user-email">
            <label class="checkout__input__lb" for="username-email">Username hoặc email <span style="color: red; font-size: 16px;">*</span></label>
            <input class="checkout__input" type="text" name="username-email">
          </div>
          <div class="checkout__login__password">
            <label class="checkout__input__lb" for="password">Mật khẩu <span style="color: red; font-size: 16px;">*</span></label>
            <input class="checkout__input" type="password" name="password">
          </div>
          <div class="checkout__login__confirm">
            <input class="checkout__login__button" type="submit" value="Đăng nhập">
            <div class="checkout__login__remember">
              <input class="checkout__cb" type="checkbox" name="remember__login">
              <label class="checkout__input__lb" for="remember__login">Ghi nhớ đăng nhập</label>
            </div>
            <p class="checkout__login__recover-password">Lost your password?</p>
          </div>
        </form>
      </div>
      <form class="checkout__detail">
        <div class="checkout__billing">
          <h3 class="checkout__detail__title">Billing details</h3>
          <div class="checkout__billing__name">
            <div class="checkout__billing__fname">
              <label class="checkout__input__lb" for="first_name">First name <span style="color: red; font-size: 16px;">*</span></label>
              <input class="checkout__input" type="text" name="first_name">
            </div>
            <div class="checkout__billing__lname">
              <label class="checkout__input__lb" for="last_name">Last name <span style="color: red; font-size: 16px;">*</span></label>
              <input class="checkout__input" type="text" name="last_name">
            </div>
          </div>
          <div class="checkout__billing__country">
            <label class="checkout__input__lb" for="country">Country <span style="color: red; font-size: 16px;">*</span></label>
            <select class="checkout__select" name="country">
              <option value="vietnam">Việt Nam</option>
              <option value="america">Mỹ</option>
              <option value="china">Trung Quốc</option>
            </select>
          </div>
          <div class="checkout__billing__street">
            <label class="checkout__input__lb" for="street">Street address <span style="color: red; font-size: 16px;">*</span></label>
            <input class="checkout__input" type="text" name="street">
          </div>
          <div class="checkout__billing__zip">
            <label class="checkout__input__lb" for="zip">Post code / ZIP (optional)</label>
            <input class="checkout__input" type="text" name="zip">
          </div>
          <div class="checkout__billing__city">
            <label class="checkout__input__lb" for="city">City <span style="color: red; font-size: 16px;">*</span></label>
            <input class="checkout__input" type="text" name="city">
          </div>
          <div class="checkout__billing__phone">
            <label class="checkout__input__lb" for="phone">Phone <span style="color: red; font-size: 16px;">*</span></label>
            <input class="checkout__input" type="text" name="phone">
          </div>
          <div class="checkout__billing__email">
            <label class="checkout__input__lb" for="email">Email address <span style="color: red; font-size: 16px;">*</span></label>
            <input class="checkout__input" type="text" name="email">
          </div>
          <div class="checkout__billing__create-account">
            <input class="checkout__cb" type="checkbox" name="remember__login">
            <label class="checkout__input__lb" for="remember__login">Tạo tài khoản</label>
          </div>
        </div>
        <div class="checkout__additional">
          <h3 class="checkout__detail__title">Additional Information</h3>
          <div class="checkout__note">
            <label class="checkout__input__lb" for="order__note">Yêu cầu khác (tùy chọn)</label>
            <textarea class="checkout__textarea" name="order__note" placeholder="Thêm ghi chú tại đây"></textarea>
          </div>
        </div>
      </form>
    </div>  
  </main>
  <?php require_once "./views/footer/footer.php"; ?>
</div>