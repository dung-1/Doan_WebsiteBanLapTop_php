<?php
require_once '../../Core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $product_list= get_all_products();
    include_once '../view/product/_index.php';
}