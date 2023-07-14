<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

// Hàm để tạo chuỗi ngẫu nhiên
function generateRandomPassword($length)
{
    $characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    $randomString = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $max)];
    }

    return $randomString;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mail = new PHPMailer(true);

    try {
        // Cấu hình gửi email
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'nguyenvandung01052002@gmail.com';
        $mail->Password = 'ifbmyzwazpeudker';

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom('nguyenvandung01052002@gmail.com');
        $mail->addAddress($_POST['mail']);

        // Thiết lập tiêu đề và nội dung email
        $mail->Subject = 'Cửa Hàng LAPTOPAZ.VN';
        // Tạo mật khẩu mới ngẫu nhiên
        $newPassword = generateRandomPassword(6); // Tạo mật khẩu gồm 6 ký tự

        // Gán nội dung email với mật khẩu mới
        $mail->Body = 'Mật khẩu mới của bạn là: ' . $newPassword;

        // Gửi email
        $mail->send();

        // Lưu trữ mật khẩu ngẫu nhiên trong phiên làm việc
        session_start();
        $_SESSION['randomPassword'] = $newPassword;

        // Chuyển hướng người dùng đến trang kiểm tra mật khẩu
        header('Location: ../View/check_mail_vaildate.php');
        exit();
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}
