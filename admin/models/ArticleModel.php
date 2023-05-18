<?php 
   class ArticleModel extends Model {
      public static function selectAllArticles() {
         $res = parent::performQuery([[
            "query_str" => "", 
            "is_fetch" => "articles"
         ]]); 
         return $res["articles"];
      }

      public static function selectArticleById($id) {
         $res = parent::performQuery([[
            "query_str" => "", 
            "is_fetch" => "article", 
            "params" => [ "id" => $id ] 
         ]]);
         return $res["article"];
      }
   }
?>