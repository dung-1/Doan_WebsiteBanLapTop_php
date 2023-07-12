<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['id'];
    $category_name = $_POST['name'];
    update_category($category_id, $category_name);
    header('Location: index.php');
}
?>


