<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item">Quản lý thực đơn</li>
      <li class="breadcrumb-item active"><a href="#">Tất cả thực đơn</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Tất cả thực đơn</h1>
    <button id="add-product-btn" type="button" class="btn btn-primary">
      <i style="margin-right: 4px;" class="bi bi-plus-circle"></i>
      Thêm sản phẩm
    </button>
    <div class="modal fade" id="verticalycentered" tabindex="-1" style="display: none;" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title"></h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body fields">
            <div>
              <p class="modal-body__title">Hình ảnh sản phẩm</p>
              <div id="product__image-container">
                <div id="product__image">
                  <i class="bi bi-image-fill"></i>
                  <p id="title">Kích thước ảnh giới hạn 2048px, định dạng PNG hoặc JPEG</p>
                </div>
                <div id="mask"></div>
                <div id="product__image-buttons">
                  <button id="upload-btn"><i class="bi bi-file-earmark-arrow-up"></i></button>
                </div>
              </div>
            </div>
            <div class="field__wrapper" data-ident="product-id">
              <input id="product-id-float-inp" class="custom__field" type="text">
              <label for="product-id-float-inp" class="field__placeholder">Mã sản phẩm</label>
            </div>
            <div style="margin-top: 10px;" class="field__wrapper" data-ident="product-name">
              <input id="product-name-float-inp" class="custom__field" type="text">
              <label for="product-name-float-inp" class="field__placeholder">Tên sản phẩm</label>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: .5rem;" class="selects">
              <div class="field__wrapper" data-ident="product-price">
                <input id="product-price-float-inp" class="custom__field" type="text">
                <label for="product-price-float-inp" class="field__placeholder">Giá sản phẩm</label>
              </div>
              <div class="select__wrapper" id="category__selection" data-ident="categories">
                <div class="select__box">
                  <p class="value">Danh mục</p>
                  <i class="bi bi-chevron-down"></i>
                </div>
                <div class="options__box"></div>
              </div>
            </div>
            <div class="form-floating">
              <textarea class="form-control" id="product-description-textarea" style="height: 100px;"></textarea>
              <label for="product-description-text-area">Mô tả cho sản phẩm</label>
            </div>
            <div id="product-addons">
              <p class="modal-body__title">Thuộc tính sản phẩm</p>
              <div id="product-addons__list"></div>
              <button style="width: 100%; margin-top: 12px; height: 45px;" id="add-addon-btn" type="button" class="btn btn-outline-primary">Thêm thuộc tính sản phẩm</button>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
            <input id="save-product-btn" type="submit" class="btn btn-primary" value="Lưu">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<section class="section products">
  <div>
    <table id="product__list">
      <tr class="table__fields">
        <th></th>
        <th>Mã sản phẩm</th>
        <th>Hình ảnh và tên sản phẩm</th>
        <th>Danh mục</th>
        <th>Giá sản phẩm</th>
        <th>Tổng được đặt</th>
        <th>Thời gian tạo</th>
        <th>Hành động</th>
      </tr>
      <tr class="table__row filters">
        <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
        <td><input type="text" placeholder="Mã sản phẩm"></td>
        <td><input type="text" placeholder="Tên sản phẩm"></td>
        <!-- <td><select name="product__list__categories" id=""></select></td> -->
        <td class="selects">
          <div class="select__wrapper" data-ident="categories">
              <div style="width: 140px; height: 36px;" class="select__box">
                <p class="value">Danh mục</p>
                <i class="bi bi-chevron-down"></i>
              </div>
              <div class="options__box"></div>
          </div>
        </td>
        <td><input type="text" placeholder="Giá sản phẩm"></td>
        <td><input type="text" placeholder="Tổng được đặt"></td>
        <td>
          <input type="date">
          <input type="date">
        </td>
        <td><button id="table__filter-btn">Tìm kiếm</button></td>
      </tr>
      <?php list("products" => $products, "total_pages" => $total_pages, "current_page" => $current_page) = $response->getBody();
        foreach ($products as $product):
          list(
            "product_id" => $id, 
            "product_name" => $product_name, 
            "image" => $product_image, 
            "price" => $product_price, 
            "currency" => $currency,
            "category_name" => $category_name, 
            "product_created_at" => $product_created_at
          ) = $product; ?>
          <tr class="table__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $id ?></td>
            <td>
              <div style="display: flex; align-items: center">
                <img width="60" src="<?= $product_image ?>" alt="">
                <p style="margin-left: 12px;"><?= $product_name ?></p>
              </div>
            </td>
            <td><?= $category_name ?></td>
            <td><?= number_format($product_price) . " " . $currency ?></td>
            <td>121</td>
            <td><?= $product_created_at ?></td>
            <td>
              <div class="table__actions">
                <button class="product-update-btn table__action" data-product-id="<?= $id ?>"><i class="bi bi-pencil-square"></i></button>
                <button class="product-delete-btn table__action" data-product-id="<?= $id ?>"><i class="bi bi-trash2-fill"></i></button>
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
              <li class="page-item"><a class="page-link" <?php if($i === $current_page - 1) echo 'style="background: rgb(220, 220, 220);"' ?> href="<?= ROOT_ADMIN_CLIENT . "quan-ly-thuc-don/san-pham?page=" . ($i + 1) ?>"><?= $i + 1 ?></a></li>
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
<script type="text/javascript" src="https://www.dropbox.com/static/api/2/dropins.js" id="dropboxjs" data-app-key="vdmdyn3kxq3v1e2"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets2.js" ?>"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/temp-products8.js" ?>"></script>