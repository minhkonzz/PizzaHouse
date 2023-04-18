<?php 
  class DiscountController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllDiscounts($req, $params);
    }

    public function getAllDiscounts(Request $req, $params = []) {
      try {
        $discounts = DiscountModel::selectAllDiscounts();
        if (parent::isJsonOnly($req, $discounts)) return (new Response($discounts))->withJson();
        parent::view(
          ROOT_ADMIN,
          "Pizza House VietNam - Quản lý ưu đãi - dịch vụ",
          "catalog/discounts-services/discounts-services.view.php",
          "catalog/discounts-services/discounts-services.style.css", 
          "bundle.view.php",
          new Response(["discounts" => $discounts])
        );
      } catch (InternalErrorException $e) { 
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function redirectToAddDiscount(Request $req, $params = []) {
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