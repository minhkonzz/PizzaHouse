<?php 
   $body = $response->getBody(); 
   $article = $body["article"] ?? null;
?>
<div class="pagetitle">
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-bai-viet" ?>">Quản lý bài viết</a></li>
         <li class="breadcrumb-item active">
            <?= $article ? 
               '<a href="' . ROOT_ADMIN_CLIENT . 'quan-ly-bai-viet/' . $article["id"] . '">' . $article["title"] . '</a>' : 
               '<a href="' . ROOT_ADMIN_CLIENT . 'quan-ly-bai-viet/them-bai-viet">Thêm bài viết</a>' 
            ?>
         </li>
      </ol>
   </nav>
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <h1><?= $article ? $article["title"] : "Thêm bài viết" ?></h1>
   </div>
</div>
<section class="section article fields" <?php if (!empty($article)) echo 'data-article-id="' . $article["id"] . '"' ?>>
   <div class="field__wrapper" data-ident="article-id">
      <input class="custom__field" type="text" disabled <?php if (!empty($article)) echo 'value="' . $article["id"] . '"'?>>
      <label class="field__placeholder">Mã bài viết</label>
   </div>
   <div class="field__wrapper" data-ident="article-title">
      <input class="custom__field" type="text" <?php if (!empty($article)) echo 'value="' . $article["title"] . '"'?>>
      <label class="field__placeholder">Tiêu đề bài viết</label>
   </div> 
   <form id="myForm" method="POST" enctype="multipart/form-data">
      <input type="file" name="file" id="file" />
   </form>
   <div class="field__wrapper txtarea" data-ident="article-desc">
      <input class="custom__field" type="text" <?php if (!empty($article)) echo 'value="' . $article["description"] . '"'?>>
      <label class="field__placeholder">Mô tả bài viết</label>
   </div> 
   <div>
      <p>Nội dung bài viết</p>
      <textarea name="content" id="editor"><?= !empty($article) ? $article["content"] : "" ?></textarea>
   </div>
   <button id="save-article-btn">
      test editor value
   </button>
</section>
<script src="https://cdn.ckeditor.com/ckeditor5/37.1.0/super-build/ckeditor.js"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets.js" ?>"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/article6.js" ?>"></script>