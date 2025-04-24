<?php
$conn = new mysqli("localhost", "root", "", "petshop_db");

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM feedback ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý góp ý</title>
    <link rel="stylesheet" href="admin_feedback.css">
</head>
<body>
    <div class="container">
        <h2>Danh sách góp ý từ khách hàng</h2>

        <?php while($row = $result->fetch_assoc()): ?>
            <div class="feedback-box">
                <strong><?= htmlspecialchars($row['name']) ?></strong> (<?= htmlspecialchars($row['email']) ?>)
                <br>
                <small>Gửi lúc: <?= htmlspecialchars($row['created_at']) ?></small>
                <p><?= nl2br(htmlspecialchars($row['message'])) ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>

<?php $conn->close(); ?>
