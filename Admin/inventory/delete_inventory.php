<?php
require_once '../../core/boot.php';
$message = "Xóa Thành công";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete']) && is_array($_POST['delete'])) {
        $ids = $_POST['delete'];

        $result = delete_inventories($ids);

        if ($result > 0) {
            header('Location: index.php');
        }
    }
}