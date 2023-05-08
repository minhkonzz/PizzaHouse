<?php 

  // namespace PZHouse\Interfaces;

  interface IEncryptor {
    public function encrypt($payload);
    public function decrypt($payload);
  }
?>