<?php 
  class ArticleController extends Controller {
    function __construct() {
      parent::__construct();
    }

    public function init(Request $req = null, $params = []) {
      parent::view(
        __ROOT__,
        "Pizza House Việt Nam - Bài viết nổi bật", 
        "articles/articles.view.php",
        "articles/articles.style.css",
        "bundle.view.php",
        new Response([
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__, 
          "articles" => []
        ])
      );
    }
  }
?>