<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id']; // Lấy product_id từ form
    $date = $_POST['date'];
    $quantity = $_POST['quantity'];
    insert_inventory($product_id, $date, $quantity);
    header('Location: index.php');
}
?>
