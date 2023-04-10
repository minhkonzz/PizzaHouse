<?php
  class TestController extends Controller {
    public function init(Request $req = null, $params = []) {
      echo "init TestController";
    }
  }
?>