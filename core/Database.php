<?php 
  // namespace PZHouse\Core;
  // use PZHouse\Core\QueryBuilder;
  class Database {
    private static $instance = NULL;

    public static function getInstance() {
      if (!isset(self::$instance)) {
        try {
          self::$instance = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
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