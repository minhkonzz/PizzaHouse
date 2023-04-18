<?php
  class Model {

    // protected $id = null; 

    // function __construct($id_prefix = "") {
    //   $this->generateId($id_prefix);
    // }

    // private function generateId($id_prefix) {
    //   $this->id = $id_prefix.time(); 
    // }

    // public function getId() {
    //   return $this->id;
    // }

    public static function performQuery($queries) {
      $is_query_success = false;
      $connection = Database::getInstance();
      $connection->beginTransaction();
      $fetch_result = array();
      try {
        foreach ($queries as $query) {
          $statement = $connection->prepare($query["query_str"]); 
          if ($statement) {
            $statement->execute($query["params"] ?? []); 
            if (isset($query["is_fetch"])) {
              $fetch_result[$query["is_fetch"]] = array();
              while ($row = $statement->fetch(PDO::FETCH_ASSOC)) array_push($fetch_result[$query["is_fetch"]], $row);
            }
          }
          unset($statement);
        }
        $connection->commit();
        $is_query_success = true; 
      } catch (Exception $e) {
        $connection->rollBack();
      }
      unset($connection);
      if (count($fetch_result) > 0) return $fetch_result;
      return $is_query_success;
    }
  }
?>
