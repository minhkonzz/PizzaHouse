<?php 

  // namespace PZHouse\Exceptions;

  class DecryptException extends Exception {
    function __construct($message = "Có lỗi trong quá trình giải mã", $code = 1001, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
    }
  }
?>