<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item active">Quản lý nhân viên</li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản lý nhân viên</h1>
    <button id="add-employee-btn" type="button" class="btn btn-primary">Thêm nhân viên</button>
  </div>
</div>
<section class="section employees">
  <div>
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="employee-list-tab" data-bs-toggle="tab" data-bs-target="#employee-list" type="button" role="tab" aria-controls="employee-list" aria-selected="true">Nhân viên</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="employee-roles-tab" data-bs-toggle="tab" data-bs-target="#employee-roles" type="button" role="tab" aria-controls="employee-roles" aria-selected="false">Bộ phận</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="employee-permissions-tab" data-bs-toggle="tab" data-bs-target="#employee-permissions" type="button" role="tab" aria-controls="employee-permissions" aria-selected="false">Phân quyền</button>
      </li>
    </ul>
    <div class="tab-content pt-2" id="myTabContent">
      <div class="tab-pane fade show active" id="employee-list" role="tabpanel" aria-labelledby="employee-list-tab">
        <table>
          <tr class="table__fields">
            <th></th>
            <th>Mã nhân viên</th>
            <th>Họ và tên</th>
            <th>Ngày tạo</th>
            <th>Bộ phận</th>
            <th>Kích hoạt</th>
            <th>Hành động</th>
          </tr>
          <tr class="table__row filters">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><input type="text" placeholder="Mã nhân viên"></td>
            <td><input type="text" placeholder="Họ và tên"></td>
            <td><input type="date" placeholder="Ngày tạo"></td>
            <td><select name="" id="">
              <option value="">Đầu bếp</option>
              <option value="">Bán hàng</option>
            </select></td>
            <td><select name="" id="">
              <option value="1">Đã kích hoạt</option>
              <option value="0">Chưa kích hoạt</option>
            </select></td>
            <td><button id="employees__filter-btn">Tìm kiếm</button></td>
          </tr>
          <?php 
            list("staff" => $staff, "roles" => $roles) = $response->getBody();
            foreach ($staff as $s): ?>
              <tr class="table__row">
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                <td><?= $s["staff_id"] ?></td>
                <td><?= $s["name"] ?></td>
                <td><?= $s["created_at"] ?></td>
                <td><?= $s["role"] ?></td>
                <td><?= $s["is_activated"] ?></td>
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
      <div class="tab-pane fade" id="employee-roles" role="tabpanel" aria-labelledby="employee-roles-tab">
        <table>
          <tr class="table__fields">
            <th></th>
            <th>Mã bộ phận</th>
            <th>Tên bộ phận</th>
            <th>Số nhân viên</th>
            <th>Hành động</th>
          </tr>
          <tr class="table__row filters">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><input type="text" placeholder="Mã bộ phận"></td>
            <td><input type="text" placeholder="Tên bộ phận"></td>
            <td><input type="text" placeholder="Số nhân viên"></td>
            <td><button id="table__filter-btn">Tìm kiếm</button></td>
          </tr>
          <?php 
            foreach ($roles as $role): ?>
              <tr class="table__row">
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                <td><?= $role["role_id"] ?></td>
                <td><?= $role["role"] ?></td>
                <td><?= $role["total_staff"] ?></td>
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
      <div class="tab-pane fade" id="employee-permissions" role="tabpanel" aria-labelledby="employee-permissions-tab">
        <div style="display: grid; grid-template-columns: 1fr 3.5fr; column-gap: 1rem; margin-top: 8px;">
          <div>
            <ul style="border: .5px solid rgb(235, 235, 235); background-color: #fff; border-radius: 8px;">
              <li><button style="padding: 12px; border-bottom: .5px solid rgb(235, 235, 235); font-size: 13px; width: 100%; text-align: left;">SuperAdmin</button></li>
              <li><button style="padding: 12px; border-bottom: .5px solid rgb(235, 235, 235); font-size: 13px; width: 100%; text-align: left;">Đầu bếp</button></li>
              <li><button style="padding: 12px; border-bottom: .5px solid rgb(235, 235, 235); font-size: 13px; width: 100%; text-align: left;">Kế toán</button></li>
              <li><button style="padding: 12px; font-size: 13px; width: 100%; text-align: left;">Bán hàng</button></li>
            </ul>
          </div>
          <div style="border: 1px solid rgb(235, 235, 235); height: 500px; background-color: #fff; border-radius: 8px;">
            <table>
              <tr class="table__fields">
                <th style="padding: 0 200px 0 14px;"></th>
                <th><div style="display: flex; align-items: center;"><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"> Chỉ xem</div></th>
                <th><div style="display: flex; align-items: center;"><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"> Chỉnh sửa</div></th>
                <th><div style="display: flex; align-items: center;"><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"> Xóa</div></th>
              </tr>
              <tr class="table__row">
                <td style="padding: 0 200px 0 14px;">Cập nhật sản phẩm</td>
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
              </tr>
              <tr class="table__row">
                <td style="padding: 0 200px 0 14px;">Thêm mới sản phẩm</td>
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
              </tr>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script></script>