<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    insert_category($name);
    header('Location: index.php');
}

