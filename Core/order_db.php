<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_orders()
{
    global $pdo;

    $sql = "SELECT o.*, u.username
    FROM orders o
    INNER JOIN users u ON o.order_id = u.user_id WHERE u.role='customer'";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $oder_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $oder_list[] = array(
            'id' => $row['order_id'],
            'name' => $row['username'],
            'date' => $row['order_date'],
            'total_amount' => $row['total_amount'],
            'status' => $row['status'],



        );
    }

    return $oder_list;
}



function delete_orders($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM orders WHERE order_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    return $stmt->rowCount();
}
