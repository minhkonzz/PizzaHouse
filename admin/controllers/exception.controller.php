<?php 
  class ExceptionController extends Controller {
    public function handle(Exception $e) {
      $error_view = "";
      if ($e instanceof NotFoundException) {
        $error_view .= "errors/404.view.php";
      }
      else if ($e instanceof AccessDeniedException) {
        $error_view .= "errors/403.view.php";
        return;
      } 
      else if ($e instanceof AuthException) {
        $error_view .= "auth/auth.view.php"; 
        return;
      }
      // parent::view("Error", $error_view, new Response($e->getCode(), [ "message" => $e->getMessage() ]));
      echo $e->getMessage();
    }
  }
?>