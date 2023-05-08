<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item">Quản lý thực đơn</li>
      <li class="breadcrumb-item active"><a href="#">Quản lý thuộc tính sản phẩm</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản lý thuộc tính sản phẩm</h1>
    <button id="add-addon-btn" type="button" class="btn btn-primary">
      <i style="margin-right: 4px;" class="bi bi-plus-circle"></i>
      Thêm thuộc tính
    </button>
    <div class="modal fade" id="modalDialogScrollable" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable">
        <form class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Thêm thuộc tính sản phẩm</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="form-floating">
              <input type="text" class="form-control" name="addon_id" id="addon-id-float-inp" placeholder="Mã đặc tính">
              <label for="addon-id-float-inp">Mã thuộc tính</label>
            </div>
            <div class="form-floating">
              <input type="text" class="form-control" name="addon_name" id="addon-name-float-inp" placeholder="Tên đặc tính">
              <label for="addon-name-float-inp">Tên thuộc tính</label>
            </div>
            <div id="et" style="display: none; grid-template-columns: 1fr 1fr; column-gap: .5rem; transition: .5s all;">
              <div class="form-floating">
                <input type="text" class="form-control" name="addon_val" id="addon-val-float-inp" placeholder="Tên của tùy chọn">
                <label for="addon-val-float-inp">Tên của tùy chọn</label>
              </div>
              <div class="form-floating">
                <input type="text" class="form-control" name="addon_val_price" id="addon-val-price-float-inp" placeholder="Giá của tùy chọn">
                <label for="addon-val-price-float-inp">Giá của tùy chọn</label>
              </div>
            </div>
            <div style="margin-top: 14px;">
              <button id="add-addon-val-btn" type="button" class="btn btn-outline-primary">Thêm tùy chọn</button>
              <button id="cancel-add-addon-val-btn" style="display: none;" type="button" class="btn btn-outline-danger">Hủy</button>
            </div>
            <div style="margin-top: 15px;">
              <p>Tất cả tùy chọn</p>
              <div id="addon-options"></div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <button id="save-addon-btn" type="button" class="btn btn-primary">Lưu</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<section class="section addons">
  <div>
    <table id="addon__list">
      <tr class="table__fields">
        <th></th>
        <th>Mã thuộc tính</th>
        <th>Tên thuộc tính</th>
        <th>Số lượng tùy chọn</th>
        <th>Thời gian tạo</th>
        <th>Hành động</th>
      </tr>
      <tr class="table__row filters">
        <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
        <td><input type="text" placeholder="Mã thuộc tính"></td>
        <td><input type="text" placeholder="Tên thuộc tính"></td>
        <td><input type="date" placeholder="Số lượng tùy chọn"></td>
        <td>
          <input type="date">
          <input type="date">
        </td>
        <td><button id="table__filter-btn">Tìm kiếm</button></td>
      </tr>
      <?php 
        list("addons" => $addons) = $response->getBody();
        foreach ($addons as $addon): 
          list("addon_id" => $addon_id, "addon_name" => $addon_name, "addon_value_count" => $addon_value_count, "created_at" => $created_at) = $addon; ?>
          <tr class="table__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $addon_id ?></td>
            <td><?= $addon_name ?></td>
            <td><?= $addon_value_count ?></td>
            <td><?= $created_at ?></td>
            <td>
              <button class="addon-update-btn" data-addon-id="<?= $addon_id ?>"><i class="bi bi-pencil-square"></i></button>
              <button class="addon-remove-btn" data-addon-id="<?= $addon_id ?>"><i class="bi bi-trash2-fill"></i></button>
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
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/addons.js" ?>"></script>