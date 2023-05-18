<?php 
   class ArticleController extends Controller {
      public function init(Request $req, $params = []) {
         $this->getAllArticles($req, $params);
      }

      public function getAllArticles(Request $req, array $params = []) {
         try {
            // $articles = ArticleModel::selectAllArticles(); 
            // if (parent::isJsonOnly($req, $articles)) return (new Response($articles))->withJson();
            parent::view(
               ROOT_ADMIN, 
               ["title" => "Quản lý bài viết"],
               "articles/articles.view.php", 
               "articles/articles.style.css", 
               "bundle.view.php", 
               new Response()
            );
         } catch (InternalErrorException $e) {  
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      }

      // public function getArticleById(Request $req, array $params = []) {
      //    try {

      //    } catch (InternalErrorException $e) {
      //       return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      //    }
      // }
   }
?>