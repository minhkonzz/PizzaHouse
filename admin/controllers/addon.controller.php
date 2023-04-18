<?php
  class AddonController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllAddons($req, $params);      
    }

    public function getAllAddons(Request $req, $params = []) {
      $addons = AddonModel::selectAllAddons(); 
      if (parent::isJsonOnly($req, $addons)) return (new Response($addons))->withJson();
      parent::view(
        ROOT_ADMIN, 
        "Pizza House Việt Nam - Quản lý thuộc tính sản phẩm", 
        "catalog/addons/addons.view.php",
        "catalog/addons/addons.style.css",
        "bundle.view.php",
        new Response(["addons" => $addons])
      );
    }

    public function getAddonById(Request $req, $params = []) {
      try {
        $addon = AddonModel::selectAddonById($params["addon_id"]);
        if (empty($addon)) throw new InternalErrorException();
        return (new Response($addon))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getAllAddonsAndOptions(Request $req, $params = []) {
      try {
        $addons_options = AddonModel::selectAllAddonsAndOptions();
        if (empty($addons_options)) throw new InternalErrorException();
        return (new Response($addons_options))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function updateAddonById(Request $req, $params = []) {
      try {

      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function createNewAddon(Request $req, $params = []) {
      try {

      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function deleteAddonById(Request $req, $params = []) {
      try {

      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>