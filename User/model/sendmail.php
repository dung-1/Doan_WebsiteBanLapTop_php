<?php
session_start();


include "../../Core/Conecting.php";
$pdo = get_pdo();

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $full_name = $_POST['full_name'];

    if (check_username_exist($username)) {
        // Username đã tồn tại, thông báo cho người dùng
        header('Location: ../../Admin/view/inc/error_insert.php');
        exit;
    }

    // Lưu thông tin khách hàng trong session
    $_SESSION['customer'] = [
        'username' => $username,
        'password' => $password,
        'email' => $email,
        'phone' => $phone,
        'full_name' => $full_name
    ];

    // Gửi email với mã xác nhận
    send_confirmation_email($email);

    // Chuyển hướng người dùng đến trang nhập mã xác nhận
    header('Location: ../View/check_mail_vaildate.php');
    exit;
}

function check_username_exist($username)
{
    global $pdo;

    $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    return $count > 0; // Trả về true nếu username đã tồn tại, ngược lại trả về false
}

function send_confirmation_email($email)
{
    $mail = new PHPMailer(true);

    try {
        // Cấu hình gửi email
        $mail->isSMTP();
        $mail->SMTPDebug = SMTP::DEBUG_OFF;
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Host = 'smtp.gmail.com';
        $mail->Port = 587;
        $mail->Username = 'nguyenvandung01052002@gmail.com'; // Địa chỉ email của bạn
        $mail->Password = 'ifbmyzwazpeudker';

        // Thiết lập thông tin người gửi và người nhận
        $mail->setFrom('nguyenvandung01052002@gmail.com'); // Địa chỉ email của bạn
        $mail->addAddress($email); // Địa chỉ email người nhận

        // Thiết lập tiêu đề và nội dung email
        $mail->Subject = 'Xác nhận tài khoản';
        $randomCode = generateRandomCode(6); // Tạo mã xác nhận gồm 6 ký tự
        $_SESSION['confirmation_code'] = $randomCode; // Lưu mã xác nhận trong session
        $mail->Body = 'Mã xác nhận của bạn là: ' . $randomCode;

        // Gửi email
        if (!$mail->send()) {
            throw new Exception('Không thể gửi email xác nhận.');
        }
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
}

function generateRandomCode($length)
{
    $characters = '0123456789';
    $randomCode = '';
    $max = strlen($characters) - 1;

    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[random_int(0, $max)];
    }

    return $randomCode;
}
?>
