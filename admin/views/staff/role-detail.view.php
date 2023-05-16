<?php list("id" => $role_id, "name" => $role_name, "description" => $role_desc) = $response->getBody(); ?>
<div class="pagetitle">
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-nhan-vien" ?>">Quản lý nhân viên</a></li>
         <li class="breadcrumb-item active">Cập nhật bộ phận <?= $role_id ?></li>
      </ol>
   </nav>
  <h1>Cập nhật bộ phận <?= $role_id ?></h1>
</div>
<section class="section add-role" data-role-id="<?= $role_id ?>">
   <div class="add-role__section">
      <p class="add-role__title">Thông tin cơ bản</p>
      <div class="add-role__section__about">
         <div class="field__wrapper" data-ident="role-name">
            <input class="custom__field" type="text" value="<?= $role_name ?>">
            <label class="field__placeholder">Tên bộ phận</label>
         </div>
         <div class="field__wrapper txtarea" data-ident="role-desc">
            <input class="custom__field" type="text" value="<?= $role_desc ?>">
            <label class="field__placeholder">Thêm mô tả</label>
         </div>
      </div>
   </div>
   <div class="add-role__section">
      <p class="add-role__title">
         Danh sách nhân viên
         <button id="add-employee-btn" type="button" class="btn btn-primary">
            <i style="margin-right: 4px;" class="bi bi-plus-circle"></i>
            Thêm nhân viên
         </button>
         <div class="modal fade" id="verticalycentered" tabindex="-1" style="display: none;" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title">Thêm nhân viên bộ phận</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <div style="display: flex; align-items: center; justify-content: space-between;">
                        <input style="margin-right: 10px; width: 100%; align-self: flex-end; border-bottom: 1px solid rgb(200, 200, 200); padding-bottom: 12px; font-size: 15px;" type="text" placeholder="Mã nhân viên, tên nhân viên,...">
                        <button style="padding: 8px 14px; border-radius: 7px; box-shadow: 0 1px 5px rgb(210, 210, 210);"><i class="bi bi-search"></i></button>
                     </div>
                     <div class="add-role__dialog__employees">
                        <div class="spinner"></div>
                     </div>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                     <input id="save-employee-list-btn" type="submit" class="btn btn-primary" value="Lưu">
                  </div>
               </div>
            </div>
         </div>
      </p>
      <div class="role__employees">
         <div class="spinner"></div>
      </div>
   </div>
   <div class="add-role-actions">
      <button class="refresh-role add-role-btn">Làm mới</button>
      <button class="create-role add-role-btn">Lưu</button>
   </div>
</section>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets.js" ?>"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/role-detail.js" ?>"></script>