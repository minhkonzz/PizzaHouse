<?php 
  interface Encryptor {
    public function encrypt($payload);
    public function decrypt($payload);
  }
?>