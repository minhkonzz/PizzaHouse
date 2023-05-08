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
          <div class="modal-body">
            <p style="font-size: 14px; font-weight: 600;">Hình ảnh sản phẩm</p>
            <div style="display: grid; grid-template-columns: 1fr 2fr; column-gap: .5rem; margin-top: 10px;">
              <div>
                <div id="image-add-product">
                  <div id="image-add-product-btn">
                    <input hidden type="file" name="product_image" id="btn-upload-file">
                    <label for="btn-upload-file" style="outline: none; border: none; width: 150px; height: 120px; background-color: rgb(230, 230, 230);" class="d-flex flex-column justify-content-center align-items-center"><i class="bi bi-image-fill"></i><p style="margin-top: 10px;">Upload image</p></label>
                  </div>
                </div>
              </div>
              <div>
                <div class="form-floating">
                  <input type="text" class="form-control" name="product_id" id="product-id-float-inp" placeholder="Mã sản phẩm">
                  <label for="product-id-float-inp">Mã sản phẩm</label>
                </div>
                <div style="margin-top: 10px;" class="form-floating">
                  <input type="text" class="form-control" name="product_name" id="product-name-float-inp" placeholder="Tên sản phẩm">
                  <label for="product-name-float-inp">Tên sản phẩm</label>
                </div>
              </div>
            </div>
            <div style="display: grid; grid-template-columns: 1fr 1fr; column-gap: .5rem;">
              <div class="form-floating">
                <input type="text" class="form-control" name="product_price" id="product-price-float-inp" placeholder="Giá sản phẩm">
                <label for="product-price-float-inp">Giá sản phẩm</label>
              </div>
              <div class="form-floating">
                <select class="form-select" id="category-selection">
                  <option value="0" selected>----</option>
                </select>
                <label for="category-selection">Danh mục thực đơn</label>
              </div>
            </div>
            <div class="form-floating">
              <textarea class="form-control" id="product-description-textarea" style="height: 100px;"></textarea>
              <label for="product-description-text-area">Mô tả cho sản phẩm</label>
            </div>
            <div id="product-addons">
              <p class="product-addons__title" style="font-size: 14px; font-weight: 600;">Thuộc tính sản phẩm</p>
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
        <td><select name="product__list__categories" id=""></select></td>
        <td><input type="text" placeholder="Giá sản phẩm"></td>
        <td><input type="text" placeholder="Tổng được đặt"></td>
        <td>
          <input type="date">
          <input type="date">
        </td>
        <td><button id="table__filter-btn">Tìm kiếm</button></td>
      </tr>
        <?php list("products" => $products) = $response->getBody();
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
                <img width="60" src="<?= ROOT_CLIENT . "public/images/products/" . $product_image ?>" alt="">
                <p style="margin-left: 12px;"><?= $product_name ?></p>
              </div>
            </td>
            <td><?= $category_name ?></td>
            <td><?= number_format($product_price) . " " . $currency ?></td>
            <td>121</td>
            <td><?= $product_created_at ?></td>
            <td>
              <button class="product-update-btn" data-product-id="<?= $id ?>"><i class="bi bi-pencil-square"></i></button>
              <button class="product-delete-btn" data-product-id="<?= $id ?>"><i class="bi bi-trash2-fill"></i></button>
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
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/products.js" ?>"></script>