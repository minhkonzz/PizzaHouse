<?php 
   class Controller {
      public static function view(
        $view_base_path, 
        $page_name, 
        $view_path, 
        $style_path, 
        $layout_path, 
        Response $response, 
        $main_page = true
      ) {
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
         $requested_payloads = $req->getPayloads();
         if (isset($requested_payloads["json_only"])) {
            if ($requested_payloads["json_only"] == 1) return true;
         }
         return false;
      }

      public static function paging($payloads, $total_records) {
         $limit = $payloads["limit"] ?? $total_records <= 20 ? $total_records : 20; 
         $page = $payloads["page"] ?? 1; 
         $total_pages = ceil($total_records / $limit);
         return [
            "total_pages" => $total_pages,
            "limit" => $limit,
            "page" => $page > $total_pages ? $total_pages : ($page < 1 ? 1 : $page)
         ];
      }
   }
?>
