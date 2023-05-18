<?php 
   list("paid" => $paid) = $response->getBody();
   switch (strtoupper($paid)) {
      case "SUCCESS": {
         echo "<p>Cam on ban da mua hang</p>"; 
         break;
      }
      case "FAILED": {
         echo "<p>Co loi khi xu ly thanh toan</p>"; 
         break;
      }
   }
?>