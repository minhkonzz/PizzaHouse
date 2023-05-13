<div class="pagetitle">
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-nhan-vien" ?>">Quản lý nhân viên</a></li>
         <li class="breadcrumb-item active">Thêm bộ phận nhà hàng</li>
      </ol>
   </nav>
  <h1>Thêm bộ phận nhà hàng</h1>
</div>
<section class="section add-role">
   <div class="add-role__section">
      <p class="add-role__title">Thông tin cơ bản</p>
      <div class="add-role__section__about">
         <div class="wk2">
            <div class="field__wrapper">
               <input class="custom__field" type="text">
               <label class="field__placeholder">Mã bộ phận</label>
            </div>
            <div class="field__wrapper">
               <input class="custom__field" type="text">
               <label class="field__placeholder">Tên bộ phận</label>
            </div>
         </div>
         <div class="wk3">
            <div class="field__wrapper">
               <input class="custom__field" type="text">
               <label class="field__placeholder">Thêm mô tả</label>
            </div>
         </div>
      </div>
   </div>
   <div class="add-role__section">
      <p class="add-role__title">Danh sách nhân viên</p>
      <table>
         <tr class="table__fields">
            <th></th>
            <th>Mã nhân viên</th>
            <th>Họ và tên</th>
            <th>Thời gian tạo</th>
            <th>Hành động</th>
         </tr>
         <tr class="table__row filters">
            <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
            <td><input type="text" placeholder="Mã nhân viên"></td>
            <td><input type="text" placeholder="Họ và tên"></td>
            <td><input type="date" placeholder="Thời gian tạo"></td>
            <td><button id="employees__filter-btn">Tìm kiếm</button></td>
         </tr>
         <!-- <?php 
            list("staff" => $staff) = $response->getBody();
            foreach ($staff as $s): 
               list("firstName" => $first_name, "lastName" => $last_name) = $s["profile"] ?>
               <tr class="table__row">
                  <td><input type="checkbox" style="width: 15px; height: 15px; margin: 0 15px;"></td>
                  <td><?= $s["id"] ?></td>
                  <td><?= $first_name . " " . $last_name ?></td> 
                  <td><?= DateTime::createFromFormat("Y-m-d\TH:i:s.u\Z", $s["created"])->format("Y-m-d H:i:s") ?></td>
                  <td>
                     <button><i class="bi bi-pencil-square"></i></button>
                     <button><i class="bi bi-three-dots-vertical"></i></button>
                  </td>
               </tr>
         <?php endforeach ?> -->
      </table>
   </div>
   <div class="add-role-actions">
      <button class="refresh-role add-role-btn">Làm mới</button>
      <button class="create-role add-role-btn">Lưu</button>
   </div>
</section>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets.js" ?>"></script>