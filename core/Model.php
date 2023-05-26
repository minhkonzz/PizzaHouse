<?php
  // namespace PZHouse\Core;
  // use PZHouse\Core\Database;
  class Model {
    public static function performQuery($queries) {
      $is_query_success = false;
      $is_fetch = false;
      $connection = Database::getInstance();
      $connection->beginTransaction();
      $fetch_result = array();
      try {
        foreach ($queries as $query) {
          $statement = $connection->prepare($query["query_str"]); 
          if ($statement) {
            $statement->execute($query["params"] ?? []); 
            if (isset($query["is_fetch"])) {
              $is_fetch = true;
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
      return $is_fetch ? $fetch_result : $is_query_success;
    }

    public static function fetchRecordsWithLimit($select_query, $start_index, $max_records) {
      $res = self::performQuery([[
        "query_str" => $select_query . " LIMIT ${start_index}, ${max_records}", 
        "is_fetch" => "records"
      ]]);
      return $res["records"];
    }
  }
?>
