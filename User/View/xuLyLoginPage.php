<?php
session_start();
require_once "../../Core/Conecting.php";

// Lấy dữ liệu từ biểu mẫu đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra sự tồn tại của tài khoản trong cơ sở dữ liệu
    $pdo = get_pdo();
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(array(':username' => $username));

    if ($stmt->rowCount() > 0) {
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $storedPassword = $row['password'];

        // Kiểm tra mật khẩu
        if ($password == $storedPassword) {
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
            $_SESSION['error'] = 'Mật khẩu không đúng!';
            header('location: loginPage.php');
            exit();
        }  } else {

            $_SESSION['error'] = 'Tài khoản không tồn tại!';
            header('location: loginPage.php');
            exit();
        }
    }
