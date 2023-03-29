<?php 
  class AuthException extends Exception {

    function __construct($message = "Có lỗi trong quá trình đăng nhập/đăng ký", $code = 832, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
    }
  }
?>