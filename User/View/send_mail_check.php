<?php
session_start();
include "../../Core/Conecting.php";
$pdo = get_pdo();
// Kiểm tra xem mã xác nhận có được nhập hay không
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirmation_code'])) {
        $confirmationCode = $_POST['confirmation_code'];

        // Kiểm tra mã xác nhận nhập vào
        if ($confirmationCode === $_SESSION['confirmation_code']) {
            // Mã xác nhận đúng, lưu thông tin khách hàng vào cơ sở dữ liệu
            save_customer_info();
            unset($_SESSION['confirmation_code']); // Xóa mã xác nhận khỏi session
            echo "<script>alert('Bạn đã đăng ký tài khoản thành công !!!); window.location.href='../view/loginPage.php';</script>";
            exit;
        } else {
            // Mã xác nhận sai, hiển thị thông báo lỗi và chuyển hướng người dùng về trang nhập lại
            echo "<script>alert('Mã xác nhận không đúng. Vui lòng thử lại.'); window.location.href='../view/check_mail_vaildate.php';</script>";
            exit;
        }        
    }
}

// Hàm để lưu thông tin khách hàng vào cơ sở dữ liệu
function save_customer_info()
{
    global $pdo;
    
    // Lấy thông tin khách hàng từ session
    $customer = $_SESSION['customer'];
    $username = $customer['username'];
    $password = $customer['password'];
    $email = $customer['email'];
    $phone = $customer['phone'];
    $full_name = $customer['full_name'];

    // Thực hiện truy vấn để lưu thông tin khách hàng vào cơ sở dữ liệu
    $sql = "INSERT INTO users (username, password, email, phone, full_name, role) VALUES (:username, :password, :email, :phone, :full_name, 'customer')";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':phone', $phone);
    $stmt->bindParam(':full_name', $full_name);
    
    try {
        $stmt->execute();
        
        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi lưu thông tin khách hàng.');
        }
        
        // Xóa thông tin khách hàng khỏi session
        unset($_SESSION['customer']);
    } catch (Exception $e) {
        header('Location: ../../Admin/view/inc/error_insert.php');
        exit;
    }
}
?>
