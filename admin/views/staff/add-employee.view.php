<div class="pagetitle">
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-nhan-vien" ?>">Quản lý nhân viên</a></li>
         <li class="breadcrumb-item active"><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-nhan-vien/them-nhan-vien" ?>">Thêm nhân viên</a></li>
      </ol>
   </nav>
   <h1>Thêm nhân viên</h1>
</div>
<section class="section add-employee">
   <?php 
      $fields = array(
         "Ảnh hồ sơ" => array(
            "type" => "img", 
            "ident" => "employee-avatar"
         ),
         "Mã nhân viên" => array(
            "type" => "txt", 
            "ident" => "employee-id", 
            "place_holder" => "Mã nhân viên"
         ),
         "Họ và tên" => array(
            "type" => "txt", 
            "ident" => "employee-name", 
            "place_holder" => "Tên nhân viên"
         ),
         "Email" => array(
            "type" => "txt", 
            "ident" => "employee-email", 
            "place_holder" => "Email"
         ),
         "Giới tính" => array(
            "type" => "select",
            "ident" => "employee-gender",
            "title" => "Chọn giới tính",
            "options" => array(
               "1" => "Nam", 
               "0" => "Nữ"
            )
         ),
         "Địa chỉ cư trú" => array(
            "type" => "txt", 
            "ident" => "employee-address", 
            "place_holder" => "Địa chỉ cư trú"
         )
      );
   ?>
   <div id="profile" class="fields selects">
      <div class="part">
      <?php 
            foreach ($fields as $k => $v): ?>
               <p class="title"><?= $k ?></p>
      <?php 
         switch (strtoupper($v["type"])) {
            case "IMG": ?>
               <div class="img__wrapper">
                  <?php echo isset($v["src"]) ? '<img src="' . $v["src"] . '" alt="">' : '<div>Upload here <i class="bi bi-card-image"></i></div>' ?>
               </div>
               <div class="actions">
                  <button><i class="bi bi-upload"></i></button>
               </div>
         <?php break;
            case "TXT": ?>
               <div class="field__wrapper" data-ident="<?= $v["ident"] ?>">
                  <input class="custom__field" type="text">
                  <label class="field__placeholder"><?= $v["place_holder"] ?></label>
               </div>
               <div class="actions">
                  <button><i class="bi bi-pencil-square"></i></button>
               </div>
         <?php break;
            case "SELECT": ?>
               <div class="select__wrapper" data-ident="<?= $v["ident"] ?>">
                  <div class="select__box">
                     <p class="value"><?= $v["title"] ?></p>
                     <i class="bi bi-chevron-down"></i>
                  </div>
                  <div class="options__box">
         <?php foreach ($v["options"] as $k => $v): ?>
                     <p class="option" data-value="<?= $k ?>"><?= $v ?></p>
         <?php endforeach ?>
                  </div>
               </div>
               <div class="actions"></div>
         <?php break; } ?>
         <?php endforeach ?>
      </div>
   </div>
   <div class="detail-actions">
      <button id="refresh">Làm mới</button>
      <button id="save">Lưu</button>
   </div>
</section>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/widgets.js" ?>"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/add-employee.js" ?>"></script>