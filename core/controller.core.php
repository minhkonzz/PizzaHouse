<?php 
  class Controller {

    function __construct() {
      if (session_id() === "") session_start();
    }

    public static function view($page_name, $view_path, $data = []) {
      if (file_exists($view_path)) include_once $view_path;
    }
  }
?>
