<?php 
   class ArticleController extends Controller {
      public function init(Request $req, $params = []) {
         $this->getAllArticles($req, $params);
      }

      public function getAllArticles(Request $req, array $params = []) {
         try {
            $articles = ArticleModel::selectAllArticles(); 
            if (parent::isJsonOnly($req, $articles)) return (new Response($articles))->withJson();
            parent::view(
               ROOT_ADMIN, 
               ["title" => "Quản lý bài viết"],
               "articles/articles.view.php", 
               "articles/articles.style.css", 
               "bundle.view.php", 
               new Response($articles)
            );
         } catch (InternalErrorException $e) {  
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      }

      public function toAddArticle(Request $req, array $params = []) {
         try {
            parent::view(
               ROOT_ADMIN, 
               ["title" => "Thêm bài viết"], 
               "articles/article.view.php", 
               "articles/article.style.css", 
               "bundle.view.php", 
               new Response()
            );
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson(); 
         }
      }

      public function getArticleById(Request $req, array $params = []) {
         try {
            $article = ArticleModel::selectArticleById($params["article_id"]);
            if (parent::isJsonOnly($req, $article)) return (new Response($article))->withJson();
            parent::view(
               ROOT_ADMIN, 
               ["title" => "Bài viết"], 
               "articles/article.view.php", 
               "articles/article.style.css", 
               "bundle.view.php", 
               new Response(["article" => $article])
            );
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      }

      public function createArticle(Request $req, array $params = []) {
         try {
            list("id" => $id, "title" => $title, "thumbnail" => $thumbnail, "description" => $description, "content" => $content) = $req->getPayloads();         
            $new_article = new Article($title, $thumbnail, $description, $content, $id);
            if (!ArticleModel::addArticle($new_article)) throw new InternalErrorException();
            return (new Response())->withJson(); 
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      } 

      public function updateArticleById(Request $req, array $params = []) {
         try {
            if (!ArticleModel::updateArticleById($req->getPayloads())) throw new InternalErrorException(); 
            return (new Response())->withJson();
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      }

      public function deleteArticleById(Request $req, array $params = []) {
         try {
            if (!ArticleModel::deleteArticleById($params["article_id"])) throw new InternalErrorException(); 
            return (new Response())->withJson();
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
         }
      }
   }
?>