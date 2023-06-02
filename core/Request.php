<?php 
  // namespace PZHouse\Core;
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

    public function sanitize($payloads) {
       foreach ($payloads as &$v) {
          if (is_string($v)) $v = filter_var($v, FILTER_SANITIZE_SPECIAL_CHARS);
          if (is_numeric($v)) $v = floatval($v) > intval($v) ? floatval($v) : intval($v);
       }
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