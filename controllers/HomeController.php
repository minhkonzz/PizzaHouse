<?php 
  // namespace PZHouse\Controllers;

  // use PZHouse\Core\Controller;
  // use PZHouse\Core\Request; 
  // use PZHouse\Core\Response;

  class HomeController extends Controller {

    public function init(Request $req, $params = []) {
      $categories = CategoryModel::selectAllCategories();
      $body_response = [
         "categories" => $categories, 
         "products_by_category" => ProductModel::selectProductsByCategory($categories[0]["id"])
      ];
      parent::view(
        __ROOT__,
        [ "title" => "Trang chủ" ], 
        "home/home1.view.php",
        "", 
        "bundle.view.php",
        new Response($body_response)
      );
    }
  }
?>