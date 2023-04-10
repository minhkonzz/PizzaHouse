<style><?php include_once "blogs.style.css"; ?></style>
<section class="home__blogs">
  <p class="blogs__title">Các bài viết nổi bật</p>
  <div id="blogs__list">
    <div class="blogs__item">
      <div class="blogs__item__img">
        <img src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/news/chiec-banh-pizza-cay-nhat-the-gioi.jpg?t=1613618698" alt="">
      </div>
      <div class="blogs__item__meta">
        <div>
          <ion-icon name="today-outline"></ion-icon>
          <span>17/02/2023</span>
        </div>
        <span>|</span>
        <div>
          <ion-icon name="eye-outline"></ion-icon>
          <span>38</span>
        </div>
      </div>
      <p class="blogs__item__title">Chiếc bánh pizza cay nhất thế giới có thể khiến lưỡi chảy máu1</p>
      <p class="blogs__item__description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam, soluta temporibus ab doloribus quo nesciunt, dolorum corporis exercitationem ducimus</p>
    </div>
    <div class="blogs__item">
      <div class="blogs__item__img">
        <img src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/news/chiec-banh-pizza-cay-nhat-the-gioi.jpg?t=1613618698" alt="">
      </div>
      <div class="blogs__item__meta">
        <div>
          <ion-icon name="today-outline"></ion-icon>
          <span>17/02/2023</span>
        </div>
        <span>|</span>
        <div>
          <ion-icon name="eye-outline"></ion-icon>
          <span>38</span>
        </div>
      </div>
      <p class="blogs__item__title">Chiếc bánh pizza cay nhất thế giới có thể khiến lưỡi chảy máu2</p>
      <p class="blogs__item__description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam, soluta temporibus ab doloribus quo nesciunt, dolorum corporis exercitationem ducimus</p>
    </div>
    <div class="blogs__item">
      <div class="blogs__item__img">
        <img src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/news/chiec-banh-pizza-cay-nhat-the-gioi.jpg?t=1613618698" alt="">
      </div>
      <div class="blogs__item__meta">
        <div>
          <ion-icon name="today-outline"></ion-icon>
          <span>17/02/2023</span>
        </div>
        <span>|</span>
        <div>
          <ion-icon name="eye-outline"></ion-icon>
          <span>38</span>
        </div>
      </div>
      <p class="blogs__item__title">Chiếc bánh pizza cay nhất thế giới có thể khiến lưỡi chảy máu3</p>
      <p class="blogs__item__description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam, soluta temporibus ab doloribus quo nesciunt, dolorum corporis exercitationem ducimus</p>
    </div>
    <div class="blogs__item">
      <div class="blogs__item__img">
        <img src="https://demo037051.web30s.vn/datafiles/32945/upload/thumb_images/news/chiec-banh-pizza-cay-nhat-the-gioi.jpg?t=1613618698" alt="">
      </div>
      <div class="blogs__item__meta">
        <div>
          <ion-icon name="today-outline"></ion-icon>
          <span>17/02/2023</span>
        </div>
        <span>|</span>
        <div>
          <ion-icon name="eye-outline"></ion-icon>
          <span>38</span>
        </div>
      </div>
      <p class="blogs__item__title">Chiếc bánh pizza cay nhất thế giới có thể khiến lưỡi chảy máu4</p>
      <p class="blogs__item__description">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Laboriosam, soluta temporibus ab doloribus quo nesciunt, dolorum corporis exercitationem ducimus</p>
    </div>
  </div>
  <div class="blogs__nav">
    <button id="blogs__prev-btn" class="blogs__nav-btn"><ion-icon name="chevron-back"></ion-icon></button>
    <button id="blogs__next-btn" class="blogs__nav-btn"><ion-icon name="chevron-forward"></ion-icon></button>
  </div>
</section>
<script>
  $('#blogs__list').slick({
    arrows: true,
    autoplay: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    prevArrow: $('#blogs__prev-btn'),
    nextArrow: $('#blogs__next-btn'),
  });
</script>