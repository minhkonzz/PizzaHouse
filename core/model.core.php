<?php
  class Model {

    protected $id = null; 

    function __construct($id_prefix = "") {
      $this->generateId($id_prefix);
    }

    private function generateId($id_prefix) {
      $this->id = $id_prefix.time(); 
    }

    public static function perform($query_str, $is_fetch, $params = []) {
      $connection = Database::getInstance();
      $statement = $connection->prepare($query_str);
      $statement->execute($params);
      if ($is_fetch) {
        $res = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) array_push($res, $row);
        return $res; 
      }
    }
  }
?>