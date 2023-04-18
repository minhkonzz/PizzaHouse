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

    public static function isJsonOnly(Request $req, $body_response) {
      if ($body_response === false) throw new InternalErrorException();
      $requested_payloads = $req->getPayloads();
      return nonnull($requested_payloads) && (int)$requested_payloads["json_only"] === 1;
    }
  }
?>
