<?php
require_once '../../Core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $brand_list = get_all_brands();
    include_once '../view/brand/_index.php';
}