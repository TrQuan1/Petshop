<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Phụ Kiện Thú Cưng</title>
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
        <h2>Danh Sách Sản Phẩm</h2>
        <div class="products">
            <?php
            $conn = new mysqli("localhost", "root", "", "petshop_db");
            if ($conn->connect_error) {
                die("Kết nối thất bại: " . $conn->connect_error);
            }
            $result = $conn->query("SELECT * FROM products");
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='product'>";
                    echo "<a href='product.php?id=" . $row['id'] . "'><img src='images/" . $row['image'] . "' alt='" . $row['name'] . "'></a>";
                    echo "<h3><a href='product.php?id=" . $row['id'] . "'>" . $row['name'] . "</a></h3>";
                    echo "<p>Giá: " . number_format($row['price'], 0, ',', '.') . " VND</p>";
                    echo "<form action='cart.php' method='post'>";
                    echo "<input type='hidden' name='product_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='add_to_cart'>Thêm vào giỏ</button>";
                    echo "</form>";
                    echo "</div>";
                }
            } else {
                echo "<p>Chưa có sản phẩm nào!</p>";
            }
            $conn->close();
            ?>
        </div>
    </main>
    <footer>
        <p>© 2025 Cửa Hàng Phụ Kiện Thú Cưng</p>
    </footer>
</body>
</html>
