<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php",
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared;
  ?>
  <main id="menu-main">
    <?php list("categories" => $categories, "addons" => $addons, "products" => $products) = $response->getBody(); ?>
    <aside id="menu-left">
      <div class="menu-left__part categories">
        <div class="menu-left__title"><p>DANH MỤC SẢN PHẨM</p></div>
        <ul class="menu-left__categories__list">
          <?php 
            foreach ($categories as $category): 
              list("id" => $id, "category_name" => $category_name) = $category; ?>
              <li class="menu-left__categories__item"><a href="<?= ROOT_CLIENT . "thuc-don/danh-muc/" . $id ?>"><?= $category_name ?></a></li>
          <?php endforeach ?>
        </ul>
      </div>
      <div class="menu-left__part price-range">
        <div class="menu-left__title"><p>GIÁ SẢN PHẨM</p></div>
      </div>
      <div class="menu-left__part addon-options">
        <div class="menu-left__title"><p>TÍNH NĂNG SẢN PHẨM</p></div>
        <div style="padding: 12px;">
        <?php 
          foreach ($addons as $k => $v): ?>
          <div style="margin-bottom: 20px;">
            <p><?= $v["addon_name"] ?></p>
            <?php 
              foreach ($v["addon_options"] as $addon_option): ?>
              <div style="display: flex; align-items: center; margin-top: 8px;">
                <input style="width: 20px; height: 20px;" type="checkbox">
                <label style="margin-left: 10px; font-size: 14px;"><?= $addon_option["addon_val"] ?></label>
              </div>
            <?php endforeach ?>
          </div>
          <?php endforeach ?>
        </div>
      </div>
      <div class="menu-left__part tags">
        <div class="menu-left__title"><p>TAGS</p></div>
        <ul class="tags__list">
          <li class="tags__item"><a href="#">Pizza</a></li>
          <li class="tags__item"><a href="#">Pizza hải sản thượng hạng</a></li>
          <li class="tags__item"><a href="#">Thức uống</a></li>
        </ul>
      </div>
    </aside>
    <div id="menu-right">
      <div class="menu-right__header">
        <div class="menu-right__menu-per-page">
          <label class="menu-per-page__title" for="_a">Hiển thị</label>
          <select id="menu-per-page__selection" name="menu_size_display">
            <option class="menu-per-page__option" value="8">Mặc định</option>
            <option class="menu-per-page__option" value="12">12</option>
            <option class="menu-per-page__option" value="16">16</option>
          </select>
        </div>
        <div class="menu-right__menu-sorts">
          <label class="menu-sorts__title" for="_b">Sắp xếp theo</label>
          <select id="menu-sorts__selection" name="menu_arrange_type">
            <option class="menu-sorts__option" value="">Mặc định</option>
            <option class="menu-sorts__option" value="">Sắp xếp theo tên (A-Z)</option>
          </select>
        </div>
      </div>
      <div class="menu-right__center">
        <!-- menu item -->
        <?php 
        foreach ($products as $product): ?>
          <div class="menu__item">   
            <div class="menu__item__img-wrapper">
              <a href="">
                <img class="menu__item__img" src="<?= "/pizza-complete-version/public/images/products/" . $product["image"] ?>" alt="">
                <div class="menu__item__actions">
                  <span class="menu__item__action"><ion-icon name="bag-add-outline"></ion-icon></span>
                  <span class="menu__item__action"><ion-icon name="search-outline"></ion-icon></span>
                  <span class="menu__item__action"><ion-icon name="heart-outline"></ion-icon></span>
                </div>
              </a>
            </div>
            <p class="menu__item__name"><?= $product["product_name"] ?></p>
            <p class="menu__item__price"><?= $product["price"] ?></p>
            <p class="menu__item__description"><?= $product["description"] ?></p>
            <button id="menu__item__detail-btn"><a href="/pizza-complete-version/thuc-don/<?= $product["id"] ?>" href="#">Xem chi tiết</a></button>
          </div>
        <?php endforeach ?>
      </div>
      <div class="menu-right__bottom">
        <ul class="menu-right__bottom__page-numbers">
          <li><button class="page-numbers__btn"><a href="#"><ion-icon name="chevron-back-sharp"></ion-icon><ion-icon name="chevron-back-sharp"></ion-icon></a></li>
          <li><button class="page-numbers__btn"><a href="#"><ion-icon name="chevron-back-sharp"></a></button></li>
          <li><button class="page-numbers__btn"><a href="#">1</a></button></li>
          <li><button class="page-numbers__btn"><a href="#">2</a></button></li>
          <li><button class="page-numbers__btn"><a href="#">3</a></button></li>
          <li><button class="page-numbers__btn"><a href="#"><ion-icon name="chevron-forward-sharp"></a></button></li>
          <li><button class="page-numbers__btn"><a href="#"><ion-icon name="chevron-forward-sharp"></ion-icon><ion-icon name="chevron-forward-sharp"></ion-icon></a></button></li>
        </ul>
      </div>
    </div>
  </main>
  <?php include_once __ROOT__ . "views/shared/footer/footer.view.php"; ?>
</div>