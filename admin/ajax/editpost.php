<?php
require_once $_SERVER['DOCUMENT_ROOT']."/system/core.php";
require_once $_SERVER['DOCUMENT_ROOT'].'/system/function.php';
$id = xss($_POST['id']);
$title = xss($_POST['title']);
$description = xss($_POST['description']);
$images = urldecode($_POST['images']);
$tags = xss($_POST['tag']);
$mp3 = urldecode($_POST['mp3']);
$category = xss($_POST['category']);
$casi = xss($_POST['casi']);
$dodai = xss($_POST['dai']);
$slug = create_slug($title);
if (empty($title) || empty($description) || empty($images) || empty($tags) || empty($mp3) || empty($category) || empty($casi) || empty($dodai) ) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Vui lòng nhập đủ thông tin')));
}
if (strlen($title) < 6) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Tiêu Đề Quá Ngắn')));
}
$url_img = curl_get(Setting('server_img')."/anh/images.php?img=$images&name=$slug");
if (!$url_img) {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Lưu ảnh thất bại vui lòng thử lại')));
}

// Sử dụng cURL để tải file mp3 từ URL và lưu vào thư mục
$mp3_destination = $_SERVER['DOCUMENT_ROOT']."/mp3/".$slug.".mp3"; // Thay đổi đường dẫn thư mục lưu mp3 tại đây
$ch = curl_init($mp3);
$fp = fopen($mp3_destination, 'w');
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
$result = curl_exec($ch);
curl_close($ch);
fclose($fp);

if ($result === false) {
    exit(json_encode(array('title' => 'Thất bại', 'status' => 'error', 'msg' => 'Lưu file thất bại vui lòng thử lại')));
}

$create = $ACAIVIPPRO->update("posts", [
    'title'       => $title,
    'description'  => $description,
    'images'        => Setting('server_img')."/uploads/".$slug.".png",
    'slug'        => $slug,
    'mp3'        => Setting('server_img') . "/mp3/" . $slug . ".mp3",
    'category'        => $category,
    'tags'        => $tags,
    'casi'        => $casi,
    'dodai'        => $dodai,
    'category' => $category,
    'time_update'    => gettime()
    ], " `id` = '" . $id . "' ");
    
if ($create) {
    exit(json_encode(array('title'=>'Thành công','status'=>'success','msg' => 'Sửa bài viết thành công')));
} else {
    exit(json_encode(array('title'=>'Thất bại','status'=>'error','msg' => 'Đã xảy ra lỗi gì đó, vui lòng liên hệ admin để xử lý')));
}
?>
