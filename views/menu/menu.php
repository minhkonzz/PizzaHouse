<style><?php include "menu.css"; ?></style>
<div style="height: 0;">
  <?php 
    require_once "./views/header/header.php";
    require_once "./views/short_banner/short_banner.php";
  ?>
  <div class="menu">
    <div class="menu-main">
      <aside class="menu__side-left">
        <div class="menu__side-left__filter-price">
          <div class="menu__side-left__main-part">
            <h3 class="menu__side-left__title">Filter by price</h3>
            <input type="range" name="volume" min="100000" max="300000" step="10000">
            <div class="menu__side-left__filter-price__button__detail">
              <a class="menu__side-left__filter-price__button" href="#">Filter</a>
              <p class="menu__side-left__filter-price__range">Price: $11 - $27</p>
            </div>
          </div>
        </div>
        <hr>
        <div class="menu__side-left__categories">
          <div class="menu__side-left__main-part">
            <h3 class="menu__side-left__title">Categories</h3>
            <ul>
              <?php 
                foreach ($data["categories"] as $category): ?>
                  <li><?= $category["category_name"] ?></li>
              <?php endforeach ?>
            </ul>
          </div>
        </div>
        <hr>
        <div class="menu__side-left__tags">
          <div class="menu__side-left__main-part">
            <h3 class="menu__side-left__title">Tags</h3>
            <ul>
              <li>Appetizer</li>
              <li>Beverages</li>
              <li>Dining</li>
              <li>Events</li>
              <li>Hot</li>
              <li>Kids menu</li>
              <li>Pizza</li>
            </ul>
          </div>
        </div>
      </aside>
      <main class="menu__side-right">
        <div class="menu__side-right-top">
          <div class="menu__side-right-top-left">
            <button class="menu__thumbs-option">
              <ion-icon name="apps-outline"></ion-icon>
            </button>
            <button class="menu__list-option">
              <ion-icon name="list-outline"></ion-icon>
            </button>
            <p class="menu__side-right-top__total-results">Showing 1 - 9 of 10 results</p>
          </div>
          <select>
            <option value="">Default sorting</option>
            <option value="">Sort by popularity</option>
            <option value="">Sort by average rating</option>
            <option value="">Sort by lastest</option>
            <option value="">Sort by price: low to high</option>
            <option value="">Sort by price: high to low</option>
          </select>
        </div>
        <div class="menu__side-right-center">
          <div class="menu__item">
            <div class="menu__item__image">
              <a href="#">
                <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="menu_item_image">
                <span class="menu__item__image__link">
                  <ion-icon name="link"></ion-icon>
                </span>
              </a>
            </div>
            <p class="menu__item__name">Glute-Free Pizza</p>
            <h3 class="menu__item__price">$19.00 - $24.00</h3>
            <a class="menu__item__button" href="#">Select option</a>
          </div>
          <div class="menu__item">
            <div class="menu__item__image">
              <a href="#">
                <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="menu_item_image">
                <span class="menu__item__image__link">
                  <ion-icon name="link"></ion-icon>
                </span>
              </a>
            </div>
            <p class="menu__item__name">Glute-Free Pizza</p>
            <h3 class="menu__item__price">$19.00 - $24.00</h3>
            <a class="menu__item__button" href="#">Select option</a>
          </div>
          <div class="menu__item">
            <div class="menu__item__image">
              <a href="#">
                <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="menu_item_image">
                <span class="menu__item__image__link">
                  <ion-icon name="link"></ion-icon>
                </span>
              </a>
            </div>
            <p class="menu__item__name">Glute-Free Pizza</p>
            <h3 class="menu__item__price">$19.00 - $24.00</h3>
            <a class="menu__item__button" href="#">Select option</a>
          </div>
          <div class="menu__item">
            <div class="menu__item__image">
              <a href="#">
                <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="menu_item_image">
                <span class="menu__item__image__link">
                  <ion-icon name="link"></ion-icon>
                </span>
              </a>
            </div>
            <p class="menu__item__name">Glute-Free Pizza</p>
            <h3 class="menu__item__price">$19.00 - $24.00</h3>
            <a class="menu__item__button" href="#">Select option</a>
          </div>
          <div class="menu__item">
            <div class="menu__item__image">
              <a href="#">
                <img src="https://pizzahouse.themerex.net/wp-content/uploads/2016/08/product-6.png" alt="menu_item_image">
                <span class="menu__item__image__link">
                  <ion-icon name="link"></ion-icon>
                </span>
              </a> 
            </div>
            <p class="menu__item__name">Glute-Free Pizza</p>
            <h3 class="menu__item__price">$19.00 - $24.00</h3>
            <a class="menu__item__button" href="#">Select option</a>
          </div>
        </div>
        <div class="menu__side-right-bottom">
          <ul class="menu__side-right__page-buttons">
            <li class="menu__side-right__page-button"><a href="#">1</a></li>
            <li class="menu__side-right__page-button"><a href="#">2</a></li>
            <li class="menu__side-right__page-button"><a href="#">3</a></li>
          </ul>
        </div>
      </main>
    </div>
  </div>
  <?php require_once "./views/footer/footer.php"; ?>
</div>