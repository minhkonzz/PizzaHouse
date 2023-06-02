<?php 
   class CategoryController extends Controller {
      public function init(Request $req, $params = []) {
         $this->getAllCateggories($req, $params);
      }

      public function getAllCategories(Request $req, array $params = []) {
         try {
            $payloads = $req->getPayloads();
            $total_categories = CategoryModel::selectTotalCategories(); 
            list("total_pages" => $total_pages, "limit" => $limit, "page" => $page) = parent::paging($payloads, $total_categories);
            $body_response = [
               "categories" => CategoryModel::selectAllCategories(($page - 1) * $limit, $limit), 
               "current_page" => $page, 
               "total_pages" => $total_pages
            ];
            if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
            parent::view(
               ROOT_ADMIN,
               [ "title" => "Quản lý danh mục thực đơn" ],
               "catalog/categories/categories.view.php",
               "catalog/categories/categories.style.css",
               "bundle.view.php",
               new Response($body_response)
            );
         } catch (InternalErrorException $e) {
            return (new Response([], $e->getCode(), $e->getMessage()))->withJson();  
         }
      }

     public function getCategoryById(Request $req, array $params = []) {
        try {
           $category = CategoryModel::selectCategoryById($params["category_id"]);
           if (empty($category)) throw new InternalErrorException();
           return (new Response($category))->withJson();
        } catch (InternalErrorException $e) {
           return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
        }
     }

     public function createNewCategory(Request $req, array $params = []) {
        try {
           list("categoryId" => $id, "categoryName" => $category_name) = $req->getPayloads();
           $new_category = new Category($category_name, $id);
           if (!CategoryModel::addCategory($new_category)) throw new InternalErrorException();
           return (new Response([
              "status" => "SUCCESS", 
              "message" => "Thêm thành công danh mục " . $category_name
           ]))->withJson();
        } catch (InternalErrorException $e) {
           return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
        }
     }

     public function updateCategoryById(Request $req, array $params = []) {
        try {
           list("categoryId" => $id, "categoryName" => $category_name) = $req->getPayloads();
           $update_category = new Category($category_name, $id);
           if (!CategoryModel::updateCategoryById($update_category)) throw new InternalErrorException();
           return (new Response([ 
              "status" => "SUCCESS", 
              "message" => "Đã cập nhật danh mục " . $category_name
           ]))->withJson();
        } catch (InternalErrorException $e) {
           return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
        }
     } 

     public function deleteCategoryById(Request $req, array $params = []) {
        try {
           if (!CategoryModel::deleteCategoryById($params["category_id"])) throw new InternalErrorException();
           return (new Response([
              "status" => "SUCCESS", 
              "message" => "Xóa thành công danh mục " . $params["category_id"]
           ]))->withJson();
        } catch (InternalErrorException $e) {
           return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
        }
     }

     public function deleteCategories(Request $req, array $params = []) {
        try {
           list("removeIds" => $remove_ids) = $req->getPayloads(); 
           if (!CategoryModel::deleteCategories($remove_ids)) throw new InternalErrorException(); 
           return (new Response())->withJson();                  
        } catch (InternalErrorException $e) {
           return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
        }   
     }
   }
?>