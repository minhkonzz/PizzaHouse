<?php 
   class RequestSender {
      private $url;
      private $curl;

      function __construct($url) {
         $this->url = $url;
         $this->curl = curl_init();
         curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
      }

      public function setUrl($url) {
         $this->url = $url;
      }

      public function get($headers = array()) {
         curl_setopt($this->curl, CURLOPT_URL, $this->url);
         curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'GET');
         curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
         return curl_exec($this->curl);
      }

      public function post($data, $headers = array()) {
         curl_setopt($this->curl, CURLOPT_URL, $this->url);
         curl_setopt($this->curl, CURLOPT_POST, true);
         curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
         return curl_exec($this->curl);
      }

      public function put($data, $headers = array()) {
         curl_setopt($this->curl, CURLOPT_URL, $this->url);
         curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PUT');
         curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
         return curl_exec($this->curl);
      }

      public function patch($data, $headers = array()) {
         curl_setopt($this->curl, CURLOPT_URL, $this->url);
         curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'PATCH');
         curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
         curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
         return curl_exec($this->curl);
      }

      public function delete($headers = array()) {
         curl_setopt($this->curl, CURLOPT_URL, $this->url);
         curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, 'DELETE');
         curl_setopt($this->curl, CURLOPT_HTTPHEADER, $headers);
         return curl_exec($this->curl);
      }

      public function __destruct() {
         curl_close($this->curl);
      }
   }
?>