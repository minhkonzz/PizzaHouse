<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item active">Quản lý khách hàng</li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản lý khách hàng</h1>
  </div>
</div>
<section class="section customers">
  <div>
    <table>
      <tr class="table__fields">
        <th></th>
        <th>Mã khách hàng</th>
        <th>Tên khách hàng</th>
        <th>Tổng số lần đặt hàng</th>
        <th>Số điện thoại</th>
        <th>Email</th>
        <th>Hành động</th>
      </tr>
      <tr class="table__row filters">
        <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
        <td><input type="text" placeholder="Mã khách hàng"></td>
        <td><input type="text" placeholder="Tên khách hàng"></td>
        <td><input type="text" placeholder="Số lần đặt hàng"></td>
        <td><input type="text" placeholder="Số điện thoại"></td>
        <td><input type="text" placeholder="Email"></td>
        <td><button id="table__filter-btn">Tìm kiếm</button></td>
      </tr>
      <?php 
        list("customers" => $customers) = $response->getBody(); 
        foreach ($customers as $customer): ?>
          <tr class="table__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $customer["customer_id"] ?></td>
            <td><?= $customer["name"] ?></td>
            <td><?= $customer["total_order"] ?></td>
            <td><?= $customer["phone"] ?></td>
            <td><?= $customer["email"] ?></td>
            <td><button><a href="<?= ROOT_ADMIN_CLIENT . "danh-sach-khach-hang/" . $customer["customer_id"] ?>"><i class="bi bi-search"></i></a></button></td>
          </tr>
      <?php endforeach ?>
    </table>
    <div class="pages__list">
      <ul class="pagination">
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">«</span>
          </a>
        </li>
        <li class="page-item"><a class="page-link" href="#">1</a></li>
        <li class="page-item"><a class="page-link" href="#">2</a></li>
        <li class="page-item"><a class="page-link" href="#">3</a></li>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">»</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>