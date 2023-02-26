<?php 
  abstract class Controller {

    public static function renderView($page_name, $view_path, $data = []) {
      if (file_exists($view_path)) include_once $view_path;
    }
  }
?>