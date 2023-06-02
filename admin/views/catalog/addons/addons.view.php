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
          <div class="modal-body fields">
            <div class="field__wrapper" data-ident="addon-id">
              <input id="addon-id-float-inp" class="custom__field" type="text">
              <label for="addon-id-float-inp" class="field__placeholder">Mã đặc tính</label>
            </div>
            <div class="field__wrapper" data-ident="addon-name">
              <input id="addon-name-float-inp" class="custom__field" type="text">
              <label for="addon-id-float-inp" class="field__placeholder">Tên đặc tính</label>
            </div>
            <div id="et" style="display: none; grid-template-columns: 1fr 1fr; column-gap: .5rem; transition: .5s all;">
              <div class="field__wrapper" data-ident="addon-val">
                <input id="addon-val-float-inp" class="custom__field" type="text">
                <label for="addon-val-float-inp" class="field__placeholder">Tên của tùy chọn</label>
              </div>
              <div class="field__wrapper" data-ident="addon-val-price">
                <input id="addon-val-price-float-inp" class="custom__field" type="text">
                <label for="addon-val-price-float-inp" class="field__placeholder">Giá của tùy chọn</label>
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
        list("addons" => $addons, "total_pages" => $total_pages, "current_page" => $current_page) = $response->getBody();
        foreach ($addons as $addon): 
          list("addon_id" => $addon_id, "addon_name" => $addon_name, "addon_value_count" => $addon_value_count, "created_at" => $created_at) = $addon; ?>
          <tr class="table__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $addon_id ?></td>
            <td><?= $addon_name ?></td>
            <td><?= $addon_value_count ?></td>
            <td><?= $created_at ?></td>
            <td>
              <div class="table__actions">
                <button class="addon-update-btn table__action" data-addon-id="<?= $addon_id ?>"><i class="bi bi-pencil-square"></i></button>
                <button class="addon-remove-btn table__action" data-addon-id="<?= $addon_id ?>"><i class="bi bi-trash2-fill"></i></button>
              </div>
            </td>
          </tr>
      <?php endforeach ?>
    </table>
    <?php if ($current_page < $total_pages) { ?>
      <div class="pages__list">
        <ul class="pagination">
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Previous">
              <span aria-hidden="true">«</span>
            </a>
          </li>
          <?php 
            for ($i = 0; $i < $total_pages; $i++): ?>
              <li class="page-item"><a class="page-link" <?php if($i === $current_page - 1) echo 'style="background: rgb(220, 220, 220);"' ?> href="<?= ROOT_ADMIN_CLIENT . "quan-ly-thuc-don/thuoc-tinh?page=" . ($i + 1) ?>"><?= $i + 1 ?></a></li>
          <?php endfor ?>
          <li class="page-item">
            <a class="page-link" href="#" aria-label="Next">
              <span aria-hidden="true">»</span>
            </a>
          </li>
        </ul>
      </div>
    <?php } ?>
  </div>
</section>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets2.js" ?>"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/addons.js" ?>"></script>