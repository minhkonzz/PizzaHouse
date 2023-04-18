<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item">Quản lý thực đơn</li>
      <li class="breadcrumb-item active"><a href="#">Quản lý danh mục</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản lý danh mục sản phẩm</h1>
    <button id="add-category-btn" type="button" class="btn btn-primary">
      <i style="margin-right: 4px;" class="bi bi-plus-circle"></i>
      Thêm danh mục
    </button>
    <div class="modal fade" id="verticalycentered" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Thêm danh mục thực đơn mới</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-floating">
              <input type="text" id="category-id-float-inp" class="form-control" placeholder="Mã danh mục thực đơn">
              <label for="category-id-float-inp">Mã danh mục thực đơn</label>
            </div>
            <div class="form-floating">
              <input type="text" id="category-name-float-inp" class="form-control" placeholder="Tên danh mục thực đơn">
              <label for="category-name-float-inp">Tên danh mục thực đơn</label>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button type="button" id="save-category-btn" class="btn btn-primary">Lưu</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="section categories">
  <div>
    <table id="category__list">
      <tr class="table__fields">
        <th></th>
        <th>Mã danh mục</th>
        <th>Tên danh mục</th>
        <th>Thời gian tạo</th>
        <th>Số sản phẩm áp dụng</th>
        <th>Hành động</th>
      </tr>
      <tr class="table__row filters">
        <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
        <td><input type="text" placeholder="Mã danh mục"></td>
        <td><input type="text" placeholder="Tên danh mục"></td>
        <td><input type="date" placeholder="Thời gian tạo"></td>
        <td><input type="text" placeholder="Số sản phẩm áp dụng"></td>
        <td><button id="table__filter-btn">Tìm kiếm</button></td>
      </tr>
      <?php 
        list("categories" => $categories) = $response->getBody();
        foreach ($categories as $category): ?>
          <tr class="table__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $category["id"] ?></td>
            <td><?= $category["category_name"] ?></td>
            <td><?= $category["created_at"] ?></td>
            <td>5</td>
            <td>
              <button class="category-update-btn" data-category-id="<?= $category["id"] ?>"><i class="bi bi-pencil-square"></i></button>
              <button class="category-delete-btn" data-category-id="<?= $category["id"] ?>"><i class="bi bi-trash2-fill"></i></button>
            </td>
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
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/categories.js" ?>"></script>