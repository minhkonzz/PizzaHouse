<?php 
   class Article extends DataInstance {

      private $title; 
      public function getTitle() {
         return $this->title; 
      }

      private $thumbnail; 
      public function getThumbnail() {
         return $this->thumbnail;
      }

      private $desc;
      public function getDescription() {
         return $this->desc; 
      }

      private $content; 
      public function getContent() {
         return $this->content;
      }

      function __construct($title, $thumbnail, $desc, $content, $id = "") {
         parent::__construct(ARTICLE_ID_PREFIX, $id); 
         $this->title = $title; 
         $this->thumbnail = $thumbnail; 
         $this->desc = $desc; 
         $this->content = $content;
      }
   }
?>