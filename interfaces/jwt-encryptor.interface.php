<?php 
  interface JwtEncryptor {
    public function encode($payload, $key);
    public function decode($token, $key);
  }
?>