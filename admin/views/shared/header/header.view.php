<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <span class="d-none d-lg-block"></span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>
  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="POST" action="#">
      <input type="text" name="query" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>
  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">
      <li class="nav-item d-block d-lg-none"><a class="nav-link nav-icon search-bar-toggle " href="#"><i class="bi bi-search"></i></a></li>
      <?php 
        if (isset($_SESSION["current_user"])) { 
          $first_name = $_SESSION["current_user"]->profile->firstName; 
          $last_name = $_SESSION["current_user"]->profile->lastName; ?>
          <li class="nav-item dropdown pe-3">
            <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
              <img src="https://cdn-icons-png.flaticon.com/512/666/666201.png" alt="Profile" class="rounded-circle">
              <span class="d-none d-md-block dropdown-toggle ps-2"><?= $first_name . " " . $last_name ?></span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
              <li class="dropdown-header">
                <h6><?= $first_name . " " . $last_name ?></h6>
                <span>Quản lý</span>
              </li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item d-flex align-items-center" href="users-profile.html"><i class="bi bi-gear"></i><span>Cài đặt tài khoản</span></a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item d-flex align-items-center" href="#"><i class="bi bi-box-arrow-right"></i><span>Đăng xuất</span></a></li>
            </ul>
          </li>
      <?php } ?>
    </ul>
  </nav>
</header>