<?php 

  require_once "request.core.php";

  class Router {

    private $request, $supportedHttpMethods = array("GET", "POST");

    function __construct($request) {
      $this->request = $request;
    }

    function __call($method_name, $args) {
      list($route, $func) = $args; 
      if (!in_array(strtoupper($method_name), $this->supportedHttpMethods)) $this->handleInvalidRequest();
      $this->{strtolower($method_name)}[$this->formatRoute($route)] = $func;
    }

    private function formatRoute($route) {
      $cleaned_route = rtrim($route, "/");
      if ($cleaned_route == '') return "/";
      return $cleaned_route;
    }

    private function handleInvalidRequest() {
      header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function handleDefaultRequest() {
      header("{$this->request->serverProtocol} 404 Not Found");
    }

    function __destruct() {
      $method_routes = $this->{strtolower($this->request->requestMethod)};
      $formated_route = $this->formatRoute($this->request->pathInfo ?? "/");
      $request_handler = $method_routes[$formated_route];
      if (is_null($request_handler)) {
        $this->handleDefaultRequest();
        return;
      }
      call_user_func_array($request_handler, array($this->request));
    }
  }
?>