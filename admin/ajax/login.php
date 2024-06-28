<?php
require_once $_SERVER['DOCUMENT_ROOT']."/system/core.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/system/function.php';

$username = xss($_POST['username']);
$password = xss($_POST['password']);
if (empty($username) || empty($password)) {
    exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Bạn chưa nhập tài khoản hoặc mật khẩu')));
}
if (!$row = $ACAIVIPPRO->get_row("SELECT * FROM `users` WHERE `username`='" . $username . "' AND `password`='" .md5($password) . "'")) {
    exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản hoặc mật khẩu không chính xác')));
}
// if ($row['isBaned'] == 1) {
//     exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Tài khoản đã bị khóa')));
// }
$_SESSION['username'] = $username;
exit(json_encode(array('title' => 'Thành công', 'status' => 'success', 'msg' => 'Đăng nhập thành công', 'redirect' => '/admin')));
