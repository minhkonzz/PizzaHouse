<?php 

  // namespace PZHouse\Exceptions;

  class InternalErrorException extends Exception {
    function __construct($message = "Internal Server Error", $code = 500, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
    }
  }
?>