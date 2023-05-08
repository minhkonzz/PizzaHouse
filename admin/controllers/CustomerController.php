<?php 
  // namespace PZHouse\Admin\Controllers;

  class CustomerController extends Controller {
    public function init(Request $req, $params = []) {
      $this->getAllCustomers($req, $params);
    }

    public function getAllCustomers(Request $req, $params = []) {
      try {
        $body_response = [ "customers" => CustomerModel::selectAllCustomers() ];
        if (parent::isJsonOnly($req, $body_response)) return (new Response($body_response))->withJson();
        parent::view(
          ROOT_ADMIN, 
          "Pizza House Việt Nam - Quản lý khách hàng", 
          "customers/customers.view.php",
          "customers/customers.style.css",
          "bundle.view.php",
          new Response($body_response)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    }

    public function getCustomerById(Request $req, $params = []) {
      try {
        $customer = CustomerModel::selectCustomerById($params["customer_id"]);
        if (parent::isJsonOnly($req, $customer)) return (new Response($customer))->withJson();
        parent::view(
          "Pizza House Việt Nam - Quản lý khách hàng", 
          "customers/customers.view.php",
          "customers/customers.style.css",
          "bundle.view.php",
          new Response($customer)
        );
      } catch (InternalErrorException $e) {
        return (new Response([], $e->getCode(), $e->getMessage()))->withJson();
      }
    } 
  }
?>