<div style="height: 0;">
   <?php 
      foreach ([
        "header/header.view.php", 
        "short-banner/short-banner.view.php"
      ] as $shared) include_once __ROOT__ . "views/shared/" . $shared; 
   ?>
   <main>
      <div class="auth__main">
         <div class="auth__form">
            <h3 class="auth__form__title">Đăng nhập</h3>
            <div class="auth__requires">
              <input type="text" placeholder="Tên truy cập">
              <input type="text" placeholder="Mật khẩu">
              <button class="auth__req__btn">Đăng nhập</button>
            </div>
            <a id="register__link" href="#">Đăng ký</a>
            <div class="auth__social__methods">
               <button class="auth__social__method google">
                  <span><ion-icon name="logo-google"></ion-icon></span>
                  Google
               </button>
            </div>
         </div>
      </div>
   </main>
   <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
</div>