<?php 
  class AddonModel extends Model {
    public static function selectAllAddons($start, $max) {
      $res = parent::performQuery([[
        "query_str" => Database::table("tbl_addon")
          ->select("tbl_addon.id as addon_id", "addon_name", "count(tbl_addon_value.id) as addon_value_count", "tbl_addon.created_at")
          ->join("tbl_addon_value", "tbl_addon.id", "=", "tbl_addon_value.addon_id")
          ->groupBy("tbl_addon.id")
          ->limit($start, $max),
        "is_fetch" => "addons"
      ]]); 
      return $res["addons"];
    }

    public static function selectTotalAddons() {
       $res = parent::performQuery([[
           "query_str" => "SELECT COUNT(*) as total_records FROM tbl_addon", 
           "is_fetch" => "count"
       ]]);
       return $res["count"][0]["total_records"];
    }

    public static function selectAddonById($id) {
      $query_str = Database::table("tbl_addon")
        ->select("tbl_addon_value.id as addon_val_id", "tbl_addon.id as addon_id", "addon_name", "addon_val", "addon_val_price")
        ->join("tbl_addon_value", "tbl_addon.id", "=", "tbl_addon_value.addon_id")
        ->where("tbl_addon.id", ":addon_id");
      $res = parent::performQuery([[
        "query_str" => $query_str, 
        "is_fetch" => "addon",
        "params" => [ "addon_id" => $id ]
      ]]);
      list("addon_id" => $addon_id, "addon_name" => $addon_name) = $res["addon"][0];
      return [
        "addon_id" => $addon_id, 
        "addon_name" => $addon_name, 
        "addon_options" => array_map(fn($e) => [
          "addon_val_id" => $e["addon_val_id"], 
          "addon_val" => $e["addon_val"], 
          "addon_val_price" => $e["addon_val_price"]
        ], $res["addon"]) 
      ]; 
    }

    public static function selectAllAddonsAndOptions() {
      $query_res = parent::performQuery([[
        "query_str" => Database::table("tbl_addon_value")
          ->select("tbl_addon_value.id as addon_val_id", "addon_id", "addon_val", "addon_val_price", "addon_name")
          ->join("tbl_addon", "tbl_addon_value.addon_id", "=", "tbl_addon.id"),
        "is_fetch" => "addons"
      ]]);
      $raw_res = $query_res["addons"];
      $res = [];
      foreach ($raw_res as $addon_option) {
        list(
          "addon_id" => $addon_id,
          "addon_name" => $addon_name, 
          "addon_val_id" => $addon_val_id,
          "addon_val" => $addon_val, 
          "addon_val_price" => $addon_val_price
        ) = $addon_option;
        if (!isset($res[$addon_id])) {
          $res[$addon_id]["addon_name"] = $addon_name; 
          $res[$addon_id]["addon_options"][$addon_val_id] = [
            "addon_val" => $addon_val, 
            "addon_val_price" => $addon_val_price
          ];
          continue;
        }
        $res[$addon_id]["addon_options"][$addon_val_id] = [
          "addon_val" => $addon_val, 
          "addon_val_price" => $addon_val_price
        ];
      }
      return $res;
    }

    public static function addAddon($new_addon) {
      return parent::performQuery(array_merge(
        [[
          "query_str" => "INSERT INTO tbl_addon (id, addon_name) VALUES (:id, :addon_name)", 
          "params" => [
            "id" => $new_addon->getId(),
            "addon_name" => $new_addon->getAddonName()
          ]
        ]], 
        array_map(fn($e) => [
          "query_str" => "INSERT INTO tbl_addon_value (id, addon_id, addon_val, addon_val_price) VALUES (:id, :addon_id, :addon_val, :addon_val_price)",
          "params" => [
            "id" => $e["addon_val_id"], 
            "addon_id" => $new_addon->getId(),
            "addon_val" => $e["addon_val"], 
            "addon_val_price" => $e["addon_val_price"]
          ]
        ], $new_addon->getAddonOptions())
      ));
    }

    public static function updateAddonById($updated_addon) {
      list("addon_id" => $addon_id, "addon_name" => $addon_name, "addons_change" => $addons_change) = $updated_addon; 
      $queries = []; 
      if (!empty($addon_name)) {
        $queries[] = [
          "query_str" => "UPDATE tbl_addon SET addon_name = :addon_name WHERE id = :id", 
          "params" => [
            "id" => $addon_id,
            "addon_name" => $addon_name
          ]
        ];
      }
      return parent::performQuery(
        array_merge($queries, array_map(function($e) use ($addon_id) {
          list(
            "addon_val_id" => $addon_val_id, 
            "addon_val" => $addon_val, 
            "addon_val_price" => $addon_val_price, 
            "status" => $status
          ) = $e; 
          switch ($status) {
            case "ADD":
              return [
                "query_str" => "INSERT INTO tbl_addon_value (id, addon_id, addon_val, addon_val_price) VALUES (:id, :addon_id, :addon_val, :addon_val_price)", 
                "params" => [
                  "id" => $addon_val_id, 
                  "addon_id" => $addon_id, 
                  "addon_val" => $addon_val, 
                  "addon_val_price" => $addon_val_price
                ]   
              ];
            case "UPDATE": 
              return [
                "query_str" => "UPDATE tbl_addon_value SET addon_val = :addon_val, addon_val_price = :addon_val_price WHERE id = :id",
                "params" => [
                  "id" => $addon_val_id, 
                  "addon_val" => $addon_val, 
                  "addon_val_price" => $addon_val_price
                ]
              ];
            case "DELETE":
              return [
                "query_str" => "DELETE FROM tbl_addon_value WHERE id = :id", 
                "params" => [ "id" => $addon_val_id ]
              ];
          }
        }, $addons_change))
      );
    }

    public static function deleteAddonById($id) {
      return parent::performQuery([[
        "query_str" => "DELETE FROM tbl_addon WHERE id = :id", 
        "params" => [ "id" => $id ]
      ]]);
    }
  }
?>