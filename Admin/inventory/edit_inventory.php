<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inventory_id = $_POST['id'];
    $product_name = $_POST['product_name'];
    $inventory_date = $_POST['date'];
    $quantity = $_POST['quantity'];
    update_inventory($inventory_id, $product_name, $inventory_date, $quantity);
    header('Location: index.php');
}
?>


