<?php 

  // namespace PZHouse\Exceptions;

  class MethodNotAllowedException extends Exception {
    function __construct($message = "The requested method is not allowed", $code = 405, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
    }
  }
?>