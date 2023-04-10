<?php 
  class Controller {

    function __construct() {
      if (session_id() === "") session_start();
    }

    public static function view($view_base_path, $page_name, $view_path, $style_path, $layout_path, Response $response, $main_page = true) {
      $view_path = $view_base_path . "views/" . $view_path;
      $layout_path = $view_base_path . "views/shared/" . $layout_path; 
      $style_path = $view_base_path . "views/" . $style_path;
      if (file_exists($view_path) && file_exists($layout_path)) {
        ob_start();
        include_once $view_path;
        $PAGE_CONTENT = ob_get_clean();
        include_once $layout_path;
      }
    }
  }
?>
