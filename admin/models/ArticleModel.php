<?php 
   class ArticleModel extends Model {
      public static function selectAllArticles() {
         $res = parent::performQuery([[
            "query_str" => Database::table("tbl_article")->select("id", "title", "thumbnail", "description", "views_count"), 
            "is_fetch" => "articles"
         ]]); 
         return $res["articles"];
      }

      public static function selectArticleById($id) {
         $res = parent::performQuery([[
            "query_str" => Database::table("tbl_article")
               ->select("id", "title", "thumbnail", "description", "content")
               ->where("id", ":id"), 
            "is_fetch" => "article", 
            "params" => [ "id" => $id ] 
         ]]);
         return $res["article"][0];
      }

      public static function addArticle($new_article) {
         return parent::performQuery([[
            "query_str" => "INSERT INTO tbl_article (id, title, thumbnail, description, content) VALUES (:id, :title, :thumbnail, :description, :content);", 
            "params" => [
               "id" => $new_article->getId(), 
               "title" => $new_article->getTitle(), 
               "thumbnail" => $new_article->getThumbnail(), 
               "description" => $new_article->getDescription(), 
               "content" => $new_article->getContent()
            ]
         ]]);
      }

      public static function updateArticleById($updated_article) {
         $article_id = $update_article["id"]; 
         unset($updated_article["id"]); 
         return parent::performQuery([[
            "query_str" => "UPDATE tbl_article SET " . implode(", ", array_map(fn($e) => "$e = :$e", array_keys($updated_article))) . " WHERE id = :id", 
            "params" => array_merge(["id" => $article_id], $update_article)
         ]]);
      }

      public static function deleteArticleById($id) {
         return parent::performQuery([[
            "query_str" => "DELETE FROM tbl_article WHERE id = :id", 
            "params" => [ "id" => $id ] 
         ]]);
      }
   }
?>