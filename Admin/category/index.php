<?php
require_once '../../Core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $category_list = get_all_categories();
    include_once '../view/category/_index.php';
}