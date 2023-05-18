<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller;
  // use PZHouse\Core\Request;
  // use PZHouse\Core\Response;

  class ArticleController extends Controller {

    public function init(Request $req, $params = []) {
      parent::view(
        __ROOT__,
        ["title" => "Bài viết nổi bật"], 
        "articles/articles.view.php",
        "articles/articles.style.css",
        "bundle.view.php",
        new Response([
          "articles" => []
        ])
      );
    }
  }
?>