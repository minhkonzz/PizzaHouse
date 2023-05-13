<style><?php include_once "short-banner.style.css"; ?></style>
<div class="banner-short" data-parallax="scroll" data-image-src="http://pizzahouse.themerex.net/wp-content/uploads/2016/08/header_bg.jpg">
  <h2 class="banner-short__title"><?= $page_name["title"] ?></h2>
  <?php if (isset($page_name["path"])) { ?>
  <p class="banner-short__path">
    <?php 
      for ($i = 0; $i < count($page_name["path"]); $i++) {
        echo $page_name["path"][$i]; 
        if ($i < count($page_name["path"]) - 1) 
          echo '<ion-icon name="chevron-forward"></ion-icon>';
      } ?>
  </p>
  <?php } ?>
</div>