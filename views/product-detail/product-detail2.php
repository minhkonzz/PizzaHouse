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
      <div class="product-detail__main">
        <div class="product-detail__images">
          <div class="product-detail__main-image">
            <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
          </div>
          <div class="product-detail__images-list">
            <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
            <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
            <img src="https://demo037051.web30s.vn/datafiles/32945/upload/images/product/pizza-bo-me-hi-co-thuong-hang-a.png?t=1612776651" alt="">
          </div>
        </div>
        <div class="product-detail__main-information">
          <p class="product-detail__name">Pizza gà phô mai thịt heo xông khói</p>
          <p class="product-detail__description">Sốt phô mai, thịt heo, thịt gà, thịt heo muối, phô mai Mozzarelia, cà chua</p>
          <p class="product-detail__category"><b>Danh mục</b>: <span>Pizza</span></p>
          <div class="product-detail__addon">
            <p class="product-detail__addon-name">Kích cỡ</p>
            <ul class="product-detail__addon-options">
              <li>Nhỏ</li>
              <li>Vừa</li>
              <li>Lớn</li>
            </ul>
          </div>
          <p class="product-detail__price"><b>Giá</b>: <span>239.000đ</span></p>
          <div class="product-detail__actions">
            <p>Chọn số lượng</p>
            <div>
              <div class="product-detail__quantity">
                <button class="product-detail__quantity-btn decrease"><ion-icon name="remove"></ion-icon></button>
                <input type="number" value="1" min="1">
                <button class="product-detail__quantity-btn increase"><ion-icon name="add"></ion-icon></button>
              </div>
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

