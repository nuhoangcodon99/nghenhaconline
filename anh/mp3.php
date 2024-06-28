<?php
$url =  $_GET['url'];
$get_name = $_GET['name'];
$destination = $_SERVER['DOCUMENT_ROOT']."/mp3/".$get_name.".mp3";
// Sử dụng cURL để tải file từ URL
$result = file_put_contents($destination, file_get_contents($url));
if ($result === false) {
    http_response_code(500);
} else {
    echo "File nhạc đã được lưu.";
}
?>
