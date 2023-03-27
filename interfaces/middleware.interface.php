<?php 
  interface IMiddleware {
    public function process(Request $request, $handler);
  }
?>