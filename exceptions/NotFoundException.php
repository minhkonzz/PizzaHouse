<?php 

  // namespace PZHouse\Exceptions;

  class NotFoundException extends Exception {
    function __construct($message = "Not Found", $code = 404, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
    }
  }
?>