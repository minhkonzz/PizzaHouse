<?php 
  // namespace PZHouse\Admin\Controllers;

  class CategoryController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllCateggories($req, $params);
    }

    public function getAllCategories(Request $req, $params = []) {
      try {
        $categories = CategoryModel::selectAllCategories();
        if (parent::isJsonOnly($req, $categories)) return (new Response($categories))->withJson();
        parent::view(
          ROOT_ADMIN,
          ["title" => "Quản lý danh mục thực đơn"],
          "catalog/categories/categories.view.php",
          "catalog/categories/categories.style.css",
          "bundle.view.php",
          new Response(["categories" => $categories])
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getCategoryById(Request $req, $params = []) {
      try {
        $category = CategoryModel::selectCategoryById($params["category_id"]);
        if (empty($category)) throw new InternalErrorException();
        return (new Response($category))->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function createNewCategory(Request $req, $params = []) {
      try {
        list("categoryId" => $id, "categoryName" => $category_name) = $req->getPayloads();
        $new_category = new Category($id, $category_name);
        if (!CategoryModel::addCategory($new_category)) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function updateCategoryById(Request $req, $params = []) {
      try {
        list("categoryId" => $id, "categoryName" => $category_name) = $req->getPayloads();
        $update_category = new Category($id, $category_name);
        if (!CategoryModel::updateCategoryById($update_category)) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    } 

    public function deleteCategoryById(Request $req, $params = []) {
      try {
        if (!CategoryModel::deleteCategoryById($params["category_id"])) throw new InternalErrorException();
        return (new Response())->withJson();
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }
  }
?>