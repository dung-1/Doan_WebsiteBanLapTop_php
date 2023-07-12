<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>ADMIN</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
      <img class="animation__wobble" src="../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-dark">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
          <a href="<?php echo BASE_URL . '/Admin/index.php'; ?>" class="nav-link">Home</a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>

        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-comments"></i>
            <span class="badge badge-danger navbar-badge">3</span>
          </a>

        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
          <a class="nav-link" data-toggle="dropdown" href="#">
            <i class="far fa-bell"></i>
            <span class="badge badge-warning navbar-badge">15</span>
          </a>

        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
            <i class="fas fa-th-large"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <!-- Brand Logo -->
      <a href="<?php echo BASE_URL . '/Admin/index.php'; ?>" class="brand-link">
        <img src="../dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">AdminLTE 3</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
          <div class="image">
            <img src="../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
          </div>
          <div class="info">
            <a href="<?php echo BASE_URL . '/Admin/index.php'; ?>" class="d-block">ADMIN DỤNG</a>
          </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="<?php echo BASE_URL . '/Admin/index.php'; ?>" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>

            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fas fa-laptop"></i>
                <p>
                  QUẢN LÝ SẢN PHẨM
                  <i class="fas fa-angle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">

                <li class="nav-item">
                  <a href="<?php echo BASE_URL . '/Admin/brand/index.php'; ?>" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>HÃNG SẢN PHẨM</p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>LOẠI SẢN PHẨM</p>
                  </a>

                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>SẢN PHẨM</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fa-solid fas fa-user"></i>
                <p>
                  QUẢN LÝ NHÂN VIÊN
                </p>
              </a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  QUẢN LÝ ĐƠN HÀNG
                  <i class="fas fa-angle-down right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>HÓA ĐƠN</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>CHI TIẾT HÓA ĐƠN</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  QUẢN LÝ KHÁCH HÀNG
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-comment"></i>
                <p>
                  QUẢN LÝ PHẢN HỒI
                </p>
              </a>
            </li>  
            <li class="nav-item">
              
                <a href="../../doanPHP/View/logout.php" class="nav-link">
                  <i class="fa-sharp fa-solid fa-right-from-bracket"></i>
                  ĐĂNG XUẤT
                </a>
              
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard </h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="<?php echo BASE_URL . '/Admin/index.php'; ?>">Home</a></li>
                <li class="breadcrumb-item active">Dashboard </li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box">
                <span class="info-box-icon bg-info elevation-1"><i class="fas fa-money-bill"></i></span>

                <?php

                // Kết nối CSDL
                $pdo = get_pdo();

                // Truy vấn để lấy tổng doanh thu từ bảng hóa đơn
                $sql = "SELECT SUM(total_amount) AS total_revenue FROM orders";
                $result = $pdo->query($sql);
                if ($result->rowCount() > 0) {
                  $row = $result->fetch();
                  $tongchiphi = 500;
                  $totalRevenue = $row["total_revenue"];
                  $tongloinhuan = $totalRevenue - $tongchiphi;
                  $targetRevenue = 100000;
                } else {
                  $totalRevenue = 0;
                }
                ?>

                <div class="info-box-content">
                  <span class="info-box-text">Doanh Thu</span>
                  <span class="info-box-number">
                    <?php echo number_format($totalRevenue); ?>
                    <small>VNĐ</small>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-danger elevation-1"><i class="fa-solid fas fa-table"></i></span>

                <?php
                // Truy vấn để lấy số lượng hóa đơn đã bán ra từ bảng "orders"
                $sql = "SELECT COUNT(order_id) AS total_bill FROM orders";
                $result = $pdo->query($sql);

                if ($result->rowCount() > 0) {
                  $row = $result->fetch();
                  $total_bill = $row["total_bill"];
                } else {
                  $total_bill = 0;
                }
                ?>

                <div class="info-box-content">
                  <span class="info-box-text">Đơn Hàng</span>
                  <span class="info-box-number">
                    <?php echo number_format($total_bill); ?>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-laptop"></i></span>

                <?php
                // Truy vấn để lấy số lượng sản phẩm từ bảng "products"
                $sql = "SELECT COUNT(product_id) AS total_product FROM products";
                $result = $pdo->query($sql);

                if ($result->rowCount() > 0) {
                  $row = $result->fetch();
                  $total_product = $row["total_product"];
                } else {
                  $total_product = 0;
                }
                ?>

                <div class="info-box-content">
                  <span class="info-box-text">Sản Phẩm</span>
                  <span class="info-box-number">
                    <?php echo number_format($total_product); ?>
                  </span>
                </div>
              </div>
            </div>

            <div class="col-12 col-sm-6 col-md-3">
              <div class="info-box mb-3">
                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                <?php
                // Truy vấn để lấy số lượng sản phẩm từ bảng "products"
                $sql = "SELECT COUNT(user_id) AS total_product FROM users where role='customer'";
                $result = $pdo->query($sql);

                if ($result->rowCount() > 0) {
                  $row = $result->fetch();
                  $total_product = $row["total_product"];
                } else {
                  $total_product = 0;
                }
                ?>

                <div class="info-box-content">
                  <span class="info-box-text"> Khách Hàng</span>
                  <span class="info-box-number">
                    <?php echo number_format($total_product); ?>
                  </span>
                </div>
                <!-- Placeholder for user info box -->

              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Biểu Đồ Thống Kê Doanh Số 2023</h5>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-8">
                      <p class="text-center"></p>
                      <?php
                      $sql = "SELECT YEAR(order_date) AS year, MONTH(order_date) AS month, SUM(total_amount) AS total_amounts
                      FROM orders
                      GROUP BY YEAR(order_date), MONTH(order_date)
                      ORDER BY YEAR(order_date), MONTH(order_date)";
                      $result = $pdo->query($sql);

                      $chartData = array(); // Mảng trung gian để lưu trữ dữ liệu
                      if ($result) {
                        if ($result->rowCount() > 0) {
                          while ($row = $result->fetch()) {
                            $year = $row["year"];
                            $month = $row["month"];
                            $totalAmount = $row["total_amounts"];

                            $chartData[] = array(
                              "label" => "$month/$year",
                              "value" => $totalAmount
                            );
                          }
                        }
                      } else {
                        echo "Lỗi truy vấn: " . $pdo->errorInfo()[2];
                      }
                      ?>
                      <div class="chart">
                        <!-- Sales Chart Canvas -->
                        <canvas id="myChart" style="min-height: 210px; height: 210px; max-height: 210px; max-width: 100%;"></canvas>
                      </div>
                      <!-- /.chart-responsive -->
                    </div>

                    <div class="col-md-4">
                      <p class="text-center">
                        <strong>Hoàn Thành Mục Tiêu năm 2023</strong>
                      </p>

                      <?php
                      // Lấy dữ liệu doanh thu từ MySQL
                      $sql = "SELECT SUM(total_amount) AS tong_doanh_thu FROM orders";
                      $result = $pdo->query($sql);

                      if ($result->rowCount() > 0) {
                        $row = $result->fetch();
                        $tongDoanhThu = $row["tong_doanh_thu"];
                      } else {
                        $tongDoanhThu = 0;
                      }

                      // Tính toán phần trăm hoàn thành
                      $tiLeHoanThanh = ($tongDoanhThu / 100000) * 100;
                      $tiLeHoanThanh = min(100, $tiLeHoanThanh); // Đảm bảo giá trị không vượt quá 100%
                      ?>

                      <div class="progress-group">
                        Doanh Thu
                        <span class="float-right"><b><?php echo number_format($tongDoanhThu); ?></b>/100,000</span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-primary" style="width: <?php echo $tiLeHoanThanh; ?>%"></div>
                        </div>
                      </div>

                      <?php
                      // Lấy tổng số lượng sản phẩm đã bán ra từ MySQL
                      $sql = "SELECT SUM(quantity) AS tong_so_luong FROM order_details";

                      $result = $pdo->query($sql);

                      if ($result->rowCount() > 0) {
                        $row = $result->fetch();
                        $tongSoLuong = $row["tong_so_luong"];
                      } else {
                        $tongSoLuong = 0;
                      }

                      // Tính toán phần trăm hoàn thành
                      $tiLeHoanThanh = ($tongSoLuong / 200) * 100;
                      $tiLeHoanThanh = min(100, $tiLeHoanThanh); // Đảm bảo giá trị không vượt quá 100%
                      ?>

                      <div class="progress-group">
                        Số Lượng Sản Phẩm Bán Ra <span class="float-right"><b><?php echo number_format($tongSoLuong); ?></b>/200</span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-danger" style="width: <?php echo $tiLeHoanThanh; ?>%"></div>
                        </div>
                      </div>

                      <?php
                      // Đếm số lượng đơn hàng từ MySQL
                      $sql = "SELECT COUNT(*) AS so_luong_don_hang FROM orders";
                      $result = $pdo->query($sql);

                      if ($result->rowCount() > 0) {
                        $row = $result->fetch();
                        $soLuongDonHang = $row["so_luong_don_hang"];
                      } else {
                        $soLuongDonHang = 0;
                      }

                      // Tính toán phần trăm hoàn thành
                      $tiLeHoanThanh = ($soLuongDonHang / 300) * 100;
                      $tiLeHoanThanh = min(100, $tiLeHoanThanh); // Đảm bảo giá trị không vượt quá 100%
                      ?>

                      <div class="progress-group">
                        <span class="progress-text">Đơn Hàng</span>
                        <span class="float-right"><b><?php echo number_format($soLuongDonHang); ?></b>/300</span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-success" style="width: <?php echo $tiLeHoanThanh; ?>%"></div>
                        </div>
                      </div>
                      <?php
                      // Đếm số lượng khách hàng từ MySQL
                      $sql = "SELECT COUNT(*) AS so_luong_khach_hang FROM users where role='customer' ";
                      $result = $pdo->query($sql);

                      if ($result->rowCount() > 0) {
                        $row = $result->fetch();
                        $soLuongKhachHang = $row["so_luong_khach_hang"];
                      } else {
                        $soLuongKhachHang = 0;
                      }

                      // Tính toán phần trăm hoàn thành
                      $tiLeHoanThanh = ($soLuongKhachHang / 1000) * 100;
                      $tiLeHoanThanh = min(100, $tiLeHoanThanh); // Đảm bảo giá trị không vượt quá 100%
                      ?>

                      <div class="progress-group">
                        <span class="progress-text">Số Lượng Khách Hàng</span>
                        <span class="float-right"><b><?php echo number_format($soLuongKhachHang); ?></b>/1,000</span>
                        <div class="progress progress-sm">
                          <div class="progress-bar bg-warning" style="width: <?php echo $tiLeHoanThanh; ?>%"></div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">
                  <h5 class="card-title">Tổng Quan</h5>
                </div>

                <div class="card-footer">
                  <div class="row">
                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header"><?php echo number_format($totalRevenue); ?> VND</h5>
                        <span class="description-text">TỔNG DOANH THU</span>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header"><?php echo number_format($tongchiphi); ?> VND</h5>
                        <span class="description-text">TỔNG CHI PHÍ</span>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block border-right">
                        <h5 class="description-header"><?php echo number_format($tongloinhuan); ?> VND</h5>
                        <span class="description-text">TỔNG LỢI NHUẬN</span>
                      </div>
                    </div>

                    <div class="col-sm-3 col-6">
                      <div class="description-block">
                        <h5 class="description-header"><?php echo number_format($targetRevenue); ?> VND</h5>
                        <span class="description-text">MỤC TIÊU HOÀN THÀNH</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!--/. container-fluid -->
      </section>




      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <style>
      .member-column {
        border-right: 1px solid #000;
        padding: 10px;
        text-align: center;
      }

      .member-column:last-child {
        border-right: none;
      }
    </style>
    <footer class="main-footer">
      <div class="container">
        <div class="row text-info-emphasis text-uppercase ">
          <div class="col">
            <div class="member-column ">
              <i class="fa-solid fa-laptop-code"></i> Nguyễn Văn Dụng
            </div>
          </div>
          <div class="col">
            <div class="member-column">
              <i class="fa-solid fa-laptop-code"></i> Phan Văn Hưng
            </div>
          </div>
          <div class="col">
            <div class="member-column">
              <i class="fa-solid fa-laptop-code"></i> Võ Văn Chính
            </div>
          </div>
        </div>
      </div>
    </footer>
  </div>
  <!-- ./wrapper -->
  <script>
    var chartData = <?php echo json_encode($chartData); ?>;

    var labels = [];
    var values = [];
    chartData.forEach(function(data) {
      labels.push(data.label);
      values.push(data.value);
    });

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Tổng số tiền theo tháng',
          data: values,
          fill: true,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          y: {
            beginAtZero: true,
            ticks: {
              callback: function(value, index, values) {
                return value.toLocaleString() + 'đ';
              }
            }
          }
        },
        plugins: {
          tooltip: {
            callbacks: {
              label: function(context) {
                var label = context.dataset.label || '';
                var value = context.parsed.y.toLocaleString() + 'đ';
                return label + ': ' + value;
              }
            }
          }
        }
      }
    });
  </script>
  <!-- REQUIRED SCRIPTS -->
  <!-- jQuery -->
  <script src="../plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap -->
  <script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- overlayScrollbars -->
  <script src="../plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
  <!-- AdminLTE App -->
  <script src="../dist/js/adminlte.js"></script>

  <!-- PAGE ../PLUGINS -->
  <!-- jQuery Mapael -->
  <script src="../plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
  <script src="../plugins/raphael/raphael.min.js"></script>
  <script src="../plugins/jquery-mapael/jquery.mapael.min.js"></script>
  <script src="../plugins/jquery-mapael/maps/usa_states.min.js"></script>
  <!-- ChartJS -->
  <script src="../plugins/chart.js/Chart.min.js"></script>

  <!-- AdminLTE for demo purposes -->
  <script src="../dist/js/demo.js"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <script src="../dist/js/pages/dashboard2.js"></script>
</body>

</html>