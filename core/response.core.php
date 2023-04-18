<?php 
  class Response {

    private $status_code;
    private $message;
    private $body; 

    function __construct($body = [], $status_code = 200, $message = "200 OK") {
      $this->status_code = $status_code; 
      $this->message = $message;
      $this->body = $body;
    }

    public function withJson() {
      echo json_encode([
        "code" => $this->status_code, 
        "message" => $this->message, 
        "body" => $this->body
      ]);
      return $this;
    }

    public function getBody() {
      return $this->body;
    }

    public function getStatusCode() {
      return $this->status_code; 
    }

    public function getMessage() {
      return $this->message;
    }
  }
?>