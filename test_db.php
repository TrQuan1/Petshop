<?php
// Bật hiển thị lỗi toàn cục
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Kết nối CSDL
$conn = new mysqli("localhost", "root", "", "petshop");

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("❌ Kết nối thất bại: " . $conn->connect_error);
} else {
    echo "✅ Kết nối thành công đến CSDL petshop!";
}

$conn->close();
?>
