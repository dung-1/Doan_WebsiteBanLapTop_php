<?php
require_once '../../Core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $order_list = get_all_orders();
    include_once '../view/order/_index.php';
}