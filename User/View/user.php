<?php

if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'customer') {
        header('location:../../View/user.php');
        exit();
    }
}
else {
    header('location:../../View/loginPage.php');
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link_thuvien -->
    <link rel="stylesheet" href="../plugins/css/bootstrap.min.css">
    <script src="../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../plugins/icons-1.10.5/font/bootstrap-icons.css">

    <!-- link_css -->
    <link rel="stylesheet" href="css/reponsive.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php include  "../Core/Conecting.php" ?>
    <?php require "header.php" ?>
    <!-- end-header -->
    <main>
        <?php require "spanner.php" ?>

        <div class="products">
            <?php
            $categories = [
                5 => "LAPTOP GAMING",
                2 => "LAPTOP GAMING",
                3 => "LAPTOP ĐỒ HỌA",
                4 => "MỎNG NHẸ CAO CẤP",
                1 => "LIKE NEW"
            ];

            $conn = get_pdo();

            if ($conn) {
                // Lấy giá trị của cookie giỏ hàng
                $cart_data = isset($_COOKIE['shopping_cart']) ? json_decode(stripslashes($_COOKIE['shopping_cart']), true) : array();

                foreach ($categories as $category_id => $category_name) {
                    $sql = "SELECT product_id, product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = $category_id";
                    $result = $conn->query($sql);

                            // Check if there are any products
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card mb-3">
                                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info text-secondary"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary">Mua ngay</a>
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
                    </div>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item1 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">LAPTOP GAMING</a></h3>
                        </div>
                        <!-- end_title -->
                    </div>
                    <!-- end_container -->
                </div>
                <!-- end_pro_head -->
                <div class="product__show container">
                    <div class="row">
                        <?php
                        $conn = get_pdo();

                        // Check if the connection is successful
                        if ($conn) {
                            // SQL query to fetch products based on category_id
                            $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id =2";

                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if there are any products
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card mb-3">
                                            <img src="../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary">Mua ngay</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__show container">
                                <div class="row">';

                            // Check if there are any products
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card mb-3">
                                            <img src="../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary">Mua ngay</a>
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
                    </div>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item3 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">MỎNG NHẸ CAO CẤP</a></h3>
                        </div>
                        <!-- end_title -->
                    </div>
                    <!-- end_container -->
                </div>
                <!-- end_pro_head -->
                <div class="product__show container">
                    <div class="row">
                        <?php
                        $conn = get_pdo();

                        // Check if the connection is successful
                        if ($conn) {
                            // SQL query to fetch products based on category_id
                            $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = 4";

                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if there are any products
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card mb-3">
                                            <img src="../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary">Mua ngay</a>
                                            </div>
                                            <form method="post" action="cart.php">
                                                <input type="hidden" name="hidden_id" value="' . $product_id . '">
                                                <input type="hidden" name="hidden_name" value="' . $product_name . '">
                                                <input type="hidden" name="hidden_price" value="' . $price . '">
                                                <input type="hidden" name="quantity" value="1">
                                                ' . (in_array($product_id, array_column($cart_data, 'item_id')) ? '<button type="button" class="btn btn-success btn-added-to-cart">Đã thêm</button>' : '<button type="submit" name="add_to_cart" class="btn btn-primary btn-add-to-cart">Mua ngay</button>') . '
                                            </form>
                                        </div>
                                    </div>
                                </div>';
                        }

                        // Check if the connection is successful
                        if ($conn) {
                            // SQL query to fetch products based on category_id
                            $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = 5";

                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if there are any products
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                    <div class="col-md-6 col-lg-3">
                                        <div class="card mb-3">
                                            <img src="../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary">Mua ngay</a>
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
                    </div>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item5-->
        </div>
        <!-- end_products -->
    </main>
    <?php require "footer.php" ?>
</body>

</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var countElement = document.getElementById('count_shopping_cart_store');
        var countValue = parseInt(countElement.innerText);

        function updateCartCounter() {
            countValue += 1;
            countElement.innerText = countValue;
        }

        var addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
        addToCartButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                updateCartCounter();
                alert("Thêm vào giỏ hàng thành công!!");
            });
        });
    });

</script>

