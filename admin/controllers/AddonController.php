<?php
  // namespace PZHouse\Admin\Controllers;
  class AddonController extends Controller {
    public function init(Request $req, array $params = []) {
      $this->getAllAddons($req, $params);      
    }

    public function getAllAddons(Request $req, array $params = []) {
      $addons = AddonModel::selectAllAddons(); 
      if (parent::isJsonOnly($req, $addons)) return (new Response($addons))->withJson();
      parent::view(
        ROOT_ADMIN, 
        ["title" => "Quản lý thuộc tính sản phẩm"], 
        "catalog/addons/addons.view.php",
        "catalog/addons/addons.style.css",
        "bundle.view.php",
        new Response(["addons" => $addons])
      );
    }

    public function getAddonById(Request $req, array $params = []) {
      try {
        $addon = AddonModel::selectAddonById($params["addon_id"]);
        if (empty($addon)) throw new InternalErrorException();
        return (new Response($addon))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getAllAddonsAndOptions(Request $req, array $params = []) {
      try {
        $addons_options = AddonModel::selectAllAddonsAndOptions();
        if (empty($addons_options)) throw new InternalErrorException();
        return (new Response($addons_options))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function updateAddonById(Request $req, array $params = []) {
      try {
        $requested_payloads = $req->getPayloads();
        list("addonId" => $addon_id, "addonOptionsChange" => $addons_change) = $requested_payloads;
        $addon_name = $requested_payloads["addon_name"] ?? "";
        $updated_addon = [
          "addon_id" => $addon_id, 
          "addon_name" => $addon_name, 
          "addons_change" => $addons_change
        ];
        if (!AddonModel::updateAddonById($updated_addon)) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function createNewAddon(Request $req, array $params = []) {
      try {
        list("addonId" => $addon_id, "addonName" => $addon_name, "addonOptions" => $addon_options) = $req->getPayloads();
        $new_addon = new Addon($addon_name, $addon_options, $addon_id);
        if (!AddonModel::addAddon($new_addon)) throw new InternalErrorException();
        return new Response();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function deleteAddonById(Request $req, array $params = []) {
      try {
        if (!AddonModel::deleteAddonById($params["addon_id"])) throw new InternalErrorException();
        return new Response();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>