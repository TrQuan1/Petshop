<?php
session_start();

// Khởi tạo giỏ hàng nếu chưa tồn tại
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST['add_to_cart'])) {
    $product_id = (int)$_POST['product_id'];
    if (!in_array($product_id, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $product_id;
    }
    // Chuyển hướng để tránh gửi lại yêu cầu POST
    header("Location: cart.php");
    exit();
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_POST['remove_from_cart'])) {
    $product_id = (int)$_POST['remove_id'];
    // Xóa tất cả các ID sản phẩm trùng với ID cần xóa
    $_SESSION['cart'] = array_values(array_diff($_SESSION['cart'], [$product_id]));
    // Chuyển hướng để tránh gửi lại yêu cầu POST
    header("Location: cart.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ Hàng</title>
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
        <h2>Giỏ Hàng</h2>
        <?php
        $conn = new mysqli("localhost", "root", "", "petshop_db");
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        if (empty($_SESSION['cart'])) {
            echo "<p>Giỏ hàng trống!</p>";
        } else {
            // Tính số lượng và tổng giá cho từng sản phẩm
            $cart_items = array_count_values($_SESSION['cart']);
            $total_price = 0;

            echo "<table>";
            echo "<tr><th>Sản Phẩm</th><th>Số Lượng</th><th>Giá</th><th>Tổng</th><th>Thao Tác</th></tr>";

            foreach ($cart_items as $id => $quantity) {
                $result = $conn->query("SELECT * FROM products WHERE id = $id");
                if ($result->num_rows > 0) {
                    $row = $result->fetch_assoc();
                    $item_total = $row['price'] * $quantity;
                    $total_price += $item_total;

                    echo "<tr>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $quantity . "</td>";
                    echo "<td>" . number_format($row['price'], 0, ',', '.') . " VND</td>";
                    echo "<td>" . number_format($item_total, 0, ',', '.') . " VND</td>";
                    echo "<td>";
                    echo "<form action='cart.php' method='post'>";
                    echo "<input type='hidden' name='remove_id' value='" . $row['id'] . "'>";
                    echo "<button type='submit' name='remove_from_cart'>Xóa</button>";
                    echo "</form>";
echo "</td>";
                    echo "</tr>";
                }
            }

            echo "<tr><td colspan='3'><strong>Tổng Cộng</strong></td><td><strong>" . number_format($total_price, 0, ',', '.') . " VND</strong></td><td></td></tr>";
            echo "</table>";
        }

        $conn->close();
        ?>
    </main>
    <footer>
        <p>© 2025 Cửa Hàng Phụ Kiện Thú Cưng</p>
    </footer>
</body>
</html>
