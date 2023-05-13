<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title><?= PAGE_TITLE_PREFIX . $page_name["title"] ?></title>
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.snow.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/quill/1.3.7/quill.bubble.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/2.5.0/remixicon.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css">
    <style><?= include_once __ROOT__ . "views/global.css"; ?></style>
    <?php if (file_exists($style_path)) { ?><style><?php include_once $style_path; ?></style> <?php } ?>
    <?php 
      foreach (["style", "reuse", "reset", "custom"] as $css): ?>
        <style><?php include_once ROOT_ADMIN . "public/css/" . $css . ".css"; ?></style>
      <?php endforeach ?>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
  </head>
  <body>
    <?php 
      if (!empty($main_page)) {
        include_once ROOT_ADMIN . "views/shared/header/header.view.php";
        include_once ROOT_ADMIN . "views/shared/nav-sidebar/nav-sidebar.view.php";
      }
    ?>
    <main id="main" class="main"><?= $PAGE_CONTENT ?></main>
    <!-- <p id="alert">Thêm danh mục thành công</p> -->
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/6.3.2/tinymce.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
  <script src="https://cdn.quilljs.com/0.16.0/quill.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
  <script><?php include_once ROOT_ADMIN . "public/vendor/php-email-form/validate.js"; ?></script>
  <script><?php include_once ROOT_ADMIN . "public/js/main.js"; ?></script>
</html>