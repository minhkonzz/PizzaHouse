<div class="pagetitle">
   <nav>
      <ol class="breadcrumb">
         <li class="breadcrumb-item"><a href="<?= ROOT_ADMIN_CLIENT ?>">Bảng điều khiển</a></li>
      </ol>
   </nav>
  <h1>Thống kê hoạt động</h1>
</div>
<section class="section dashboard">
   <div id="dashboard-blocks">
      <div class="dashboard-block total-income">
         <p class="title">Tổng doanh thu <i class="bi bi-wallet2"></i></p>
         <div class="value">
            <span class="value__num"><?= number_format(100000) ?></span>
            <span class="value__ic"><i class="bi bi-arrow-up"></i>5%</span>
         </div>
      </div>
      <div class="dashboard-block total-order">
         <p class="title">Tổng số đơn đặt hàng <i class="bi bi-receipt"></i></p>
         <div class="value">
            <span class="value__num"><?= number_format(122) ?></span>
            <span class="value__ic"><i class="bi bi-arrow-up"></i>2%</span>
         </div>
      </div>
      <div class="dashboard-block registered-customer">
         <p class="title">Khách hàng đăng ký <i class="bi bi-people-fill"></i></p>
         <div class="value">
            <span class="value__num"><?= number_format(85) ?></span>
            <span class="value__ic"><i class="bi bi-arrow-up"></i>4%</span>
         </div>
      </div>
   </div>
   <div id="dashboard-charts">
      <div class="chart bar-chart">
         <canvas id="barChart"></canvas>
      </div>
      <div class="chart donut-chart">
         <canvas id="donutChart"></canvas>
      </div>
   </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= ROOT_ADMIN_CLIENT . "public/js/dashboard1.js" ?>"></script>