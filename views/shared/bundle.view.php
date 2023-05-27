<!DOCTYPE html>
<html>
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0;">
      <title><?= PAGE_TITLE_PREFIX . $page_name["title"] ?></title>
      <style><?php include_once __ROOT__ . "views/global.css"; ?></style>
      <?php if (file_exists($style_path)) { ?><style><?php include_once $style_path; ?></style> <?php } ?>
      <script 
         src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
         integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
         crossorigin="anonymous" 
         referrerpolicy="no-referrer"></script>
      <script src="<?= ROOT_CLIENT . "public/scripts/parallax/parallax.min.js" ?>"></script>
      <script src="<?= ROOT_CLIENT . "public/scripts/parallax/parallax.js" ?>"></script>
      <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
      <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
      <script src="<?= ROOT_CLIENT . "public/scripts/main2.js" ?>"></script>
      <script src="<?= ROOT_ADMIN_CLIENT . "public/js/common7.js" ?>"></script>
   </head>
   <body>
      <div id="content"><?= $PAGE_CONTENT ?></div>
      <?php include_once __ROOT__ . "views/shared/sidebar-nav/sidebar-nav.view.php"; ?>
      <!-- <div id="loading"></div> -->
      <div id="dialog">
         <div id="spinner" class="center"></div>
         <div id="dialog__main">
            <div class="circle"><div class="checkmark"></div></div>
            <p id="dialog__title"></p>
            <div id="dialog__buttons">
               <button id="close-dialog-btn">Đóng</button>
               <button id="dialog-redirect-btn"><a href="#"></a></button>
            </div>
         </div>
      </div>
   </body>
</html>