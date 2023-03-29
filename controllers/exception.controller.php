<?php 
  class ExceptionController extends Controller {
    public function handle(Exception $e) {
      $error_view = "views/errors/";
      if ($e instanceof NotFoundException) {
        $error_view .= "404.view.php";
      }
      else if ($e instanceof AccessDeniedException) {
        $error_view .= "403.view.php";
        return;
      } 
      parent::view("Error", $error_view, new Response($e->getCode(), [ "message" => $e->getMessage() ]));
    }
  }
?>