<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller;
  // use PZHouse\Exceptions\NotFoundException;
  // use PZHouse\Exceptions\AccessDeniedException; 
  // use PZHouse\Exceptions\AuthException;

  class ExceptionController extends Controller {
    public function handle(Exception $e) {
      $error_view = "";
      if ($e instanceof NotFoundException) {
        $error_view .= "errors/404.view.php";
      }
      else if ($e instanceof AccessDeniedException) {
        $error_view .= "errors/403.view.php";
      } 
      else if ($e instanceof AuthException) {
        $error_view .= "auth/auth.view.php"; 
      }
      parent::view(
        __ROOT__, 
        "Error", 
        $error_view,
        "",
        "bundle.view.php", 
        new Response([], $e->getCode(), $e->getMessage())
      );
    }
  }
?>