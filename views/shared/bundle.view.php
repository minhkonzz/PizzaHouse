<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <title><?= $page_name ?></title>
    <style><?php include_once __ROOT__ . "views/global.css"; ?></style>
    <style>
      #content {
        display: none;
      }
      #loading {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        z-index: 100;
        width: 100vw;
        height: 100vh;
        background-color: #fff;
        background-image: url(<?= ROOT_CLIENT . "public/images/front-loading.gif" ?>);
        background-repeat: no-repeat;
        background-position: center;
      }
    </style>
    <?php if (!empty($style_path)) { ?><style><?php include_once $style_path; ?></style> <?php } ?>
    <script 
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" 
      crossorigin="anonymous" 
      referrerpolicy="no-referrer"></script>
    <script src="<?= ROOT_CLIENT . "public/scripts/parallax/parallax.min.js" ?>"></script>
    <script src="<?= ROOT_CLIENT . "public/scripts/parallax/parallax.js" ?>"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script>
      function onReady(cb) {
        var intervalID = window.setInterval(checkReady, 1500);
        function checkReady() {
          if ($("body")[0] !== undefined) {
            window.clearInterval(intervalID);
            cb.call(this);
          }
        }
      }

      function show(id, value) {
        $(`#${id}`).css("display", value ? 'block' : 'none')
      }

      onReady(function () {
        show('content', true);
        show('loading', false);
      });

    </script>
  </head>
  <body>
    <div id="content"><?= $PAGE_CONTENT ?></div>
    <div id="loading"></div>
  </body>
</html>