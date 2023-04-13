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
        "Pizza House VietNam - Quản lý ưu đãi - dịch vụ",
        "catalog/discounts-services/discounts-services.view.php",
        "catalog/discounts-services/discounts-services.style.css", 
        "bundle.view.php",
        new Response([
          "discounts" => DiscountModel::getAllDiscounts()
        ])
      );
    }

    public function showAllServices(Request $req = null, $params = []) {}

    public function redirectToAddDiscount(Request $req = null, $params = []) {
      parent::view(
        ROOT_ADMIN, 
        "Pizza House Việt Nam - Tạo ưu đãi", 
        "catalog/discounts-services/discount-add.view.php", 
        "catalog/discounts-services/discount-add.style.css",
        "bundle.view.php",
        new Response([])
      );
    }
  }
?>