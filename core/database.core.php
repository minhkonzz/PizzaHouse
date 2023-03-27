<?php 
  require_once "querybuilder.core.php";

  class Database {
    private static $instance = NULL;

    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO("mysql:host=localhost;dbname=pizza-house-db", "root", "");
          self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
          die("Connect database failed: ".$e->getMessage());
        }
      }
      return self::$instance;
    }

    public static function table($table_name, $behavior = "SELECT") {
      return new QueryBuilder($table_name, $behavior);
    }
  }
?>  