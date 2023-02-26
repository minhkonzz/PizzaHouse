<style><?php include "product_detail.css"; ?></style>
<div style="height: 0;">
  <?php 
    require_once "./views/header/header.php";
    require_once "./views/short_banner/short_banner.php";
  ?>
  <main class="product-detail">
    <div class="product-detail__about">
      <div class="product-detail__image">
        <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-11.png" alt="">
      </div>
      <form class="product-detail__metadata" method="POST">
        <h2 class="product-detail__price">$19.00 - $24.00</h2>
        <p class="product-detail__description">
          Integer vitae enim vel nisi feugiat ultricies. Phasellus hendrerit pharetra posuere. In hac habitasse platea dictumst. Integer diam nulla, condimentum sit amet pretium id, lobortis vel tellus. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aliquam id.
        </p>
        <div class="product-detail__addons">
          <div class="product-detail__addon">
            <label class="product-detail__input__lb">Dough</label>
            <select name="" id="" class="product-detail__select"></select>
          </div>
          <div class="product-detail__addon">
            <label class="product-detail__input__lb">Size</label>
            <select name="" id="" class="product-detail__select"></select>
          </div>
        </div>
        <div class="product-detail__delivery-date">
          <label class="product-detail__input__lb" for="delivery_date">Delivery date</label>
          <input class="product-detail__date-picker" type="date" name="delivery_date" value="2023-1-27">
        </div>
        <div class="product-detail__confirm">
          <input class="product-detail__qty" type="number" name="product_quantity" min="1" value="1">
          <input class="product-detail__addcart-button" type="submit" value="ADD TO CART">
        </div>
        <div class="product-detail__refs">
          <p>SKU: N/A</p>
          <p>Categories: <span class="hl__primary">Pasta</span>, <span class="hl__primary">Salads</span></p>
          <p>Tags: <span class="hl__primary">appetizer</span>, <span class="hl__primary">dining</span>, <span class="hl__primary">kids menu</span></p>
          <p>Product ID: 289</p>
        </div>
      </form>
      <div class="product-detail__reviews">

      </div>
    </div>
    <div class="product-detail__related-products">
      <h2 class="product-detail__related-products__title">Related products</h2>
      <div class="product-detail__related-products__items">
        <div class="related-products__item">
          <div class="related-products__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <p class="related-products__item__name">Gluten-Free Pasta</p>
          <h3 class="related-products__item__price">$19.99 - $24.00</h3>
          <button class="related-products__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="related-products__item">
          <div class="related-products__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <p class="related-products__item__name">Gluten-Free Pasta</p>
          <h3 class="related-products__item__price">$19.99 - $24.00</h3>
          <button class="related-products__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="related-products__item">
          <div class="related-products__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <p class="related-products__item__name">Gluten-Free Pasta</p>
          <h3 class="related-products__item__price">$19.99 - $24.00</h3>
          <button class="related-products__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
        <div class="related-products__item">
          <div class="related-products__item__image">
            <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="pizza-image">
          </div>
          <p class="related-products__item__name">Gluten-Free Pasta</p>
          <h3 class="related-products__item__price">$19.99 - $24.00</h3>
          <button class="related-products__item__select">
            <a href="#">Xem chi tiết</a> <!-- navigate to detail of product -->
          </button>
        </div>
      </div>
    </div>
  </main>
  <?php require_once "./views/footer/footer.php"; ?>
</div>