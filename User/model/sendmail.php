<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
require 'PHPMailer/src/Exception.php';

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

        // Thiết lập tiêu đề email
        $subject = '=?UTF-8?B?' . base64_encode($_POST['subject']) . '?=';
        $mail->Subject = $subject;

        // Tạo nội dung email từ thông tin giỏ hàng
        $cart_data = json_decode($_POST['cart_data'], true);
        $email_body = '
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Invoice</title>
            <style>
                body {
                    font-family: Arial, sans-serif;
                }
                h2 {
                    color: #333;
                }
                table {
                    width: 70%;
                    max-width: 100%;
                    margin-bottom: 1rem;
                    background-color: transparent;
                }
                table thead th {
                    border-bottom: 2px solid #333;
                    border-right: 2px solid #333;
                    background-color: #f5f5f5;
                    color: #333;
                    padding: 8px;
                }
                table tbody td {
                    border-bottom: 1px solid #ccc;
                    border-right: 1px solid #ccc;
                    padding: 8px;
                    text-align: center;
                }
                table tfoot td {
                    text-align: right;
                    font-weight: bold;
                    border-top: 2px solid #333;
                    padding: 8px;
                }
                table tbody td:first-child {
                    width: 10%;
                }
                .price {
                    color: red;
                }
                .center {
                    text-align: center;
                }
            </style>
        </head>
        <body>
            <h2 class="center" style="width:70%; color:red;">HÓA ĐƠN CỦA BẠN</h2>
            <table class="text-center">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>';

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
            $email_body .= "<td>" . number_format($item_price, 0, ',', '.') . " vnđ</td>";
            $email_body .= "<td class='price'>" . number_format($item_total, 0, ',', '.') . " vnđ</td>";
            $email_body .= '</tr>';

            $index++; // Tăng số thứ tự sản phẩm lên 1
        }

        $email_body .= '</tbody>';
        $email_body .= '<tfoot>';
        $email_body .= '<tr>';
        $email_body .= '<td colspan="4" style="text-align: right;color:green;font-size:25px;"><strong>Tổng cộng:</strong></td>';
        $email_body .= "<td class='price' style='font-size:25px;'>" . number_format($total, 0, ',', '.') . " vnđ</td>";
        $email_body .= '</tr>';
        $email_body .= '</tfoot>';
        $email_body .= '</table>';
        $email_body .= '<h2 class="center" style="width:70%;">------------------------------------------------Cảm ơn bạn đã thanh toán !!!------------------------------------------------</h2>';
        $email_body .= '</body></html>';

        // Thiết lập nội dung email
        $mail->isHTML(true);
        $mail->Body = $email_body;

        // Gửi email
        $mail->send();
        echo 'Message has been sent';

        // Xóa cookie giỏ hàng
        setcookie('shopping_cart', '', time() - 3600);
    } catch (Exception $e) {
        echo 'Mailer Error: ' . $mail->ErrorInfo;
    }
} else {
    echo 'Invalid request';
}
?>
