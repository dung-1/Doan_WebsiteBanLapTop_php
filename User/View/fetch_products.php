<?php
require_once '../../core/Conecting.php';
$conn = get_pdo();

if ($conn) {
    $offset = $_GET['offset']; // Vị trí bắt đầu của các sản phẩm
    $limit = $_GET['limit']; // Số lượng sản phẩm cần lấy

    // SQL query để lấy các sản phẩm từ vị trí và số lượng được chỉ định
    $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = 1 LIMIT $limit OFFSET $offset";

    // Thực hiện truy vấn
    $result = $conn->query($sql);

    // Kiểm tra xem có sản phẩm nào hay không
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
?>
            <div class="col-md-6 col-lg-3 hvr-float">
                <div class="card mb-3">
                    <img src="<?php echo $row['product_image']; ?>" class="card-img-top hvr-trim" alt="Product Image">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                        <p class="card-info text-secondary"><?php echo $row['product_info']; ?></p>
                        <div class="d-flex">
                            <?php if ($row['discounted_price']) { ?>
                                <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                            <?php } ?>
                            <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                        </div>
                        <a href="#" class="btn btn-primary"> <i class="fa-sharp fa-solid fa-cart-plus"></i> Mua ngay</a>
                    </div>
                </div>
            </div>
<?php
        }
    } else {
        echo "Không có sản phẩm.";
    }
} else {
    echo "Kết nối không thành công.";
}
?>