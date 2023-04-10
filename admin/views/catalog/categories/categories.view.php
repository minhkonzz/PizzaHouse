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
    <button id="add-category-btn" type="button" class="btn btn-primary">Tạo danh mục</button>
  </div>
</div>
<section class="section categories">
  <div>
    <table class="categories__table">
      <tr class="categories__table__fields">
        <th></th>
        <th>Mã danh mục</th>
        <th>Tên danh mục</th>
        <th>Thời gian tạo</th>
        <th>Số sản phẩm áp dụng</th>
        <th>Hành động</th>
      </tr>
      <tr class="categories__row filters">
        <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
        <td><input type="text" placeholder="Mã danh mục"></td>
        <td><input type="text" placeholder="Tên danh mục"></td>
        <td><input type="date" placeholder="Thời gian tạo"></td>
        <td><input type="text" placeholder="Số sản phẩm áp dụng"></td>
        <td><button id="categories__filter-btn">Tìm kiếm</button></td>
      </tr>
      <?php 
        list("categories" => $categories) = $response->getBody();
        foreach ($categories as $category): ?>
          <tr class="categories__row">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><?= $category["id"] ?></td>
            <td><?= $category["category_name"] ?></td>
            <td><?= $category["created_at"] ?></td>
            <td>5</td>
            <td>
              <button><i class="bi bi-pencil-square"></i></button>
              <button><i class="bi bi-three-dots-vertical"></i></button>
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