<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

$sendMailSuccess = false;

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
        $mail->addAddress($_POST['email']);
    
        // Thiết lập tiêu đề email
        $subject = '=?UTF-8?B?' . base64_encode('Hóa đơn mua hàng') . '?=';
        $mail->Subject = $subject;
    
        // Tạo nội dung email từ thông tin giỏ hàng
        $cart_data = json_decode($_POST['cart_data'], true);
        $email_body = '<div class="table-responsive">';
        $email_body .= '<table class="table table-bordered">';
        $email_body .= '<thead class="table-dark">';
        $email_body .= '<tr>';
        $email_body .= '<th scope="col">STT</th>';
        $email_body .= '<th scope="col">Sản phẩm</th>';
        $email_body .= '<th scope="col">Số lượng</th>';
        $email_body .= '<th scope="col">Đơn giá</th>';
        $email_body .= '<th scope="col">Thành tiền</th>';
        $email_body .= '</tr>';
        $email_body .= '</thead>';
        $email_body .= '<tbody>';
        
        $total = 0; // Tổng tiền
        $index = 1; // Số thứ tự sản phẩm
        
        foreach ($cart_data as $item) {
            $item_name = $item['item_name'];
            $item_quantity = $item['item_quantity'];
            $item_price = $item['item_price'];
            $item_total = $item_quantity * $item_price;
            
            $total += $item_total; // Cộng dồn tổng tiền
            
            $email_body .= '<tr>';
            $email_body .= "<td>$index</td>";
            $email_body .= "<td>$item_name</td>";
            $email_body .= "<td>$item_quantity</td>";
            $email_body .= "<td>$item_price</td>";
            $email_body .= "<td>$item_total</td>";
            $email_body .= '</tr>';
            
            $index++; // Tăng số thứ tự sản phẩm lên 1
        }
        
        $email_body .= '</tbody>';
        $email_body .= '<tfoot class="table-dark">';
        $email_body .= '<tr>';
        $email_body .= '<td colspan="4" style="text-align: right;"><strong>Tổng cộng:</strong></td>';
        $email_body .= "<td>$total</td>";
        $email_body .= '</tr>';
        $email_body .= '</tfoot>';
        $email_body .= '</table>';
        $email_body .= '</div>';
        $email_body .= '-------------Cảm ơn bạn đã thanh toán ^^-------------';
    
        // Thiết lập nội dung email
        $mail->isHTML(true);
        $mail->Body = $email_body;
    
        // Gửi email
        $mail->send();
        $sendMailSuccess = true;
    } catch (Exception $e) {
        $sendMailSuccess = false;
    }
} else {
    $sendMailSuccess = false;
}
