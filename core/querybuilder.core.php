<?php 
  class QueryBuilder {

    private $behavior; // select, insert, update, delete, ...
    private $table_name; 
    private $selects = [];
    private $joins = [];
    private $wheres = [];
    private $options = [];
    private $updates = [];
    private $group_by = [];

    private $column_gmin = "";
    private $column_gmax = "";
    private $column_orderby = "";

    function __construct($table_name, $behavior) {
      $this->table_name = $table_name;
      $this->behavior = $behavior;
    }

    function __toString() {
      $select = $this->selects ? implode(", ", $this->selects) : "*"; 
      $where = $this->wheres ? "WHERE " . implode(" AND ", $this->wheres) : "";
      $group_by = $this->group_by ? "GROUP BY " . implode(", ", $this->group_by) : "";
      $join = $this->joins ? implode(" ", $this->joins) : ""; 
      switch (strtoupper($this->behavior)) {
        case "UPDATE": {
          $update = $this->updates ? implode(", ", $this->updates) : "";
          return sprintf("UPDATE %s SET %s %s", $this->table_name, $update, $where);
        }
        case "DELETE": 
          return sprintf("DELETE FROM %s %s", $this->table_name, $where);
        default:
          return sprintf("SELECT %s FROM %s %s %s %s", $select, $this->table_name, $join, $where, $group_by);
      }
    }

    public function join($table, $first, $operator, $second, $type = 'INNER') {
      $this->joins[] = strtoupper($type) . " JOIN " . $table . " ON " . $first . " " . $operator . " " . $second;
      return $this;
    }

    public function where($column, $value = null, $operator = "=") {
      $this->wheres[] = "$column $operator $value";
      return $this;
    }

    public function select(...$selects) {
      $this->selects = $selects; 
      return $this;
    }

    public function update($updates) {
      foreach ($updates as $column => $value) $this->updates[] = "$column = $value";
      return $this;
    }

    public function scalar() {
      return $this;
    }

    public function count() {
      return $this;
    }

    public function avg($column) {
      return $this;
    }

    public function max($column) {
      $this->column_gmax = $column;
      return $this;
    }

    public function min($column) {
      $this->column_gmin = $column;
      return $this;
    }

    // public function orderBy($column_name, $order_type) {
    //   $this->column_orderby = $column_name;
    //   $this->result_order_type = $order_type;
    //   return $this;
    // }

    public function groupBy(...$columns) {
      $this->group_by = $columns;
      return $this;
    }
  }
?>