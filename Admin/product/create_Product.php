<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $category = $_POST['category'];
    $brand = $_POST['brand'];
    $price = $_POST['price'];
    $discounted = $_POST['discounted'];
    $image = $_FILES['image'];
    $image_name = $image['name'];
    $image_tmp = $image['tmp_name'];
    // Đường dẫn lưu trữ ảnh (thay đổi theo nhu cầu)
    $image_path = '../../public/img/' . $image_name;
    // Di chuyển tệp tin ảnh vào thư mục lưu trữ
    move_uploaded_file($image_tmp, $image_path);
    $info = $_POST['info'];
    insert_product(
        $name,
        $category,
        $brand,
        $price,
        $discounted,
        $image_path,
        $info
    );
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $product_list = get_all_products();
    include_once '../view/product/_create.php';
}
