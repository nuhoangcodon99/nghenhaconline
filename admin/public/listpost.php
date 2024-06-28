<?php
if(isset($_REQUEST['delete']) and $_REQUEST['delete']!=""){
$delete= xss($_GET['delete']);
$jquer = $ACAIVIPPRO->remove("posts","`id` = '$delete'");
if($jquer){
    echo " <script> 
      Toast.fire({
        icon: 'success',
        title: 'Xóa bài Viết Thành Công.'
      });</script>";
}else{
    echo " <script> 
      Toast.fire({
        icon: 'error',
        title: 'Xóa bài Viết thất bại.'
      });</script>";
}
}
?>
<!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Danh Sách Bài Viết</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Danh Sách Bài Viết</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh Sách Bài Viết</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Tiêu Đề</th>
                    <th>Ảnh bài</th>
                    <th>Chuyên Mục</th>
                    <th>Xem Tháng</th>
                    <th>Xem Tổng</th>
                    <th>Ẩn/Hiện</th>
                    <th>Thời Gian</th>
                    <th>Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                       <?php foreach ($ACAIVIPPRO->get_list("SELECT * FROM `posts` ORDER BY `id` DESC ") as $row) : ?>
                  <tr>
                    <td><?=$row['id'];?></td>
                    <td><?=$row['title'];?></td>
                    <td><img src="<?=$row['images'];?>" width="70px"></td>
                    <td><button type="button" class="btn btn-block btn-danger btn-sm"><?=categoy_name($row['category']);?></button></td>
                    <td><button type="button" class="btn btn-block btn-default btn-sm"><?=formatViews($row['view_month']);?></button></td>
                    <td><button type="button" class="btn btn-block btn-default btn-sm"><?=formatViews($row['view']);?></button></td>
                    <td><button type="button" class="btn btn-block btn-default btn-sm"><?=hidden($row['hidden']);?></button></td>
                    <td><button type="button" class="btn btn-block btn-warning btn-xs"><?=$row['time'];?></button></td>
                     <td><div class="btn-group">
                    <button type="button" class="btn btn-info">Thao Tác</button>
                    <button type="button" class="btn btn-info dropdown-toggle dropdown-icon" data-toggle="dropdown" aria-expanded="false">
                      <span class="sr-only"></span>
                    </button>
                    <div class="dropdown-menu" role="menu" style="">
                      <a class="dropdown-item" href="?action=editpost&id=<?=$row['id'];?>">Chỉnh Sửa</a>
                      <a class="dropdown-item" href="#"></a>
                      <div class="dropdown-divider"></div>
                      <a class="dropdown-item" href="?action=listpost&delete=<?=$row['id'];?>" onclick="return checkDelete()">Xóa bài</a>
                    </div>
                  </div></td>
                  </tr>
                  <?php endforeach; ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<!-- Toastr -->
 <link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<script src="plugins/toastr/toastr.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Bạn có chắc muốn xóa bài viết này ?');
}
</script>
