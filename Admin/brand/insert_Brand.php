<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $country = $_POST['country'];
    $date = $_POST['date'];
    insert_brand($name, $date, $country);
    header('Location: index.php');
}

