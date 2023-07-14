<?php
session_start();
unset($_SESSION['user_id']); // Xóa session user_id
session_destroy();
header('location: home.php');
?>
