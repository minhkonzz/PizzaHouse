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
      echo $query_str;
      $connection = Database::getInstance();
      $statement = $connection->prepare($query_str);
      $statement->execute($params);
      if ($is_fetch) {
        $res = array();
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) array_push($res, $row);
        return $res; 
      }
    }

    // public static function handleQuery($query_cmd) {
    //   $connection = Database::getInstance();
    //   $arr_records = array();
    //   $statement = $connection->query($query_cmd); 
    //   while ($row = $statement->fetch()) 
    //     array_push($arr_records, array_filter($row, fn($key) => !is_numeric($key), ARRAY_FILTER_USE_KEY));
    //   return $arr_records; 
    // }

    // public static function handleModify($modify_cmd, $params) {
    //   $connection = Database::getInstance();
    //   $statement = $connection->prepare($modify_cmd);
    //   foreach ($params as $param_key => $param_value) 
    //     $statement.bindParam($param_key, $param_value); 
    //   return $statement->execute();
    // }

  }
?>