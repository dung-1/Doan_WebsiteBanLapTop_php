<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $brand_id = $_POST['id'];
    $brand_name = $_POST['name'];
    $brand_country = $_POST['country'];
    $brand_date = $_POST['date'];
    update_brand($brand_id, $brand_name, $brand_date, $brand_country);
    header('Location: index.php');
}
?>


