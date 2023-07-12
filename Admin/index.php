<?php
require_once '../core/boot.php';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once './view/_index.php';
}   