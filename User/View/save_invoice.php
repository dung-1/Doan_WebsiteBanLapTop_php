<?php
session_start();
include "../../Core/Conecting.php";

$conn = get_pdo();

// Khởi tạo biến lưu thông báo lỗi
$errors = [];

if (isset($_SESSION['user_id']) && !empty($_SESSION['user_id'])) {
    $customerId = $_SESSION['user_id']; // Lấy ID khách hàng từ phiên đăng nhập

    // Lấy thông tin từ cookie (giỏ hàng)
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);

        // Tính tổng tiền mua hàng (từ giỏ hàng)
        $totalAmount = 0;
        foreach ($cart_data as $item) {
            $totalAmount += $item["item_quantity"] * $item["item_price"];
        }

        // Lưu thông tin đơn hàng vào bảng "orders"
        $purchaseDate = date('Y-m-d');
        $sql = "INSERT INTO orders (user_id, order_date, total_amount) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        if (!$stmt->execute([$customerId, $purchaseDate, $totalAmount])) {
            // Ghi nhận thông báo lỗi vào biến $errors
            $errors[] = "Lỗi khi lưu thông tin đơn hàng";
        } else {
            // Lấy ID hóa đơn vừa được thêm
            $orderId = $conn->lastInsertId();

            // Lưu thông tin chi tiết đơn hàng vào bảng "order_details"
            $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            foreach ($cart_data as $item) {
                $productId = $item["item_id"];
                $quantity = $item["item_quantity"];
                $unitPrice = $item["item_price"];
                if (!$stmt->execute([$orderId, $productId, $quantity, $unitPrice])) {
                    // Ghi nhận thông báo lỗi vào biến $errors
                    $errors[] = "Lỗi khi lưu thông tin chi tiết đơn hàng";
                }
            }

            // Xóa cookie giỏ hàng sau khi đã lưu vào CSDL
            setcookie('shopping_cart', '', time() - 3600);

            if (empty($errors)) {
                echo "success"; // Trả về phản hồi thành công nếu không có lỗi
            }
        }
    } else {
        echo "empty_cart"; // Giỏ hàng trống, không thực hiện lưu
    }
} else {
    echo "login_required"; // Yêu cầu đăng nhập trước khi lưu
}
?>
