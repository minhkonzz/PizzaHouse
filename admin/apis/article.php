<?php 
   $router->get("/quan-ly-bai-viet", "ArticleController@init");
   $router->get("/quan-ly-bai-viet/:article_id", "ArticleController@getArticleById"); 
   $router->put("/quan-ly-bai-viet/:article_id", "ArticleController@updateArticleById");
   $router->post("/quan-ly-bai-viet", "ArticleController@createArticle"); 
   $router->delete("/quan-ly-bai-viet", "ArticleController@deleteArticleById");
?>