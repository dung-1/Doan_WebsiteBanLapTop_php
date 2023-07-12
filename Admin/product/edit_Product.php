<?php
require_once '../../core/boot.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['name'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $price = $_POST['price'];
    $discounted_price = $_POST['discounted'];
    $product_info = $_POST['info'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $image = $_FILES['image'];
        $image_name = basename($image['name']);
        $image_tmp = $image[    'tmp_name'];
        // Đường dẫn lưu trữ ảnh (thay đổi theo nhu cầu)
        $image_path = '../../public/img/' . $image_name;
        // Di chuyển tệp tin ảnh vào thư mục lưu trữ
        move_uploaded_file($image_tmp, $image_path);
        $product_image = $image_name;
    } else {
        // Lấy ảnh hiện tại của sản phẩm từ cơ sở dữ liệu
        $current_product = get_product_by_id($product_id);
        $image_path= $current_product['product_image'];
    }


    update_product($product_id, $product_name, $category_id, $brand_id, $price, $discounted_price, $image_path, $product_info);
    header('Location: index.php');
}

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    include_once '../view/product/_edit.php';
}
