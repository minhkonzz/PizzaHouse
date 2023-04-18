<?php
  class TestController extends Controller {
    public function init(Request $req = null, $params = []) {
      $requested_payloads = $req->getPayloads(); 
      echo json_encode($requested_payloads);
    }
  }
?>