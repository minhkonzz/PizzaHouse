<?php 
  class Request {

    private $headers;
    private $method; 
    private $path_info; 
    private $payloads; 

    function __construct() {
      $this->headers = getallheaders();
      $this->method = $_SERVER["REQUEST_METHOD"];
      $this->path_info = $_SERVER["PATH_INFO"] ?? "/";
      $this->payloads = $this->sanitize(
        $this->method === "GET" || $this->method === "POST" || $this->method === "COOKIE" ? $_REQUEST : 
        json_decode(file_get_contents("php://input"), true)
      );
    }

    public function getHeaderLine($name) {
      return $this->headers[$name] ?? "";
    }

    private function sanitize($payloads) {
      $filters = array(
        "string" => FILTER_SANITIZE_STRING,
        "int" => FILTER_SANITIZE_NUMBER_INT,
        "float" => FILTER_SANITIZE_NUMBER_FLOAT
      );
      if (is_array($payloads) || is_object($payloads)) {
        foreach ($payloads as &$v) {
          $type = gettype($v); 
          if (isset($filters[$type])) $v = filter_var($v, $filters[$type]);      
        }
      }
      else $payloads = filter_var($payloads, FILTER_SANITIZE_SPECIAL_CHARS);
      return $payloads;
    }

    public function getMethod() {
      return strtoupper($this->method); 
    }

    public function getPathInfo() {
      return $this->path_info;
    }

    public function getPayloads() {
      return $this->payloads;
    }
  }
?>