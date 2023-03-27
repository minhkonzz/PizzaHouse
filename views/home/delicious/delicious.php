<link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css"/>
<script type="text/javascript" src="//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<style><?php include "delicious.css"; ?></style>
<section class="home__delicious">
  <div class="home__delicious-main">
    <div class="home__delicious__titles">
      <p class="home__delicious__titles-above">Liên hệ Order ngay</p>
      <p class="home__delicious__titles-under">Thực đơn Pizza ưa chuộng</p>
    </div>
    <div class="home__delicious__list">
      <button class="home__delicious__prev-button">
        <ion-icon name="return-up-back"></ion-icon>
      </button>
      <div class="home__delicious__items">
        <div class="home__delicious__item">
          <div class="home__delicious__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <div class="home__delicious__item__detail">
            <p class="home__delicious__item__name">Gluten-Free Pasta</p>
            <p class="home__delicious__item__desc">Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra...</p>
            <h3 class="home__delicious__item__price">$19.99</h3>
          </div>
          <button class="home__delicious__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="home__delicious__item">
          <div class="home__delicious__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <div class="home__delicious__item__detail">
            <p class="home__delicious__item__name">Gluten-Free Pasta</p>
            <p class="home__delicious__item__desc">Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra...</p>
            <h3 class="home__delicious__item__price">$19.99</h3>
          </div>
          <button class="home__delicious__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="home__delicious__item">
          <div class="home__delicious__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <div class="home__delicious__item__detail">
            <p class="home__delicious__item__name">Gluten-Free Pasta</p>
            <p class="home__delicious__item__desc">Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra...</p>
            <h3 class="home__delicious__item__price">$19.99</h3>
          </div>
          <button class="home__delicious__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="home__delicious__item">
          <div class="home__delicious__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <div class="home__delicious__item__detail">
            <p class="home__delicious__item__name">Gluten-Free Pasta</p>
            <p class="home__delicious__item__desc">Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra...</p>
            <h3 class="home__delicious__item__price">$19.99</h3>
          </div>
          <button class="home__delicious__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="home__delicious__item">
          <div class="home__delicious__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <div class="home__delicious__item__detail">
            <p class="home__delicious__item__name">Gluten-Free Pasta</p>
            <p class="home__delicious__item__desc">Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra...</p>
            <h3 class="home__delicious__item__price">$19.99</h3>
          </div>
          <button class="home__delicious__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="home__delicious__item">
          <div class="home__delicious__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <div class="home__delicious__item__detail">
            <p class="home__delicious__item__name">Gluten-Free Pasta</p>
            <p class="home__delicious__item__desc">Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra...</p>
            <h3 class="home__delicious__item__price">$19.99</h3>
          </div>
          <button class="home__delicious__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
      </div>
      <button class="home__delicious__next-button">
        <ion-icon name="return-up-forward"></ion-icon>
      </button>
    </div>
  </div>
</section>
<script>
  $('.home__delicious__items').slick({
    arrows: true,
    autoplay: false,
    slidesToShow: 3,
    slidesToScroll: 3,
    prevArrow: $('.home__delicious__prev-button'),
    nextArrow: $('.home__delicious__next-button'),
  });
</script>


        <!-- <div class="home__delicious__item__info">
          <div class="home__delicious__item__detail">
            <p class="product-name"><?= $product->product_name ?></p>
            <div class="product-desc-wrapper">
              <p class="product-desc"><?= $product->descp ?><p>
            </div>
            <p class="product-price"><?= number_format($product->price) ?>đ</p>
          </div>
          <div class="select-btn-wrapper">  
            <a href="../ProductDetail/product_detail.php?id=<?= $product->id ?>" class="select-btn">Xem chi tiết</a>
          </div>
        </div> -->