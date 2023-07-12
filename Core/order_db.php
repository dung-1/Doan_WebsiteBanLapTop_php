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

function insert_order($username, $order_date, $total_amount, $status)
{
    global $pdo;
    $sql = "INSERT INTO orders(user_id,order_date,,total_amount,status) VALUES(:name,:date,:toatal,:status)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $username);
    $stmt->bindParam(':date', $order_date);
    $stmt->bindParam(':total', $total_amount);
    $stmt->bindParam(':status', $status);

    $stmt->execute();
}

// function get_order($order_id)
// {
//     global $pdo;

//     $sql = "SELECT * FROM orders WHERE order_id=:id";
//     $stmt = $pdo->prepare($sql);
//     $stmt->bindParam(':id', $order_id);

//     $stmt->execute();
//     $stmt->setFetchMode(PDO::FETCH_ASSOC);

//     // Lấy danh sách kết quả
//     $result = $stmt->fetchAll();

//     // Lặp kết quả
//     foreach ($result as $row) {
//         return array(
//             'id' => $row['order_id'],
//             'name' => $row['username'],
//             'date' => $row['order_date'],
//             'total_amount' => $row['total_amount'],
//             'status' => $row['status'],

//         );
//     }
//     return null;
// }
function update_order($id, $username, $order_date, $total_amount, $status)
{
    global $pdo;
    $sql = "UPDATE orders SET user_id=:user ,order_date=:date,total_amount=:total,status=:status WHERE order_id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':user', $username);
    $stmt->bindParam(':date', $order_date);
    $stmt->bindParam(':total', $total_amount);
    $stmt->bindParam(':status', $status);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

class orderModel
{
    public function deleteorders($ids)
    {
        try {
            $pdo = get_pdo();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Escape the IDs to prevent SQL injection
            $escapedIds = array_map(function ($id) use ($pdo) {
                return $pdo->quote($id);
            }, $ids);

            // Create the comma-separated list of IDs
            $idList = implode(',', $escapedIds);

            // Delete the selected items
            $query = "DELETE FROM orders WHERE order_id IN ($idList)";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            // Check if any rows were affected
            $rowCount = $stmt->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
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
