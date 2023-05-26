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
          <div class="modal-body fields">
            <div class="field__wrapper" data-ident="category-id">
              <input id="category-id-float-inp" class="custom__field" type="text">
              <label for="category-id-float-inp" class="field__placeholder">Mã danh mục thực đơn</label>
            </div>
            <div class="field__wrapper" data-ident="category-name">
              <input id="category-name-float-inp" class="custom__field" type="text">
              <label for="category-name-float-inp" class="field__placeholder">Tên danh mục thực đơn</label>
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
        list("categories" => $categories, "total_pages" => $total_pages, "current_page" => $current_page) = $response->getBody();
        foreach ($categories as $category): 
          list("category_id" => $id, "category_name" => $category_name, "created_at" => $created_at, "total_products" => $total_products) = $category; ?>
          <tr class="table__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $id ?></td>
            <td><?= $category_name ?></td>
            <td><?= $created_at ?></td>
            <td><?= number_format($total_products) ?></td>
            <td>
              <button class="category-update-btn table__action" data-category-id="<?= $id ?>"><i class="bi bi-pencil-square"></i></button>
              <button class="category-delete-btn table__action" data-category-id="<?= $id ?>"><i class="bi bi-trash2-fill"></i></button>
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
        <?php 
          for ($i = 0; $i < $total_pages; $i++): ?>
            <li class="page-item"><a class="page-link" <?php if($i === $current_page - 1) echo 'style="background: rgb(220, 220, 220);"' ?> href="<?= ROOT_ADMIN_CLIENT . "quan-ly-thuc-don/danh-muc?page=" . ($i + 1) ?>"><?= $i + 1 ?></a></li>
        <?php endfor ?>
        <li class="page-item">
          <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">»</span>
          </a>
        </li>
      </ul>
    </div>
  </div>
</section>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets1.js" ?>"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/categories.js" ?>"></script>