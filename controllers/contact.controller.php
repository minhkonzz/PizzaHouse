<?php 
  class ContactController extends Controller {
    public function init(Request $req = null, $params = []) {
      parent::view(
        __ROOT__, 
        "Pizza House Việt Nam - Liên hệ chúng tôi", 
        "contact/contact.view.php",
        "contact/contact.style.css",
        "bundle.view.php",
        new Response([])
      );
    }
  }
?>