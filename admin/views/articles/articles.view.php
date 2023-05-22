<div class="pagetitle">
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
         <li class="breadcrumb-item active"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-bai-viet" ?>">Quản lý bài viết</a></li>
      </ol>
   </nav>
   <div style="display: flex; justify-content: space-between; align-items: center;">
      <h1>Quản lý bài viết</h1>
      <button id="add-article-btn" type="button" class="btn btn-primary">
         <i style="margin-right: 4px;" class="bi bi-plus-circle"></i>
         Thêm bài viết
      </button>
   </div>
</div>
<section class="section articles">
   <?php 
      $articles = $response->getBody();
      if (isset($articles) && count($articles) > 0) { 
      foreach ($articles as $article):
         list("id" => $id, "thumbnail" => $thumbnail, "title" => $title, "description" => $description, "views_count" => $view_counts) = $article; ?>
            <div class="article">
               <div class="thumbnail">
                  <img src="<?= ROOT_CLIENT . "public/images/" . $thumbnail ?>" alt="okta">
                  <div class="actions">
                     <button class="btn view-btn"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-bai-viet/detail/$id" ?>"><i class="bi bi-eye"></i></a></button>
                     <button class="btn remove-btn" data-article-id="<?= $id ?>"><i class="bi bi-trash2"></i></button>
                  </div>
               </div>
               <div class="extra">
                  <p class="title"><?= $title ?></p>
                  <p class="description"><?= substr($description, 0, 50); ?></p>
                  <p class="view-amount">Tổng lượt xem: <?= number_format($view_counts) ?></p>
               </div>
            </div>
   <?php endforeach ?> 
   <?php } else { ?>
      <div class="no-records-notify">
         <i class="bi bi-exclamation-diamond"></i>
         <p>Không có dữ liệu</p>
      </div>
   <?php } ?>
</section>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/articles5.js" ?>"></script>