<?php 
  class ArticleController extends Controller {
    function __construct() {
      parent::__construct();
    }

    public function init(Request $request = null, $params = []) {
      parent::view(
        "PizzaHouse Việt Nam - Bài viết nổi bật", 
        "views/articles/articles.view.php",
        new Response(200, [
          "cart" => $_SESSION[__CART_SESSION_KEY__] ?? __CART_INITIAL__, 
          "articles" => []
        ])
      );
    }

    public function showAllArticles(Request $request = null, $params = []) {}
  }
?>