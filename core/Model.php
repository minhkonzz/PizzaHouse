<?php
  // namespace PZHouse\Core;
  // use PZHouse\Core\Database;
  class Model {
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
        echo $e->getMessage();
        $connection->rollBack();
      }
      unset($connection);
      return count($fetch_result) > 0 ? $fetch_result : $is_query_success;
    }
  }
?>
