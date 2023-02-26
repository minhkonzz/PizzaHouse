<?php 
  class Request {
    function __construct() {
      $this->transformRequestToCamelCase();
    }

    private function transformRequestToCamelCase() {
      foreach ($_SERVER as $key => $value) 
        $this->{$this->toCamelCase($key)} = $value;
    }

    private function toCamelCase($str) {
      $res = strtolower($str);
      preg_match_all('/_[a-z]/', $res, $matches); 
      foreach ($matches[0] as $match) {
        $c = str_replace('_', '', strtoupper($match));    
        $res = str_replace($match, $c, $res);  
      }
      return $res;
    }

    public function getBody() {
      $request_method = $this->requestMethod; 
      if ($request_method == "GET") return; 
      $body = array();
      foreach ($_POST as $key => $value) 
        $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
      return $body;
    }
  }
?>