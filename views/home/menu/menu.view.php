<style><?php include_once "menu.style.css"; ?></style>
<section class="home__menu">
   <?php list("categories" => $categories, "products_by_category" => $products_by_category) = $response->getBody(); ?>
   <div class="home__menu-bg"></div>
   <div class="home__menu-main">
      <div class="header">
         <p class="home__menu-title">Khám phá thực đơn</p>
         <ul class="home__menu-tabs">
   <?php
      foreach ($categories as $category):
         list("id" => $category_id, "category_name" => $category_name) = $category; ?> 
            <li class="home__menu-tab"><button data-category-id="<?= $category_id ?>"><?= $category_name ?></button></li>
   <?php endforeach ?>
         </ul>
      </div>
      <div class="list">
         <button class="home__menu-nav-button" id="prev">
            <ion-icon name="return-up-back"></ion-icon>
         </button>
         <div class="items-container">
            <div class="items">
            <?php 
               foreach ($products_by_category as $product):
                  list("id" => $product_id, "product_name" => $product_name, "price" => $product_price, "image" => $product_image, "description" => $product_desc) = $product ?>
                     <div class="item">
                        <div class="item__image">
                           <img src="<?= ROOT_CLIENT . "public/images/products/" . $product_image ?>" alt="">
                        </div>
                        <p class="item__name"><?= $product_name ?></p>
                        <p class="item__price"><?= number_format($product_price) ?>đ</p>
                        <p class="item__desc"><?= substr($product_desc, 0, 200); ?>...</p>
                        <button class="item__detail-button"><a href="<?= ROOT_CLIENT . "thuc-don/$product_id" ?>">Xem chi tiết</a></button>
                     </div>
            <?php endforeach ?>
            </div>
         </div>
         <button class="home__menu-nav-button" id="next">
            <ion-icon name="return-up-forward"></ion-icon>
         </button>
      </div>
   </div>
</section>
<script src="<?= ROOT_CLIENT . "public/scripts/slick1.js" ?>"></script>