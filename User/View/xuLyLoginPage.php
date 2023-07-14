<?php
session_start();
require_once "../../Core/Conecting.php";

// Lấy dữ liệu từ biểu mẫu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Truy vấn cơ sở dữ liệu để kiểm tra đăng nhập
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username AND password = :password");
    $stmt->execute(array(':username' => $username, ':password' => $password));

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $_SESSION['username'] = $row['username'];
        $_SESSION['role'] = $row['role'];
        $_SESSION['user_id'] = $row['user_id']; // Thêm dòng này để lưu user_id vào session
        
        // Kiểm tra vai trò của người dùng và điều hướng tới các trang phù hợp
        if ($_SESSION['role'] == 'admin') {
            header('location: ../../Admin/index.php');
            exit();
        } else if ($_SESSION['role'] == 'customer') {
            header('location: user.php');
            exit();
        }
    } else {
        // Sai tên đăng nhập hoặc mật khẩu
        header('location: sign_login.php');
        exit();
    }
    
}
