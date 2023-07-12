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

// class order_detailModel
// {
//     public function deleteorder_details($ids)
//     {
//         try {
//             $pdo = get_pdo();
//             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//             // Escape the IDs to prevent SQL injection
//             $escapedIds = array_map(function ($id) use ($pdo) {
//                 return $pdo->quote($id);
//             }, $ids);

//             // Create the comma-separated list of IDs
//             $idList = implode(',', $escapedIds);

//             // Delete the selected items
//             $query = "DELETE FROM order_details WHERE order_detail_id IN ($idList)";
//             $stmt = $pdo->prepare($query);
//             $stmt->execute();

//             // Check if any rows were affected
//             $rowCount = $stmt->rowCount();

//             return $rowCount > 0;
//         } catch (PDOException $e) {
//             return false;
//         }
//     }
// }

function delete_order_detail($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM order_details WHERE order_detail_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    return $stmt->rowCount();
}
