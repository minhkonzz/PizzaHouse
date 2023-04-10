<?php 
  // class Router {
  //   private $supported_http_methods = array("GET", "POST", "PUT", "DELETE");

  //   function __call($method_name, $args) {
  //     list($url_config, $handler) = $args;
  //     if (!in_array(strtoupper($method_name), $this->supported_http_methods)) $this->handeleInvalidRequest();
  //     $rtrim_url = rtrim($url_config);
  //     $this->{strtolower($method_name)}[$rtrim_url === '' ? "/" : $rtrim_url] = $handler;
  //   }

  //   private function getRequestData() {
  //     $req_method = $_SERVER["REQUEST_METHOD"];
  //     $requested_data = $req_method === "GET" || $req_method === "POST" || $req_method === "COOKIE" ? $_REQUEST : json_decode(file_get_contents("php://input"), true);
  //     return [
  //       "request_method" => $req_method, 
  //       "request_data" => $this->sanitizeData($requested_data)
  //     ];
  //   }

  //   private function sanitizeData($data) {
  //     $filters = array(
  //       "string" => FILTER_SANITIZE_STRING,
  //       "int" => FILTER_SANITIZE_NUMBER_INT,
  //       "float" => FILTER_SANITIZE_NUMBER_FLOAT
  //     );
  //     if (is_array($data) || is_object($data)) {
  //       foreach ($data as &$v) {
  //         $type = gettype($v); 
  //         if (isset($filters[$type])) $v = filter_var($v, $filters[$type]);      
  //       }
  //     }
  //     else $data = filter_var($data, FILTER_SANITIZE_SPECIAL_CHARS);
  //     return $data;
  //   }

  //   private function handleDefaultRequest() {
  //     echo "404 not found";
  //   }

  //   private function handleInvalidRequest() {
  //     echo "405 invalid request";
  //   }

  //   function __destruct() {
  //     $method_handlers = $this->{strtolower($_SERVER['REQUEST_METHOD'])};
  //     $req_data = $this->getRequestData();
  //     $req_path = $_SERVER['PATH_INFO'] ?? "/";
  //     foreach($method_handlers as $url_config => $handler) {
  //       $pattern = "@^" . preg_replace('/:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $url_config) . "$@D";
  //       $matches = array();
  //       if ($handler && preg_match($pattern, $req_path, $matches)) {
  //         $params = array();
  //         array_shift($matches);
  //         $t = array_values(array_filter(explode("/", $url_config), function($v, $k) { return substr($v, 0, 1) === ":"; }, ARRAY_FILTER_USE_BOTH));
  //         for ($i = 0; $i < count($t); $i++) $params[ltrim($t[$i], ":")] = $matches[$i];
  //         return call_user_func_array($handler, array($req_data, $params));
  //       }
  //     }
  //     $this->handleDefaultRequest();
  //   }    
  // }
  class Router {
    private $routes = [];
    const SUPPORT_HTTP_METHODS = ["GET", "POST", "PUT", "DELETE"];

    function __call($method_name, $args) {
      $request_method = strtoupper($method_name);
      if (!in_array($request_method, self::SUPPORT_HTTP_METHODS)) 
        $this->handle(__CONTROLLER_ACTION_DEFAULT__, [new MethodNotAllowedException]);
      list($path, $handler) = $args; 
      $rtrim_path = rtrim($path);
      $this->routes[] = [
        "method" => $request_method,
        "path" => $rtrim_path === "" ? "/" : $rtrim_path,
        "handler" => $handler,
        "middlewares" => []
      ];
      return $this;
    }

    public function isMethodNotAllowed(string $request_method) {
      return !in_array($request_method, self::SUPPORT_HTTP_METHODS);
    }
      
    public function applyMiddlewares(...$middlewares) {
      $last_route_idx = count($this->routes) - 1;
      foreach ($middlewares as $middleware)
        $this->routes[$last_route_idx]["middlewares"][] = $middleware;
    } 

    private function handle($handler, $request_bundle) {
      list($controller, $action) = explode("@", $handler);
      $controller = new $controller;
      if (nonnull($controller) && method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], $request_bundle);
        unset($controller);
      }
    }
      
    function __destruct() {
      $request = new Request();
      foreach ($this->routes as $route) {
        list("path" => $path, "method" => $method, "handler" => $handler, "middlewares" => $middlewares) = $route;
        if ($method !== $request->getMethod()) continue;
        $pattern = "@^" . preg_replace('/:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $path) . "$@D";
        preg_match_all('/:([a-zA-Z0-9\_\-]+)/', $path, $param_names);
        if ($handler && preg_match($pattern, $request->getPathInfo(), $matches)) {
          $params = [];
          for ($i = 1; $i < count($matches); $i++) 
            $params[$param_names[1][$i - 1]] = $matches[$i];
          foreach ($middlewares as $middleware) {
            list($accepted_request, $handler) = $middleware->process($request, $handler);
            if (!$accepted_request) break;
          }
          return $this->handle($handler, [$request, $params]);
        }
      }
      return $this->handle(__CONTROLLER_ACTION_DEFAULT__, [new AccessDeniedException]);
    }
  }
?>