<?php
$get_img = $_GET['img'];
$get_name = $_GET['name'];
// URL của ảnh bạn muốn tải về
$image_url = $get_img;

// Thư mục trên máy chủ nơi bạn muốn lưu ảnh
$target_directory = $_SERVER['DOCUMENT_ROOT']."/uploads/";

// Tên tệp lưu trữ ảnh trên máy chủ
$target_filename = $get_name.".png";

// Đường dẫn đầy đủ tới tệp trên máy chủ
$target_path = $target_directory . $target_filename;

// Kiểm tra xem tệp đã tồn tại trên máy chủ hay chưa
    // Tải ảnh từ URL
    $image_data = file_get_contents($image_url);

    if ($image_data !== false) {
        // Lưu ảnh vào máy chủ
        if (file_put_contents($target_path, $image_data) !== false) {
            echo "200";
        } else {
            // Lỗi khi lưu ảnh vào máy chủ
            echo "-1";
        }
    } else {
        // Lỗi khi tải ảnh từ URL
        http_response_code(500); // Thiết lập mã lỗi 500 (Internal Server Error)
        echo "Không thể tải ảnh từ URL.";
    }
?>