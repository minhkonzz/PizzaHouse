<div class="pagetitle">
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      <li class="breadcrumb-item active"><a href="#">Quản lý ưu đãi - dịch vụ</a></li>
    </ol>
  </nav>
  <div style="display: flex; justify-content: space-between; align-items: center;">
    <h1>Quản lý ưu đãi</h1>
    <button id="add-category-btn" type="button" class="btn btn-primary"><a href="<?= ROOT_ADMIN_CLIENT . "/quan-ly-uu-dai-dich-vu/tao-uu-dai" ?>">Tạo ưu đãi</a></button>
  </div>
</div>
<section class="section discounts-services">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button 
        class="nav-link active" 
        id="discount-list-tab" 
        data-bs-toggle="tab" 
        data-bs-target="#discount-list" 
        type="button" 
        role="tab" 
        aria-controls="discount-list" 
        aria-selected="true">Danh sách ưu đãi
      </button>
    </li>
    <li class="nav-item" role="presentation">
      <button 
        class="nav-link" 
        id="service-list-tab" 
        data-bs-toggle="tab" 
        data-bs-target="#service-list" 
        type="button" 
        role="tab" 
        aria-controls="service-list" 
        aria-selected="false">Danh sách dịch vụ
      </button>
    </li>
  </ul>
  <div class="tab-content pt-2" id="myTabContent">
    <div class="tab-pane fade show active" id="discount-list" role="tabpanel" aria-labelledby="discount-list-tab">
      <table>
        <tr class="table__fields">
          <th></th>
          <th>Mã ưu đãi</th>
          <th>Tên ưu đãi</th>
          <th>Ngày tạo</th>
          <th>Ngày hết hạn</th>
          <th>Code</th>
          <th>Kích hoạt</th>
          <th>Hành động</th>
        </tr>
        <tr class="table__row filters">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td><input type="text" placeholder="Mã ưu đãi"></td>
          <td><input type="text" placeholder="Tên ưu đãi"></td>
          <td><input type="date" placeholder="Ngày tạo"></td>
          <td><input type="date" placeholder="Ngày hết hạn"></td>
          <td><input type="text" placeholder="Code"></td>
          <td><select name="" id="">
            <option value="">Đã kích hoạt</option>
            <option value="">Chưa kích hoạt</option>
          </select></td>
          <td><button id="table__filter-btn">Tìm kiếm</button></td>
        </tr>
        <tr class="table__row">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td>#UD00121299</td>
          <td>Ưu đãi 1</td>
          <td>29-03-2023</td>
          <td>12-04-2023</td>
          <td>GYD923929</td>
          <td></td>
          <td>
            <button><i class="bi bi-pencil-square"></i></button>
            <button><i class="bi bi-three-dots-vertical"></i></button>
          </td>
        </tr>
        <tr class="table__row">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td>#UD00121299</td>
          <td>Ưu đãi 1</td>
          <td>29-03-2023</td>
          <td>12-04-2023</td>
          <td>GYD923929</td>
          <td></td>
          <td>
            <button><i class="bi bi-pencil-square"></i></button>
            <button><i class="bi bi-three-dots-vertical"></i></button>
          </td>
        </tr>
        <tr class="table__row">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td>#UD00121299</td>
          <td>Ưu đãi 1</td>
          <td>29-03-2023</td>
          <td>12-04-2023</td>
          <td>GYD923929</td>
          <td></td>
          <td>
            <button><i class="bi bi-pencil-square"></i></button>
            <button><i class="bi bi-three-dots-vertical"></i></button>
          </td>
        </tr>
      </table>
    </div>
    <div class="tab-pane fade" id="service-list" role="tabpanel" aria-labelledby="service-list-tab">
      <table>
        <tr class="table__fields">
          <th></th>
          <th>Mã dịch vụ</th>
          <th>Tên dịch vụ</th>
          <th>Thời gian tạo</th>
          <th>Kích hoạt</th>
          <th>Hành động</th>
        </tr>
        <tr class="table__row filters">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td><input type="text" placeholder="Mã dịch vụ"></td>
          <td><input type="text" placeholder="Tên dịch vụ"></td>
          <td><input type="date" placeholder="Thời gian tạo"></td>
          <td><select name="" id="">
            <option value="">Đã kích hoạt</option>
            <option value="">Chưa kích hoạt</option>
          </select></td>
          <td><button id="table__filter-btn">Tìm kiếm</button></td>
        </tr>
        <tr class="table__row">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td>#DV00121299</td>
          <td>Gói bánh làm quà</td>
          <td>29-03-2023 13:21:54</td>
          <td></td>
          <td>
            <button><i class="bi bi-pencil-square"></i></button>
            <button><i class="bi bi-three-dots-vertical"></i></button>
          </td>
        </tr>
        <tr class="table__row">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td>#DV00102432</td>
          <td>Đặt làm pizza theo yêu cầu</td>
          <td>29-03-2023 16:24:40</td>
          <td></td>
          <td>
            <button><i class="bi bi-pencil-square"></i></button>
            <button><i class="bi bi-three-dots-vertical"></i></button>
          </td>
        </tr>
        <tr class="table__row">
          <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
          <td>#DV102345543</td>
          <td>Đặt hàng số lượng lớn</td>
          <td>29-03-2023 11:35:21</td>
          <td></td>
          <td>
            <button><i class="bi bi-pencil-square"></i></button>
            <button><i class="bi bi-three-dots-vertical"></i></button>
          </td>
        </tr>
      </table>
    </div>
  </div>
</section>
