<?php 
  // namespace PZHouse\Core;

  // use PZHouse\Core\Request;

  // use PZHouse\Controllers\ArticleController;
  // use PZHouse\Controllers\AuthController;
  // use PZHouse\Controllers\CartController;
  // use PZHouse\Controllers\ContactController;
  // use PZHouse\Controllers\DiscountController;
  // use PZHouse\Controllers\ExceptionController;
  // use PZHouse\Controllers\HomeController;
  // use PZHouse\Controllers\MenuController;
  // use PZHouse\Controllers\OrderController;
  // use PZHouse\Controllers\ServiceController;

  // use PZHouse\Exceptions\NotFoundException;
  // use PZHouse\Exceptions\AccessDeniedException;
  // use PZHouse\Exceptions\MethodNotAllowedException; 

  class Router {
    private $routes = [];
    const SUPPORT_HTTP_METHODS = ["GET", "POST", "PUT", "DELETE"];

    function __call($method_name, $args) {
      $request_method = strtoupper($method_name);
      if (!in_array($request_method, self::SUPPORT_HTTP_METHODS)) $this->handle(__EXCEPTION__, [new MethodNotAllowedException]);
      list($path, $handler) = $args; 
      $rtrim_path = rtrim($path);
      $this->routes[$request_method][$rtrim_path === "" ? "/" : $rtrim_path] = [
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
      $method = $request->getMethod();
      $path_info = $request->getPathInfo();
      if (isset($this->routes[$method])) {
         if (isset($this->routes[$method][$path_info])) {
            list("handler" => $target_handler, "middlewares" => $middlewares) = $this->routes[$method][$path_info];
            foreach ($middlewares as $middleware) {
              $middleware_instance = new $middleware; 
              list($accepted, $handler) = $middleware_instance->process($request, $target_handler);
              if (!$accepted) return $this->handle(__EXCEPTION__, [new AccessDeniedException]);
              if ($handler !== $target_handler) return $this->handle($handler, [$request]);
            }
            return $this->handle($target_handler, [$request]);
         }
         else {
            foreach ($this->routes[$method] as $path => $route) {
               list("handler" => $target_handler, "middlewares" => $middlewares) = $route; 
               $pattern = "@^" . preg_replace('/:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', $path) . "$@D";
               preg_match_all('/:([a-zA-Z0-9\_\-]+)/', $path, $param_names);
               if ($target_handler && preg_match($pattern, $request->getPathInfo(), $matches)) {
                  $params = [];
                  for ($i = 1; $i < count($matches); $i++) $params[$param_names[1][$i - 1]] = $matches[$i];
                  foreach ($middlewares as $middleware) {
                    $middleware_instance = new $middleware; 
                    list($accepted, $handler) = $middleware_instance->process($request, $target_handler);
                    if (!$accepted) return $this->handle(__EXCEPTION__, [new AccessDeniedException]);
                    if ($handler !== $target_handler) return $this->handle($handler, [$request, $params]);
                  }
                  return $this->handle($target_handler, [$request, $params]);
               }        
            }
         }
      }
      return $this->handle(__EXCEPTION__, [new NotFoundException]);
    }
  }
?>