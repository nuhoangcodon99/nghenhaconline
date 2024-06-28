<?php
require_once $_SERVER['DOCUMENT_ROOT']."/system/core.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/system/function.php';
$id = xss($_POST['id']);
$title = xss($_POST['title']);
$description = xss($_POST['description']);
$slug = create_slug($title);
if (empty($title) || empty($description) || empty($slug) ) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Vui lòng nhập đủ thông tin')));
}
if (strlen($title) < 6) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Tiêu Đề Quá Ngắn')));
}
if (strlen($description) < 6) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Nội Dung quá ngắn')));
}
if ($ACAIVIPPRO->get_row("SELECT * FROM `posts` WHERE `slug`='$slug'")) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Vui lòng thay đổi tiêu đề không được lặp lại')));
}
$create = $ACAIVIPPRO->update("category", [
    'title'       => $title,
    'slug'      => $slug,
    'description'  => $description,
    'time_update'    => gettime()
    ], " `id` = '" . $id . "' ");
    

if ($create) {
    exit(json_encode(array('title'=>'Thành công','status'=>'success','msg' => 'Tạo Thể Loại thành công')));
} else {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Đã xảy ra lỗi gì đó, vui lòng liên hệ admin để xử lý')));
}
