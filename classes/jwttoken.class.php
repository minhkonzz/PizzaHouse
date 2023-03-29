<?php 
  class JWTToken {
    private $header;
    private $payload;
    private $signature;
    private $expire_at;
    private $token;

    public function __construct($header, $payload, $signature, $expire_at) {
      $this->header = $header;
      $this->payload = $payload;
      $this->signature = $signature;
      $this->expire_at = $expire_at;
    }

    public function isExpired(): bool {
      return $this->expire_at < time();
    }

    public function getExpireAt() {
      return $this->expire_at;
    }

    public function getPayload(): array {
      return $this->payload;
    }

    public function getToken() {
      // return $this->header . '.' . $this->payload . '.' . $this->signature;
      return $this->token;
    }

    public function setToken($token) {
      $this->token = $token;
    }
  }
?>