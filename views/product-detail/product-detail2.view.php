<div style="height: 0;">
  <?php 
    foreach ([
      "header/header.view.php", 
      "short-banner/short-banner.view.php"
    ] as $shared) include_once __ROOT__ . "views/shared/" . $shared;
  ?>
  <main>
    <div class="product-detail">
      <aside id="aside__main">
        <div class="aside__main__section">
          <p class="aside__title">SẢN PHẨM MỚI NHẤT</p>
          <ul class="aside__main__list new-products">
            <li>
              <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
              <p>PIZZA bò mehico thượng hạng</p>
            </li>
            <li>
              <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
              <p>PIZZA bò mehico thượng hạng</p>
            </li>
            <li>
              <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
              <p>PIZZA bò mehico thượng hạng</p>
            </li>
            <li>
              <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
              <p>PIZZA bò mehico thượng hạng</p>
            </li>
          </ul>
        </div>
        <div class="aside__main__section">
          <p class="aside__title">TIN TỨC CẬP NHẬT</p>
          <ul class="aside__main__list articles">
            <li>
              <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
              <p>Đố bạn biết, vì sao pizza có hình tròn nhưng lại được đựng trong hộp vuông và cắt theo hình tam giác?</p>
            </li>
            <li>
              <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
              <p>Đố bạn biết, vì sao pizza có hình tròn nhưng lại được đựng trong hộp vuông và cắt theo hình tam giác?</p>
            </li>
          </ul>
        </div>
      </aside>
      <?php 
        list("product" => $product) = $response->getBody();
        list(
          "product_name" => $product_name, 
          "category_name" => $category_name, 
          "price" => $price, 
          "image" => $image, 
          "description" => $description, 
          "addons" => $addons
        ) = $product;
      ?>
      <div class="product-detail__main" data-product="<?= htmlspecialchars(json_encode($product), ENT_QUOTES, "UTF-8") ?>">
        <div class="product-detail__images">
          <div class="product-detail__main-image">
            <img src="<?= ROOT_CLIENT . "public/images/products/" . $image ?>" alt="">
          </div>
          <div class="product-detail__images-list">
            <img src="<?= ROOT_CLIENT . "public/images/products/" . $image ?>" alt="">
          </div>
        </div>
        <div class="product-detail__main-information">
          <p class="product-detail__name"><?= $product_name ?></p>
          <p class="product-detail__description"><?= $description ?></p>
          <p class="product-detail__category"><b>Danh mục</b>: <span><?= $category_name ?></span></p>
          <?php 
            foreach ($addons as $addon_id => $addon_meta): 
              list("addon_name" => $addon_name, "apply_product_price" => $apply_product_price, "addon_options" => $addon_options) = $addon_meta; ?>
              <div class="product-detail__addon">
                <p class="product-detail__addon-name"><?= $addon_name ?></p>
                <ul class="product-detail__addon-options">
                  <?php 
                    foreach ($addon_options as $addon_val_id => $addon_val_meta): 
                      list("addon_val" => $addon_val, "addon_val_price" => $addon_val_price) = $addon_val_meta;
                      $data_addon_selection = json_encode([
                        "addon_id" => $addon_id,
                        "addon_val_id" => $addon_val_id, 
                        "addon_val" => $addon_val,
                        "addon_val_price" => $addon_val_price, 
                        "apply_product_price" => $apply_product_price
                      ]); ?>
                      <li><button class="product-detail__addon-option" data-addon="<?= htmlspecialchars($data_addon_selection, ENT_QUOTES, "UTF-8") ?>" ><?= $addon_val ?></button></li>
                  <?php endforeach ?>
                </ul>
              </div>
          <?php endforeach ?>
          <p class="product-detail__price"><b>Giá</b>: <span><?= number_format($price) ?></span></p>
          <div class="product-detail__actions">
            <p>Chọn số lượng</p>
            <div>
              <input id="product-detail__quantity" type="number" value="1" min="1">
              <button id="product-detail__add-cart">
                <ion-icon name="cart"></ion-icon>
                Thêm vào giỏ hàng
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
</div>
<script src="<?= ROOT_CLIENT . "public/scripts/product-detail/product-detail1.js"?>"></script>

