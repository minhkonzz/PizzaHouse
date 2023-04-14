<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item active"><a href="<?= ROOT_ADMIN_CLIENT . "/quan-ly-dat-hang" ?>">Quản lý đặt hàng</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản lý đặt hàng</h1>
  </div>
</div>
<section class="section orders">
  <div class="orders__header">
    <div>
      <span>Số sản phẩm hiển thị</span>
      <select style="padding: 6px 8px; border: 1px solid rgb(190, 190, 190); margin-left: 6px; border-radius: 4px;" name="" id="">
        <option value="">6</option>
        <option value="">8</option>
        <option value="">12</option>
      </select>
    </div>
    <butto id="orders__save-excel">
      <i class="bi bi-file-earmark-spreadsheet-fill"></i>
      Lưu Excel
    </button>
  </div>
  <table>
    <tr class="table__fields">
      <th>Mã đơn hàng</th>
      <th>Địa chỉ giao</th>
      <th>Tổng tiền</th>
      <th>Khách hàng</th>
      <th>Trạng thái đơn</th>
      <th>Thời gian đặt</th>
      <th>Hành động</th>
    </tr>
    <tr class="table__row filters">
      <td><input type="text" placeholder="Mã đơn hàng"></td>
      <td><input type="text" placeholder="Địa chỉ giao"></td>
      <td><input type="text" placeholder="Tổng tiền"></td>
      <td><input type="text" placeholder="Khách hàng"></td>
      <td><select name="" id="">
        <option value="">1</option>
        <option value="">2</option>
        <option value="">3</option>
      </select></td>
      <td>
        <input type="date">
        <input style="margin-top: 4px;" type="date">
      </td>
      <td><button id="table__filter-btn">Tìm kiếm</button></td>
    </tr>
    <tr class="table__row">
      <td>#OD12213434</td>
      <td>94 ngõ 73 Nguyễn Lương Bằng Đồng Đa Hà Nội</td>
      <td>945.000đ</td>
      <td>Phạm Quang Minh</td>
      <td><span style="display: block; padding: 6px 12px; border-radius: 5px;"></span></td>
      <td>2019-12-22 21:40:30</td>
      <td>
        <button><i class="bi bi-pencil-square"></i></button>
        <button><i class="bi bi-three-dots-vertical"></i></button>
      </td>
    </tr>
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
</section>