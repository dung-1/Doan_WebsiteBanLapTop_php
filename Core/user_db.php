<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_user()
{
    global $pdo;

    $sql = "SELECT * From users where role='admin'";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $user_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $user_list[] = array(
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

    return $user_list;
}

function delete_user($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM users WHERE user_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    return $stmt->rowCount();
}
