<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item"><a class="nav-link " href="<?= ROOT_ADMIN_CLIENT . "tong-quan" ?>"><i class="bi bi-grid"></i><span>Tổng quan</span></a></li>
    <li class="nav-item">
      <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
        <i class="bi bi-journal-text"></i><span>Quản lý thực đơn</span><i class="bi bi-chevron-down ms-auto"></i>
      </a>
      <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        <li><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-thuc-don/danh-muc" ?>"><i class="bi bi-circle"></i><span>Danh mục thực đơn</span></a></li>
        <li><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-thuc-don/san-pham" ?>"><i class="bi bi-circle"></i><span>Tất cả thực đơn</span></a></li>
        <li><a href="<?= ROOT_ADMIN_CLIENT . "quan-ly-thuc-don/dac-tinh-san-pham" ?>"><i class="bi bi-circle"></i><span>Quản lý đặc tính sản phẩm</span></a></li>
      </ul>
    </li>
    <li class="nav-item"><a class="nav-link collapsed" href="<?= ROOT_ADMIN_CLIENT . "quan-ly-don-hang" ?>"><i class="bi bi-person"></i><span>Quản lý đặt hàng</span></a></li>
    <li class="nav-item"><a class="nav-link collapsed" href="<?= ROOT_ADMIN_CLIENT . "quan-ly-bai-viet" ?>"><i class="bi bi-book"></i><span>Quản lý bài viết</span></a></li>
    <li class="nav-item"><a class="nav-link collapsed" href="<?= ROOT_ADMIN_CLIENT . "quan-ly-uu-dai-dich-vu" ?>"><i class="bi bi-person"></i><span>Quản lý ưu đãi - dịch vụ</span></a></li>
    <li class="nav-item"><a class="nav-link collapsed" href="<?= ROOT_ADMIN_CLIENT . "quan-ly-nhan-vien" ?>"><i class="bi bi-person"></i><span>Quản lý nhân viên</span></a></li>
    <li class="nav-item"><a class="nav-link collapsed" href="<?= ROOT_ADMIN_CLIENT . "danh-sach-khach-hang" ?>"><i class="bi bi-people"></i><span>Danh sách khách hàng</span></a></li>
    <li class="nav-item"><a class="nav-link collapsed" href="<?= ROOT_ADMIN_CLIENT . "cai-dat-he-thong" ?>"><i class="bi bi-gear"></i><span>Cài đặt hệ thống</span></a></li>
  </ul>
</aside>