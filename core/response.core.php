<?php 
  class Response {
    private $status_code;
    private $headers;
    private $body; 

    function __construct($status_code = 200, $body = [], $headers = []) {
      $this->status_code = $status_code; 
      $this->headers = $headers; 
      $this->body = $body;
    }

    public function getHeaders() {
      return $this->headers; 
    }

    public function getBody() {
      return $this->body;
    }

    public function getStatusCode() {
      return $this->status_code; 
    }
  }
?>