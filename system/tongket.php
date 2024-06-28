<?php
$filePath = "luot_xem_thang.json";

// Kiểm tra xem tệp JSON đã tồn tại hay không
if (file_exists($filePath)) {
    // Đọc dữ liệu từ tệp JSON và chuyển nó thành mảng
    $jsonData = file_get_contents($filePath);
    $data = json_decode($jsonData, true);

    if ($data === null) {
        // Đảm bảo rằng $data là mảng và không phải là null
        $data = array();
    }
} else {
    // Tệp JSON chưa tồn tại, tạo một mảng trống
    $data = array();
}

// Dữ liệu mới cần được thêm vào mảng $data
$newData = array(
    "tháng 1" => 5555,
    // Thêm dữ liệu của các tháng khác ở đây
);

// Thêm dữ liệu mới vào mảng $data
$data = array_merge($data, $newData);

// Chuyển mảng $data thành chuỗi JSON
$jsonData = json_encode($data);

// Ghi dữ liệu JSON mới vào tệp
if (file_put_contents($filePath, $jsonData)) {
    echo "Dữ liệu đã được thêm vào hoặc tạo mới trong tệp JSON.";
} else {
    echo "Có lỗi xảy ra khi cố gắng thêm dữ liệu.";
}
?>
