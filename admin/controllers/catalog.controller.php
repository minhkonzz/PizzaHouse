<?php 
  class CatalogController extends Controller {

    public function showAllCategories(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN,
        "Pizza House VietNam - Quản lý danh mục",
        "catalog/categories/categories.view.php",
        "catalog/categories/categories.style.css",
        "bundle.view.php",
        new Response([
          "categories" => CategoryModel::getAllCategories()
        ])
      );
    }

    public function showAllDiscounts(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN,
        "Pizza House VietNam - Quản lý ưu đãi",
        "catalog/discounts/discounts.view.php",
        "catalog/discounts/discounts.style.css", 
        "bundle.view.php",
        new Response([
          "discounts" => DiscountModel::getAllDiscounts()
        ])
      );
    }
  }
?>