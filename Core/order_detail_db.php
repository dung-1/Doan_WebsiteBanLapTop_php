<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_order_detail()
{
    global $pdo;

    $sql = "SELECT o.*, p.product_name
    FROM order_details o
    INNER JOIN products p ON o.product_id = p.product_id ";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $oder_detail_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $oder_detail_list[] = array(
            'id' => $row['order_detail_id'],
            'order_id' => $row['order_id'],
            'product_name' => $row['product_name'],
            'quantity' => $row['quantity'],
            'price' => $row['price'],



        );
    }

    return $oder_detail_list;
}


function delete_order_detail($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM order_details WHERE order_detail_id IN ($placeholders)";
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt) {
            $stmt->execute($ids);
            return $stmt->rowCount();
        }
        throw new Exception('Lỗi xóa chi tiết đơn hàng.'); // Ném ngoại lệ nếu có lỗi xảy ra
    } catch (Exception $e) {
        header('Location: ../view/inc/error_delete.php');
        exit;
    }
}
