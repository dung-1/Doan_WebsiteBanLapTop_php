<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_inventories()
{
    global $pdo;

    $sql = "SELECT i.*, p.product_name
    FROM inventories i
    INNER JOIN products p ON p.product_id = i.product_id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $inventory_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $inventory_list[] = array(
            'id' => $row['inventory_id'],
            'product_name' => $row['product_name'],
            'date_add' => $row['date_add'],
            'quantity' => $row['quantity'],

        );
    }

    return $inventory_list;
}

function insert_inventory($product_id, $date_add, $quantity)
{
    global $pdo;
    $sql = "INSERT INTO inventories(product_id, date_add, quantity) VALUES(:product_id, :date_add, :quantity)";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':date_add', $date_add);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi thêm kho.');
        }
    } catch (Exception $e) {
        header('Location: ../view/inc/error_insert.php');
        exit;
    }
}


function get_inventory($inventory_id)
{
    global $pdo;

    $sql = "SELECT * FROM inventories WHERE inventory_id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $inventory_id);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    // Lặp kết quả
    foreach ($result as $row) {
        return array(
            'id' => $row['id'],
            'product_name' => $row['product_name'],
            'date_add' => $row['date_add'],
            'quantity' => $row['quantity'],


        );
    }
    return null;
}
function update_inventory($id, $product_id, $date_add, $quantity)
{
    global $pdo;
    $sql = "UPDATE inventories SET product_id=:product_id, date_add=:date_add, quantity=:quantity WHERE inventory_id=:id";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':date_add', $date_add);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo '<script>';
        echo 'alert("Cập nhật thành công");';
        echo '</script>';
        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi cập nhật hãng.');
        }
    } catch (Exception $e) {
        header('Location: ../view/inc/error_insert.php');
        exit;
    }
}
function delete_inventories($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM inventories WHERE inventory_id IN ($placeholders)";
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt) {
            if ($stmt->execute($ids)) {
                return $stmt->rowCount();
            }
        }
        throw new Exception('Lỗi xóa kho.'); // Ném ngoại lệ nếu có lỗi xảy ra
    } catch (Exception $e) {
        header('Location: ../view/inc/error_delete.php');
        exit;
    }
}
