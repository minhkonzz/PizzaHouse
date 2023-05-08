<?php 

  // namespace PZHouse\Models;

  class AddonModel extends Model {

    public static function selectAllAddons() {
      $query_str = Database::table("tbl_addon")
        ->select("tbl_addon.id as addon_id", "addon_name", "count(tbl_addon_value.id) as addon_value_count", "tbl_addon.created_at")
        ->join("tbl_addon_value", "tbl_addon.id", "=", "tbl_addon_value.addon_id")
        // ->where("tbl_addon.is_deleted", 0)
        // ->where("tbl_addon_value.is_deleted", 0)
        ->groupBy("tbl_addon.id");
      $res = parent::performQuery([[
        "query_str" => $query_str,
        "is_fetch" => "addons"
      ]]); 
      return $res["addons"];
    }

    public static function selectAddonById($id) {
      $query_str = Database::table("tbl_addon")
        ->select("tbl_addon_value.id as addon_val_id", "tbl_addon.id as addon_id", "addon_name", "addon_val", "addon_val_price")
        ->join("tbl_addon_value", "tbl_addon.id", "=", "tbl_addon_value.addon_id")
        ->where("tbl_addon.id", ":addon_id");
        // ->where("tbl_addon_value.is_deleted", 0);
      $res = parent::performQuery([[
        "query_str" => $query_str, 
        "is_fetch" => "addon",
        "params" => [ "addon_id" => $id ]
      ]]);
      return $res["addon"];
    }

    // no-mapped 
    public static function selectAllAddonsAndOptions() {
      $query_res = parent::performQuery([[
        "query_str" => Database::table("tbl_addon_value")
          ->select("tbl_addon_value.id as addon_val_id", "addon_id", "addon_val", "addon_val_price", "addon_name")
          ->join("tbl_addon", "tbl_addon_value.addon_id", "=", "tbl_addon.id"),
          // ->where("tbl_addon.is_deleted", 0)
          // ->where("tbl_addon_value.is_deleted", 0),
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
          // $res[$addon_id]["addon_options"] = [[
          //   "addon_val_id" => $addon_val_id,
          //   "addon_val" => $addon_val, 
          //   "addon_val_price" => $addon_val_price
          // ]];
          $res[$addon_id]["addon_options"][$addon_val_id] = [
            "addon_val" => $addon_val, 
            "addon_val_price" => $addon_val_price
          ];
          continue;
        }
        // $res[$addon_id]["addon_options"][] = [
        //   "addon_val_id" => $addon_val_id,
        //   "addon_val" => $addon_val, 
        //   "addon_val_price" => $addon_val_price
        // ];
        $res[$addon_id]["addon_options"][$addon_val_id] = [
          "addon_val" => $addon_val, 
          "addon_val_price" => $addon_val_price
        ];
      }
      return $res;
    }
  }
?>