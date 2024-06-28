<?php
$get = !empty($_GET['id']) ? xss($_GET['id']) : '';

if (!$ACAIVIPPRO->get_row("SELECT * FROM `posts` WHERE `id`='$get'")) {
  header("location: home.html");
  die();
}
$row = $ACAIVIPPRO->get_row("SELECT * FROM `posts` WHERE `id`='$get'");
?>

<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Sửa bài viết</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Sửa bài viết</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- jquery validation -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Sửa bài viết #<?= $get; ?></h3>
            </div>
            <!-- form start -->
            <form id="editpost_acaivippro" method="post">
              <div class="card-body">
                <div class="form-group">
                  <label>Tên Bài Hát</label>
                  <input type="text" name="title" class="form-control" id="title" placeholder="Tên Bài Hát" value="<?= $row['title']; ?>">
                  <input type="hidden" name="id" class="form-control" id="id" value="<?= $row['id']; ?>">
                </div>
                <div class="form-group">
                  <label>Ca sĩ</label>
                  <input type="text" name="casi" class="form-control" id="casi" placeholder="Ca sĩ" value="<?= $row['casi']; ?>">
                </div>
                <div class="form-group">
                  <label>Mô Tả</label>
                  <input type="text" name="description" class="form-control" id="description" placeholder="Mô tả bài viết" value="<?= $row['description']; ?>">
                </div>
                <div class="form-group">
                  <label>Ảnh Đại Diện</label>
                  <input type="text" name="images" class="form-control" id="images" placeholder="Ảnh Đại Diện" value="<?= $row['images']; ?>">
                </div>
                <div class="form-group">
                  <label>Link mp3</label>
                  <input type="text" name="mp3" class="form-control" id="mp3" placeholder="Link mp3" value="<?= $row['mp3']; ?>">
                </div>
                <div class="form-group">
                  <label>Chuyên Mục Chính</label>
                  <select class="form-control select2" name="category" style="width: 100%">
                    <?php
                    $selectedCategory = $row['category']; // Giá trị đã chọn
                    foreach ($ACAIVIPPRO->get_list("SELECT * FROM `category` WHERE `hidden`='0' ORDER BY `id` DESC") as $cate) :
                      $value = $cate['id'];
                      $title = $cate['title'];

                      $selected = ($value == $selectedCategory) ? 'selected' : ''; // Kiểm tra xem giá trị của tùy chọn có bằng giá trị đã chọn hay không.

                      echo "<option value=\"$value\" $selected>$title</option>";
                    endforeach;
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>Độ dài</label>
                  <input type="text" name="dai" class="form-control" id="dai" value="<?= $row['dodai']; ?>" placeholder="Độ dài">
                </div>

                <div class="form-group">
                  <label>Tag bài viết</label>
                  <input type="text" name="tag" class="form-control" id="tag" placeholder="Tag bài viết cách nhau bởi dấu ," value="<?= $row['tags']; ?>">
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" id="editpost_submit" class="btn btn-primary">Submit</button>
                </div>
            </form>
          </div>
          <!-- /.card -->
        </div>
        <!--/.col (left) -->
        <!-- right column -->
        <div class="col-md-6">

        </div>
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- date-range-picker -->
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- bootstrap color picker -->
<script src="plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Bootstrap Switch -->
<script src="plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>
<!-- BS-Stepper -->
<script src="plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- dropzonejs -->
<script src="plugins/dropzone/min/dropzone.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="js/acaivippro.js"></script>
<!-- Toastr -->
<link rel="stylesheet" href="plugins/toastr/toastr.min.css">
<!-- Page specific script -->
<!-- Toastr -->
<script src="plugins/toastr/toastr.min.js"></script>
<script>
  $(function() {
    //Initialize Select2 Elements
    $('.select2').select2();
    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    //Datemask dd/mm/yyyy
    $('#datemask').inputmask('dd/mm/yyyy', {
      'placeholder': 'dd/mm/yyyy'
    })
    //Datemask2 mm/dd/yyyy
    $('#datemask2').inputmask('mm/dd/yyyy', {
      'placeholder': 'mm/dd/yyyy'
    })
    //Money Euro
    $('[data-mask]').inputmask()
  })
</script>