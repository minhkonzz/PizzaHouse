<?php 
  class App {
    // const defaultController = "home";
    // const defaultAction = "init";
    // private static $controller, $action, $params;

    // function __construct() {
    //   App::handleRequest();
    // }

    // private static function handleRequest() {
    //   // $req = array_values(array_filter(explode("/", Router::getActualUrl())));  
    //   $req = array_values(array_filter(explode("/", $_SERVER["PATH_INFO"] ?? "/")));
    //   $controller_name = $req[0] ?? App::defaultController; 
    //   $controller_path = "./controllers/".strtolower($controller_name).".controller.php";
    //   if (!file_exists($controller_path)) {
    //     require_once "./views/404.php";
    //     return;
    //   }
    //   require_once $controller_path;
    //   $controller_class_name = ucfirst($controller_name)."Controller";
    //   if (!class_exists($controller_class_name)) {
    //     require_once "./views/404.php";
    //     return;
    //   }
    //   self::$controller = new $controller_class_name;
    //   if (isset($req[0])) unset($req[0]); 

    //   $action_name = $req[1] ?? App::defaultAction;
    //   self::$action = strtolower($action_name);
    //   if (isset($req[1])) unset($req[1]);

    //   self::$params = array_values($req); 
    //   if ($action_name && method_exists(self::$controller, self::$action)) call_user_func_array([self::$controller, self::$action], self::$params); 
    //   if (!empty($req)) unset($req);
    // }
  }
?>