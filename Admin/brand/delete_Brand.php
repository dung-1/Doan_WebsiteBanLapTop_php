<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete']) && is_array($_POST['delete'])) {
        $ids = $_POST['delete'];
        $result = delete_brands($ids);

        if ($result > 0) {
            header('Location: index.php');
            echo '<script>alert("Xóa thành công ' . $result . ' bản ghi.");</script>';
        } else {
            echo 'Không có bản ghi nào được xóa.';
        }
    } else {
        echo 'Vui lòng chọn ít nhất một bản ghi để xóa.';
    }
}
?>
