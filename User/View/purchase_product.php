<?php

if (!isset($_SESSION['username'])) {
    // Nếu khách hàng chưa đăng nhập, không cho phép mua sản phẩm
    echo json_encode(['status' => 'login_required']);
    exit();
}

if (!isset($_POST['product_id'])) {
    // Trường hợp không nhận được thông tin sản phẩm
    echo json_encode(['status' => 'error']);
    exit();
}

require_once 'Conecting.php';
$pdo = get_pdo();
$product_id = $_POST['product_id'];

// Kiểm tra số lượng tồn kho của sản phẩm
$sql = "SELECT quantity FROM inventories WHERE product_id = :product_id";
$stmt = $pdo->prepare($sql);
$stmt->execute(['product_id' => $product_id]);
$inventory = $stmt->fetch(PDO::FETCH_ASSOC);

if ($inventory && $inventory['quantity'] > 0) {
    // Trừ đi 1 sản phẩm trong tồn kho
    $sql_update = "UPDATE inventories SET quantity = quantity - 1 WHERE product_id = :product_id";
    $stmt_update = $pdo->prepare($sql_update);
    $stmt_update->execute(['product_id' => $product_id]);

    // Ở đây bạn có thể thêm các xử lý liên quan đến việc thêm sản phẩm vào giỏ hàng của khách hàng nếu cần thiết.
    // Ví dụ: Thêm sản phẩm vào giỏ hàng của khách hàng.

    // Trả về kết quả là thành công
    echo json_encode(['status' => 'success']);
} else {
    // Sản phẩm đã hết hàng
    echo json_encode(['status' => 'out_of_stock']);
}
?>
