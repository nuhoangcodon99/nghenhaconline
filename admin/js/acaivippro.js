$(document).ready(function () {
    $('#login_acaivippro').on("submit", function (e) {
        $("#login_submit").attr("disabled", true);
        $('#login_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/login.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                        if (data.redirect) window.location = data.redirect;
                        else window.location.reload();
                } else {
                    toastr.error(data.msg);
                }
                $('#login_submit').html('Login');
                $('#login_submit').removeAttr("disabled");
            }
        });
    });
});
$(document).ready(function () {
    $('#newpost_acaivippro').on("submit", function (e) {
        $("#newpost_submit").attr("disabled", true);
        $('#newpost_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/newpost.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    setTimeout(function() { window.location.reload();}, 4000);
                } else {
                    toastr.error(data.msg);
                }
                $('#newpost_submit').html('Đăng Bài');
                $('#newpost_submit').removeAttr("disabled");
            }
        });
    });
});

$(document).ready(function () {
    $('#editpost_acaivippro').on("submit", function (e) {
        $("#editpost_submit").attr("disabled", true);
        $('#editpost_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/editpost.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    setTimeout(function() { window.location.reload();}, 4000);
                } else {
                    toastr.error(data.msg);
                }
                $('#editpost_submit').html('Sửa bài viết');
                $('#editpost_submit').removeAttr("disabled");
            }
        });
    });
});



$(document).ready(function () {
    $('#newcate_acaivippro').on("submit", function (e) {
        $("#newcate_submit").attr("disabled", true);
        $('#newcate_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/newcategory.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    setTimeout(function() { window.location.reload();}, 4000);
                } else {
                    toastr.error(data.msg);
                }
                $('#newcate_submit').html('Tạo Ngay');
                $('#newcate_submit').removeAttr("disabled");
            }
        });
    });
});

$(document).ready(function () {
    $('#editcategory_acaivippro').on("submit", function (e) {
        $("#editcategory_submit").attr("disabled", true);
        $('#editcategory_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/editcategory.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    setTimeout(function() { window.location.reload();}, 4000);
                } else {
                    toastr.error(data.msg);
                }
                $('#editcategory_submit').html('Sửa thể loại');
                $('#editcategory_submit').removeAttr("disabled");
            }
        });
    });
});


$(document).ready(function () {
    $('#setting_acaivippro').on("submit", function (e) {
        $("#setting_submit").attr("disabled", true);
        $('#setting_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/setting.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    setTimeout(function() { window.location.reload();}, 4000);
                } else {
                    toastr.error(data.msg);
                }
                $('#setting_submit').html('Sửa thể loại');
                $('#setting_submit').removeAttr("disabled");
            }
        });
    });
});

$(document).ready(function () {
    $('#xvideos_acaivippro').on("submit", function (e) {
        $("#xvideos_submit").attr("disabled", true);
        $('#xvideos_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/tools/xvideos.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    $('#images').val(data.images);
                    $('#xvideos').val(data.url_video);
                } else {
                    toastr.error(data.msg);
                }
                    $('#xvideos_submit').html('Leech bài');
                    $('#xvideos_submit').removeAttr("disabled");
            }
        });
    });
});


$(document).ready(function () {
    $('#leechauto_acaivippro').on("submit", function (e) {
        $("#leechauto_submit").attr("disabled", true);
        $('#leechauto_submit').html('<i class="fa fa-refresh fa-spin"></i> Loading...');
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "/admin/ajax/tools/leechauto.php",
            type: "POST",
            dataType: "JSON",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data.status == 'success') {
                   toastr.success(data.msg);
                    $('#title').val(data.title);
                    $('#description').val("Phim sex Việt nam "+data.title);
                    $('#content').val("Phim sex Việt nam "+data.title+" cực hay");
                    $('#images').val(data.images);
                    $('#xvideos').val(data.url_video);
                    $('#tag').val("phim sex vn, sex việt nam, gái xinh, xvideos vn, việt nam, sex mới, sex teen");
                } else {
                    toastr.error(data.msg);
                }
                    $('#leechauto_submit').html('Leech bài');
                    $('#leechauto_submit').removeAttr("disabled");
            }
        });
    });
});