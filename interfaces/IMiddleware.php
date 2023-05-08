<?php 
  // namespace PZHouse\Interfaces;

  interface IMiddleware {
    public function process(Request $request, $handler);
  }
?>