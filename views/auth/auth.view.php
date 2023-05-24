<div style="height: 0;">
   <?php 
      foreach ([
        "header/header.view.php", 
        "short-banner/short-banner.view.php"
      ] as $shared) include_once __ROOT__ . "views/shared/" . $shared; 
   ?>
   <main>
      <div class="auth__main">
   <?php list("auth_type" => $auth_type) = $response->getBody();
         if (strtolower($auth_type) === "login") { ?>
         <div class="auth__form login">
            <h3 class="auth__form__title">Đăng nhập</h3>
            <div class="auth__requires">
              <div>
                 <input type="text" name="email-inp" placeholder="Email">
                 <p class="error__title"></p>
              </div>
              <div>
                 <input type="password" name="pwd-inp" placeholder="Mật khẩu">
                 <p class="error__title"></p>
               </div>
              <button class="auth__req__btn signin">ĐĂNG NHẬP</button>
            </div>
            <a class="__link" href="<?= ROOT_CLIENT . "dang-ky" ?>">Đăng ký</a>
            <div class="auth__social__methods">
               <button class="auth__social__method google">
                  <span><ion-icon name="logo-google"></ion-icon></span>
                  Google
               </button>
            </div>
         </div>
 <?php } else { ?>
         <div class="auth__form register">
            <h3 class="auth__form__title">Đăng ký</h3>
            <div class="auth__requires">
               <div>
                  <div>
                     <input type="text" name="name-inp" placeholder="Họ và tên">
                     <p class="error__title"></p>
                  </div>
                  <div>
                     <input type="text" name="phone-inp" placeholder="Điện thoại">
                     <p class="error__title"></p>
                  </div>
                  <div>
                     <input type="text" name="address-inp" placeholder="Địa chỉ">
                     <p class="error__title"></p>
                  </div>
                  <div>
                     <input type="text" name="email-inp" placeholder="Email">
                     <p class="error__title"></p>
                  </div>
               </div>
               <div>
                  <div>
                     <input type="text" name="usr-inp" placeholder="Tên truy cập">
                     <p class="error__title"></p>
                  </div>
                  <div>
                     <input type="password" name="pwd-inp" placeholder="Mật khẩu">
                     <p class="error__title"></p>
                  </div>         
                  <div>
                     <input type="password" name="pwd-repeat-inp" placeholder="Xác nhận mật khẩu">
                     <p class="error__title"></p>
                  </div>
               </div>         
            </div>
            <a class="__link" href="<?= ROOT_CLIENT . "dang-nhap" ?>">Đăng nhập</a>
            <div>
               <button class="auth__req__btn signup"><i class="bi bi-person"></i> ĐĂNG KÝ</button>
               <button class="auth__req__btn refresh"><i class="bi bi-arrow-repeat"></i> LÀM LẠI</a></button>
            </div>
         </div>
         <?php } ?>
      </div>
   </main>
   <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
</div>
<script src="<?= ROOT_CLIENT . "public/scripts/auth7.js" ?>"></script>