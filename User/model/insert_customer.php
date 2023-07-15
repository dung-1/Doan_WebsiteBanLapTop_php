<?php
require_once '../../core/boot.php';
$pdo = get_pdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $full_name = $_POST['full_name'];

    if (check_username_exist($username)) {
        // Username đã tồn tại, hiển thị câu thông báo alert
        echo "<script>
                alert('Username đã tồn tại');
                window.location.href = '../View/sign_login.php';
              </script>";
        exit;
    }

    insert_customer($username, $password, $email, $phone, $full_name);
                echo "<script>
                alert('BẠN ĐÃ ĐĂNG KÝ TÀI KHOẢN THÀNH CÔNG');
                window.location.href = '../View/sign_login.php';
                    </script>";
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

function insert_customer($username, $password, $email, $phone, $full_name)
{
    global $pdo;
    $role = "customer"; // Giá trị cố định cho cột "role"

    $sql = "INSERT INTO users (username, password, email, phone, full_name, role) VALUES (:username, :password, :email, :phone, :full_name, :role)";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':role', $role);

        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi thêm khách hàng.');
        }
    } catch (Exception $e) {
        header('Location: ../../Admin/view/inc/error_insert.php');
        exit;
    }
}
