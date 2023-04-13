<?php 
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