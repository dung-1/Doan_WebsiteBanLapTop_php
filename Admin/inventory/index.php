<?php
require_once '../../Core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $inventory_list = get_all_inventories();
    include_once '../view/inventory/_index.php';
}