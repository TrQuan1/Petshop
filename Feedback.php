<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Gửi góp ý</title>
    <link rel="stylesheet" href="Feedback.css">
</head>
<body>

    <div class="container">
        <h2>Gửi góp ý đến cửa hàng</h2>

        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo "<p style='color: green; text-align: center;'>🎉 Cảm ơn bạn đã gửi góp ý!</p>";
        }
        ?>

        <form action="submit_feedback.php" method="post">
            <label>Họ tên:</label><br>
            <input type="text" name="name" required><br><br>

            <label>Email:</label><br>
            <input type="email" name="email" required><br><br>

            <label>Nội dung góp ý:</label><br>
            <textarea name="message" rows="5" required></textarea><br><br>

            <input type="submit" value="Gửi góp ý">
        </form>
    </div>

</body>
</html>
