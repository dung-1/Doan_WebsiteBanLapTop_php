<?php
session_start();
include "../../Core/Conecting.php";

$conn = get_pdo();

// Khởi tạo biến lưu thông báo lỗi
$errors = [];

if (!isset($_SESSION['username'])) {
    echo json_encode(['status' => 'login_required']);
    exit();
}

if (isset($_COOKIE["shopping_cart"])) {
    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
    $cart_data = json_decode($cookie_data, true);

    $customerId = $_SESSION['user_id'];
    $purchaseDate = date('Y-m-d');

    // Tính tổng tiền mua hàng (từ giỏ hàng)
    $totalAmount = 0;
    foreach ($cart_data as $item) {
        $totalAmount += $item["item_quantity"] * $item["item_price"];
    }

    // Lưu thông tin đơn hàng vào bảng "orders"
    $sql = "INSERT INTO orders (user_id, order_date, total_amount) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    if (!$stmt->execute([$customerId, $purchaseDate, $totalAmount])) {
        $errors[] = "Lỗi khi lưu thông tin đơn hàng";
    } else {
        // Lấy ID hóa đơn vừa được thêm
        $orderId = $conn->lastInsertId();

        // Lưu thông tin chi tiết đơn hàng vào bảng "order_details"
        $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)";
        $stmt_order_details = $conn->prepare($sql);

        // Cập nhật số lượng sản phẩm trong bảng "inventories"
        $sql_update_inventory = "UPDATE inventories SET quantity = quantity - ? WHERE product_id = ?";
        $stmt_update_inventory = $conn->prepare($sql_update_inventory);

        foreach ($cart_data as $item) {
            $productId = $item["item_id"];
            $quantity = $item["item_quantity"];
            $unitPrice = $item["item_price"];

            // Kiểm tra số lượng tồn kho trước khi giảm số lượng sản phẩm
            $sql_check_inventory = "SELECT quantity FROM inventories WHERE product_id = ?";
            $stmt_check_inventory = $conn->prepare($sql_check_inventory);
            $stmt_check_inventory->execute([$productId]);
            $inventory = $stmt_check_inventory->fetch(PDO::FETCH_ASSOC);

            if (!$inventory || $inventory['quantity'] < $quantity) {
                // Sản phẩm không đủ số lượng trong kho
                $errors[] = "Sản phẩm '$productId' không đủ số lượng trong kho";

                // Lấy thông tin sản phẩm từ CSDL để hiển thị trong câu thông báo
                $sql_get_product = "SELECT product_name FROM products WHERE product_id = ?";
                $stmt_get_product = $conn->prepare($sql_get_product);
                $stmt_get_product->execute([$productId]);
                $product = $stmt_get_product->fetch(PDO::FETCH_ASSOC);

                // Kiểm tra xem đã có thông tin sản phẩm hay chưa
                $product_name = $product['product_name'] ?? 'Sản phẩm không xác định';

                // Thông báo sản phẩm đã hết hàng và hiển thị thông tin sản phẩm
                $message = "Sản phẩm '$product_name' đã hết hàng.";
                $errors[] = $message;
            } else {
                if (!$stmt_order_details->execute([$orderId, $productId, $quantity, $unitPrice])) {
                    $errors[] = "Lỗi khi lưu thông tin chi tiết đơn hàng";
                } else {
                    // Giảm số lượng sản phẩm trong bảng "inventories"
                    $stmt_update_inventory->execute([$quantity, $productId]);
                }
            }
        }

        // Xóa cookie giỏ hàng sau khi đã lưu vào CSDL
        setcookie('shopping_cart', '', time() - 3600);

        if (empty($errors)) {
            echo json_encode(['status' => 'success']);
            exit();
        }
    }
} else {
    echo json_encode(['status' => 'empty_cart']);
    exit();
}

echo json_encode(['status' => 'out_of_stock', 'errors' => $errors]);
exit();
?>
