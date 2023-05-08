<?php 

  // namespace PZHouse\Interfaces;

  interface IJWTEncryptor {
    public function encode($payload, $key);
    public function decode($token, $key);
  }
?>