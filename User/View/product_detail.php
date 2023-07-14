<?php
session_start();
include "../../Core/Conecting.php";

// Kiểm tra xem người dùng đã đăng nhập hay chưa
if (isset($_SESSION['username'])) {
    // Lấy số lượng sản phẩm trong giỏ hàng từ cookie
    $cart_count = 0;
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        $cart_count = count($cart_data);
    }
} else {
    $cart_count = 0;
}

// Retrieve the product ID from the URL
if (isset($_GET['id'])) {
    $product_id = $_GET['id'];

    // Use the product ID to fetch the product details from the database
    $pdo = get_pdo();

    // Check if the connection is successful
    if ($pdo) {
        $sql = "SELECT product_name, price, discounted_price, product_info, product_image FROM products WHERE product_id = :product_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindValue(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $product_name = $row['product_name'];
            $product_info = $row['product_info'];
            $price = $row['price'];
            $discounted_price = $row['discounted_price'];
            $product_image = $row['product_image'];
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Chi tiết sản phẩm</title>
                <!-- Link_thuvien -->
                <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
                <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">
                <!-- link_css -->
                <link rel="stylesheet" href="css/reponsive.css">
                <link rel="stylesheet" href="css/home.css">
                <link rel="stylesheet" href="css/trangchitiet.css">
            </head>
            <body>
                <?php include "header.php"; ?>
                <!-- Product section-->
                <section class="py-5">
                    <div class="container px-4 px-lg-5 my-5">
                        <div class="row gx-4 gx-lg-5 align-items-center">
                            <div class="col-md-6 col-sm-12">
                                <img class="card-img-detail mb-5 mb-md-0" src="../../public/img/products/<?php echo $product_image; ?>" alt="Hình ảnh sản phẩm">
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <h1 class="display-4 fw-bolder"><?php echo $product_name; ?></h1>
                                <div class="fs-5 mb-5">
                                    <?php if ($discounted_price) { ?>
                                        <span class="text-decoration-line-through"><?php echo number_format($price, 0, ',', '.'); ?></span>
                                        <span class="text-danger"><?php echo number_format($discounted_price, 0, ',', '.'); ?></span>
                                    <?php } else { ?>
                                        <span><?php echo number_format($price, 0, ',', '.'); ?></span>
                                    <?php } ?>
                                </div>
                                <p class="lead"><?php echo $product_info; ?></p>
                                <div class="d-flex">
                                    <?php if (isset($_SESSION['username'])) { ?>
                                        <form action="cart.php" method="post">
                                            <input type="hidden" name="hidden_id" value="<?php echo $product_id; ?>">
                                            <input type="hidden" name="hidden_name" value="<?php echo $product_name; ?>">
                                            <input type="hidden" name="hidden_price" value="<?php echo $discounted_price ? $discounted_price : $price; ?>">
                                            <div class="d-flex"><input class="form-control text-center me-3" name="quantity" id="inputQuantity" type="number" value="1" style="max-width: 3rem">
                                            <button class="btn btn-outline-info flex-shrink-0" name="add_to_cart" type="submit">
                                                <i class="bi bi-cart-fill me-1"></i>
                                                Thêm vào giỏ
                                            </button></div>
                                        </form>
                                    <?php } else { ?>
                                        <button class="btn btn-outline-info flex-shrink-0" onclick="showBtnBuyAlert()">
                                            <i class="bi bi-cart-fill me-1"></i>
                                            Thêm vào giỏ
                                        </button>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Footer-->
                <?php require_once "footer.php"; ?>
                <!-- Link_thuvien -->
                <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
                <script>
                    function showBtnBuyAlert() {
                        alert('Bạn cần đăng nhập để mua hàng!!');
                    }
                </script>
            </body>
            </html>
            <?php
        } else {
            echo "Không tìm thấy sản phẩm.";
        }
    } else {
        echo "Kết nối không thành công.";
    }
} else {
    if (isset($_SESSION['username'])) {
        if ($_SESSION['role'] == 'admin') {
            header('location: ../../Admin/index.php');
            exit();
        } else if ($_SESSION['role'] == 'customer') {
            header('location:user.php');
            exit();
        }
    }
}
?>
