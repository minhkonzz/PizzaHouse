<?php 
   include_once __ROOT__ . "core/DataInstance.php";

   class Addon extends DataInstance {

      private $addon_name;
      public function getAddonName() {
         return $this->addon_name; 
      }

      private $addon_options;
      public function getAddonOptions() {
         return $this->addon_options;
      }

      function __construct($addon_name, $addon_options, $id = "") {
         parent::__construct(ADDON_ID_PREFIX, $id);
         $this->addon_name = $addon_name; 
         $this->addon_options = $addon_options;
      }
   }
?>