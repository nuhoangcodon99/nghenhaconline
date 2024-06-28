 <?php
 $tong_bai = $ACAIVIPPRO->num_rows("SELECT * FROM `posts`");
 $tong_cate = $ACAIVIPPRO->num_rows("SELECT * FROM `category`");
 $tong_thang = $ACAIVIPPRO->get_row("SELECT SUM(view_month) AS thang FROM `posts` WHERE `view_month` > 0");
 $tong_view = $ACAIVIPPRO->get_row("SELECT SUM(view) AS tong FROM `posts` WHERE `view` > 0");
 ?>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
          <div class="row">
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-info"><i class="fas fa-file-alt"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng Bài Viết</span>
                <span class="info-box-number"><?=$tong_bai;?> bài viết</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-success"><i class="fas fa-folder-open"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng Thể loại</span>
                <span class="info-box-number"><?=$tong_cate;?> Thể loại</span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-warning"><i class="fas fa-chart-pie"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng View Tháng</span>
                <span class="info-box-number"><?=$tong_thang['thang'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-md-3 col-sm-6 col-12">
            <div class="info-box">
              <span class="info-box-icon bg-danger"><i class="far fa-window-maximize"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Tổng View</span>
                <span class="info-box-number"><?=$tong_view['tong'];?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>
        <!--<div class="row">-->
        <!--  <div class="col-lg-6">-->
        <!--    <div class="card">-->
        <!--      <div class="card-header border-0">-->
        <!--        <div class="d-flex justify-content-between">-->
        <!--          <h3 class="card-title">Online Store Visitors</h3>-->
        <!--          <a href="javascript:void(0);">View Report</a>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--      <div class="card-body">-->
        <!--        <div class="d-flex">-->
        <!--          <p class="d-flex flex-column">-->
        <!--            <span class="text-bold text-lg">0</span>-->
        <!--            <span>Visitors Over Time</span>-->
        <!--          </p>-->
        <!--          <p class="ml-auto d-flex flex-column text-right">-->
        <!--            <span class="text-success">-->
        <!--              <i class="fas fa-arrow-up"></i> 12.5%-->
        <!--            </span>-->
        <!--            <span class="text-muted">Since last week</span>-->
        <!--          </p>-->
        <!--        </div>-->
                <!-- /.d-flex -->

        <!--        <div class="position-relative mb-4">-->
        <!--          <canvas id="visitors-chart" height="200"></canvas>-->
        <!--        </div>-->

        <!--        <div class="d-flex flex-row justify-content-end">-->
        <!--          <span class="mr-2">-->
        <!--            <i class="fas fa-square text-primary"></i> This Week-->
        <!--          </span>-->

        <!--          <span>-->
        <!--            <i class="fas fa-square text-gray"></i> Last Week-->
        <!--          </span>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- /.card -->

        <!--    <div class="card">-->
        <!--      <div class="card-header border-0">-->
        <!--        <h3 class="card-title">Products</h3>-->
        <!--        <div class="card-tools">-->
        <!--          <a href="#" class="btn btn-tool btn-sm">-->
        <!--            <i class="fas fa-download"></i>-->
        <!--          </a>-->
        <!--          <a href="#" class="btn btn-tool btn-sm">-->
        <!--            <i class="fas fa-bars"></i>-->
        <!--          </a>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--      <div class="card-body table-responsive p-0">-->
        <!--        <table class="table table-striped table-valign-middle">-->
        <!--          <thead>-->
        <!--          <tr>-->
        <!--            <th>Product</th>-->
        <!--            <th>Price</th>-->
        <!--            <th>Sales</th>-->
        <!--            <th>More</th>-->
        <!--          </tr>-->
        <!--          </thead>-->
        <!--          <tbody>-->
        <!--          <tr>-->
        <!--            <td>-->
        <!--              <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">-->
        <!--              Some Product-->
        <!--            </td>-->
        <!--            <td>$13 USD</td>-->
        <!--            <td>-->
        <!--              <small class="text-success mr-1">-->
        <!--                <i class="fas fa-arrow-up"></i>-->
        <!--                12%-->
        <!--              </small>-->
        <!--              12,000 Sold-->
        <!--            </td>-->
        <!--            <td>-->
        <!--              <a href="#" class="text-muted">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--              </a>-->
        <!--            </td>-->
        <!--          </tr>-->
        <!--          <tr>-->
        <!--            <td>-->
        <!--              <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">-->
        <!--              Another Product-->
        <!--            </td>-->
        <!--            <td>$29 USD</td>-->
        <!--            <td>-->
        <!--              <small class="text-warning mr-1">-->
        <!--                <i class="fas fa-arrow-down"></i>-->
        <!--                0.5%-->
        <!--              </small>-->
        <!--              123,234 Sold-->
        <!--            </td>-->
        <!--            <td>-->
        <!--              <a href="#" class="text-muted">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--              </a>-->
        <!--            </td>-->
        <!--          </tr>-->
        <!--          <tr>-->
        <!--            <td>-->
        <!--              <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">-->
        <!--              Amazing Product-->
        <!--            </td>-->
        <!--            <td>$1,230 USD</td>-->
        <!--            <td>-->
        <!--              <small class="text-danger mr-1">-->
        <!--                <i class="fas fa-arrow-down"></i>-->
        <!--                3%-->
        <!--              </small>-->
        <!--              198 Sold-->
        <!--            </td>-->
        <!--            <td>-->
        <!--              <a href="#" class="text-muted">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--              </a>-->
        <!--            </td>-->
        <!--          </tr>-->
        <!--          <tr>-->
        <!--            <td>-->
        <!--              <img src="dist/img/default-150x150.png" alt="Product 1" class="img-circle img-size-32 mr-2">-->
        <!--              Perfect Item-->
        <!--              <span class="badge bg-danger">NEW</span>-->
        <!--            </td>-->
        <!--            <td>$199 USD</td>-->
        <!--            <td>-->
        <!--              <small class="text-success mr-1">-->
        <!--                <i class="fas fa-arrow-up"></i>-->
        <!--                63%-->
        <!--              </small>-->
        <!--              87 Sold-->
        <!--            </td>-->
        <!--            <td>-->
        <!--              <a href="#" class="text-muted">-->
        <!--                <i class="fas fa-search"></i>-->
        <!--              </a>-->
        <!--            </td>-->
        <!--          </tr>-->
        <!--          </tbody>-->
        <!--        </table>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- /.card -->
        <!--  </div>-->
          <!-- /.col-md-6 -->
        <!--  <div class="col-lg-6">-->
        <!--    <div class="card">-->
        <!--      <div class="card-header border-0">-->
        <!--        <div class="d-flex justify-content-between">-->
        <!--          <h3 class="card-title">Sales</h3>-->
        <!--          <a href="javascript:void(0);">View Report</a>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--      <div class="card-body">-->
        <!--        <div class="d-flex">-->
        <!--          <p class="d-flex flex-column">-->
        <!--            <span class="text-bold text-lg">$18,230.00</span>-->
        <!--            <span>Sales Over Time</span>-->
        <!--          </p>-->
        <!--          <p class="ml-auto d-flex flex-column text-right">-->
        <!--            <span class="text-success">-->
        <!--              <i class="fas fa-arrow-up"></i> 33.1%-->
        <!--            </span>-->
        <!--            <span class="text-muted">Since last month</span>-->
        <!--          </p>-->
        <!--        </div>-->
                <!-- /.d-flex -->

        <!--        <div class="position-relative mb-4">-->
        <!--          <canvas id="sales-chart" height="200"></canvas>-->
        <!--        </div>-->

        <!--        <div class="d-flex flex-row justify-content-end">-->
        <!--          <span class="mr-2">-->
        <!--            <i class="fas fa-square text-primary"></i> This year-->
        <!--          </span>-->

        <!--          <span>-->
        <!--            <i class="fas fa-square text-gray"></i> Last year-->
        <!--          </span>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--    </div>-->
            <!-- /.card -->

        <!--    <div class="card">-->
        <!--      <div class="card-header border-0">-->
        <!--        <h3 class="card-title">Online Store Overview</h3>-->
        <!--        <div class="card-tools">-->
        <!--          <a href="#" class="btn btn-sm btn-tool">-->
        <!--            <i class="fas fa-download"></i>-->
        <!--          </a>-->
        <!--          <a href="#" class="btn btn-sm btn-tool">-->
        <!--            <i class="fas fa-bars"></i>-->
        <!--          </a>-->
        <!--        </div>-->
        <!--      </div>-->
        <!--      <div class="card-body">-->
        <!--        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
        <!--          <p class="text-success text-xl">-->
        <!--            <i class="ion ion-ios-refresh-empty"></i>-->
        <!--          </p>-->
        <!--          <p class="d-flex flex-column text-right">-->
        <!--            <span class="font-weight-bold">-->
        <!--              <i class="ion ion-android-arrow-up text-success"></i> 12%-->
        <!--            </span>-->
        <!--            <span class="text-muted">CONVERSION RATE</span>-->
        <!--          </p>-->
        <!--        </div>-->
                <!-- /.d-flex -->
        <!--        <div class="d-flex justify-content-between align-items-center border-bottom mb-3">-->
        <!--          <p class="text-warning text-xl">-->
        <!--            <i class="ion ion-ios-cart-outline"></i>-->
        <!--          </p>-->
        <!--          <p class="d-flex flex-column text-right">-->
        <!--            <span class="font-weight-bold">-->
        <!--              <i class="ion ion-android-arrow-up text-warning"></i> 0.8%-->
        <!--            </span>-->
        <!--            <span class="text-muted">SALES RATE</span>-->
        <!--          </p>-->
        <!--        </div>-->
                <!-- /.d-flex -->
        <!--        <div class="d-flex justify-content-between align-items-center mb-0">-->
        <!--          <p class="text-danger text-xl">-->
        <!--            <i class="ion ion-ios-people-outline"></i>-->
        <!--          </p>-->
        <!--          <p class="d-flex flex-column text-right">-->
        <!--            <span class="font-weight-bold">-->
        <!--              <i class="ion ion-android-arrow-down text-danger"></i> 1%-->
        <!--            </span>-->
        <!--            <span class="text-muted">REGISTRATION RATE</span>-->
        <!--          </p>-->
        <!--        </div>-->
                <!-- /.d-flex -->
        <!--      </div>-->
        <!--    </div>-->
        <!--  </div>-->
          <!-- /.col-md-6 -->
        <!--</div>-->
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard3.js"></script>
<script>
$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true
    var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Jan', 'Feb', 'Mar ', 'Ap', 'May', 'June ', 'July', 'Aug ', 'Sept', 'Octo', 'Nov', 'Dec'],
      datasets: [{
        type: 'line',
        data: [200, 120, 170, 167, 180, 177, 800],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
      }
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})
</script>