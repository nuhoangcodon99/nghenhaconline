<?php
require_once $_SERVER['DOCUMENT_ROOT']."/system/core.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/system/function.php';

$id = xss($_POST['id']);
$title = xss($_POST['title']);
$description = xss($_POST['description']);
$home_url = urldecode($_POST['home_url']);
$domain = urldecode($_POST['domain']);
$logo = urldecode($_POST['logo']);
$images = urldecode($_POST['images']);
$server_img = urldecode($_POST['server_img']);
$server_play = urldecode($_POST['server_play']);
$tele = $_POST['tele'];
$script = $_POST['script'];


if (empty($title) || empty($description)) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Vui lòng nhập đủ thông tin')));
}
if (strlen($title) < 6) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Tiêu Đề Quá Ngắn')));
}
if (strlen($description) < 6) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Nội Dung quá ngắn')));
}

$create = $ACAIVIPPRO->update("setting", [
    'title'       => $title,
    'description'  => $description,
    'home_url'  => $home_url,
    'domain'  => $domain,
    'logo'  => $logo,
    'images'  => $images,
    'tele'  => $tele,
    'server_img' => $server_img,
    'server_play' => $server_play,
    'script'  => $script
    ], " `id` = '" . $id . "' ");
    

if ($create) {
    exit(json_encode(array('title'=>'Thành công','status'=>'success','msg' => 'Sửa setting thành công')));
} else {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Đã xảy ra lỗi gì đó, vui lòng liên hệ admin để xử lý')));
}
