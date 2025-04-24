<?php
// Kết nối đến cơ sở dữ liệu
$conn = new mysqli("localhost", "root", "", "petshop_db");
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xử lý khi submit form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST["name"]);
    $price = (float)$_POST["price"];
    $description = $conn->real_escape_string($_POST["description"]);

    // Xử lý ảnh
    $image = $_FILES["image"]["name"];
    $target_dir = "/home/nghiem/Petshop/images/";
    $target_file = $target_dir . basename($image);

    // Kiểm tra nếu ảnh hợp lệ
    if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        $sql = "INSERT INTO products (name, price, description, image)
                VALUES ('$name', $price, '$description', '$image')";

        if ($conn->query($sql) === TRUE) {
            echo "<p style='color: green;'>Thêm sản phẩm thành công!</p>";
            echo "<p><a href='index.php'>← Quay lại trang chủ</a></p>";
        } else {
            echo "Lỗi: " . $conn->error;
        }
    } else {
        echo "<p style='color: red;'>Lỗi khi tải ảnh lên. Vui lòng thử lại!</p>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <main style="max-width: 600px; margin: 50px auto;">
        <h2>Thêm Sản Phẩm Mới</h2>
        <form method="post" action="" enctype="multipart/form-data">

            <label for="name">Tên sản phẩm:</label><br>
            <input type="text" name="name" id="name" required><br><br>

            <label for="price">Giá (VND):</label><br>
            <input type="number" name="price" id="price" step="1000" required><br><br>

            <label for="description">Mô tả:</label><br>
            <textarea name="description" id="description" rows="4" required></textarea><br><br>

            <label for="image">Ảnh sản phẩm:</label><br>
            <input type="file" name="image" id="image" accept="image/*" required><br><br>

            <button type="submit">Thêm sản phẩm</button>
        </form>
    </main>
</body>
</html>
