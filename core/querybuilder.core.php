<?php 
  class QueryBuilder {

    private $behavior;
    private $table_name; // select, insert, update, delete, ...
    private $fields = [];
    private $conditions = [];
    private $options = [];
    private $updates = [];

    private $column_gmin = "";
    private $column_gmax = "";
    private $column_orderby = "";
    private $column_groupby = "";

    function __construct($table_name, $behavior) {
      $this->table_name = $table_name;
      $this->behavior = $behavior;
    }

    function __toString() {
      $where_clause = $this->conditions === [] ? "" : " WHERE " . implode(" AND ", $this->conditions);
      switch (strtoupper($this->behavior)) {
        case "UPDATE":
          return "UPDATE $this->table_name SET " . implode(", ", $this->updates) . $where_clause;
        default:
          return "SELECT " . implode(", ", $this->fields) . " FROM $this->table_name " . $where_clause;
      }
    }

    public function distinct() {

    }

    // when we want to using select query
    public function select(...$fields) {
      $this->fields = $fields; 
      return $this;
    }

    public function selectAll() {
      $this->fields = ["*"];
      return $this;
    }

    public function update($updates) {
      foreach ($updates as $column => $value) $this->updates[] = "$column_name = $value";
      return $this;
    }

    // when we want query result is scalar value
    public function scalar() {
      return $this;
    }

    public function count() {
      return $this;
    }

    public function avg($column_name) {
      return $this;
    }

    public function max($column_name) {
      $this->column_gmax = $column_name;
      return $this;
    }

    public function min($column_name) {
      $this->column_gmin = $column_name;
      return $this;
    }

    public function orderBy($column_name, $order_type) {
      $this->column_orderby = $column_name;
      $this->result_order_type = $order_type;
      return $this;
    }

    public function groupBy($column_name) {
      $this->column_groupby = $column_name;
      return $this;
    }

    public function where($column_name, $operation = "=", $value) {
      $this->conditions[] = "$column_name $operation $value";
      return $this;
    }
  }
?>