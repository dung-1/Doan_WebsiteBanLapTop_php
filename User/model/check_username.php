<?php
include "../../Core/Conecting.php";
$pdo = get_pdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];

    $exists = check_username_exist($username);

    $response = [
        'exists' => $exists
    ];

    header('Content-Type: application/json');
    echo json_encode($response);
}

function check_username_exist($username)
{
    global $pdo;

    $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    $count = $stmt->fetchColumn();

    return $count > 0; // Trả về true nếu username đã tồn tại, ngược lại trả về false
}
?>
