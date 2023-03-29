<?php 
  class EncryptionException extends Exception {
    function __construct($message = "Có lỗi trong quá trinh mã hóa", $code = 903, Exception $previous = null) {
      parent::__construct($message, $code, $previous);
    }
  }
?>