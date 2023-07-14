<?php
session_start();

// Kiểm tra xem người dùng đã gửi yêu cầu kiểm tra hay chưa
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy mật khẩu ngẫu nhiên đã lưu trữ trong phiên làm việc
    $randomPassword = $_SESSION['randomPassword'];

    // Kiểm tra xem người dùng đã nhập mật khẩu đúng hay chưa
    if ($_POST['password'] === $randomPassword) {
        // Mật khẩu đúng
        echo "Mật khẩu chính xác.";
    } else {
        // Mật khẩu sai
        echo "Mật khẩu không chính xác.";
    }
}
?> 

<!-- Biểu mẫu HTML để người dùng nhập mật khẩu -->
<form method="POST" action="kiemtra.php">
    <input type="text" name="password" placeholder="Nhập mật khẩu">
    <button type="submit">Kiểm tra</button>
</form>
