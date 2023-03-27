<?php 
  class Cache {
    private static $cache = [];

    public static function get($key) {
      return self::$cache[$key] ?? null;  
    }

    public static function set($key, $value) {
      self::$cache[$key] = $value; 
    }

    public static function remove($key) {
      if (isset(self::$cache[$key]))
        unset(self::$cache[$key]);
    }

    public static function clear() {
      self::$cache = [];
    }
  }
?>