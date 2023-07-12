<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_customer()
{
    global $pdo;

    $sql = "SELECT * From users where role='customer'";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $customer_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $customer_list[] = array(
            'id' => $row['user_id'],
            'user_name' => $row['username'],
            'password' => $row['password'],
            'email' => $row['email'],
            'phone' => $row['phone'],
            'full_name' => $row['full_name'],
            'birthdate' => $row['birthdate'],
            'gender' => $row['gender'],
        );
    }

    return $customer_list;
}

function delete_customer($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM users WHERE user_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    return $stmt->rowCount();
}
