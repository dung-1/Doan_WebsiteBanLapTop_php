<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete']) && is_array($_POST['delete'])) {
        $ids = $_POST['delete'];
        $result = delete_order_detail($ids);

        if ($result > 0) {
            echo 'Xóa thành công ' . $result . ' bản ghi.';
        } else {
            echo 'Không có bản ghi nào được xóa.';
        }
    } else {
        echo 'Vui lòng chọn ít nhất một bản ghi để xóa.';
    }
}
?>
    