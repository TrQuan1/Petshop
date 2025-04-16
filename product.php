<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi Tiết Sản Phẩm</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Cửa Hàng Phụ Kiện Thú Cưng</h1>
        <nav>
            <a href="index.php">Trang Chủ</a>
            <a href="cart.php">Giỏ Hàng</a>
        </nav>
    </header>
    <main>
        <h2>Chi Tiết Sản Phẩm</h2>
        <?php
        // Kết nối MySQL
        $conn = new mysqli("localhost", "root", "", "petshop_db");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Lấy ID sản phẩm từ URL
        $product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
        $result = $conn->query("SELECT * FROM products WHERE id = $product_id");
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo "<div class='product-detail'>";
            echo "<img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'>";
            echo "<h3>" . $row['name'] . "</h3>";
            echo "<p>Giá: " . number_format($row['price'], 0, ',', '.') . " VND</p>";
            echo "<p>" . $row['description'] . "</p>";
            echo "<form action='cart.php' method='post'>";
            echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
            echo "<button type='submit' name='add_to_cart'>Thêm vào giỏ</button>";
            echo "</form>";
            echo "</div>";
        } else {
            echo "<p>Sản phẩm không tồn tại!</p>";
        }
        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2025 Cửa Hàng Phụ Kiện Thú Cưng</p>
    </footer>
</body>
</html>
