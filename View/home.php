<?php
session_start();
if (isset($_SESSION['username'])) {
    // Kiểm tra vai trò của người dùng và điều hướng tới các trang phù hợp
    if ($_SESSION['role'] == 'admin') {
        header('location: ../Admin/index.php');
        exit();
    } else if ($_SESSION['role'] == 'customer') {
        header('location: user.php');
        exit();
    }
}
?>
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
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">HỌC TẬP - VĂN PHÒNG</a></h3>
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
                            $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = 1";

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
                            <h3><a href="">HỌC TẬP - VĂN PHÒNG</a></h3>
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
            <!-- end_product_item2 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">HỌC TẬP - VĂN PHÒNG</a></h3>
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
                            $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = 3";

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
            <!-- end_product_item3 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">HỌC TẬP - VĂN PHÒNG</a></h3>
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
            <!-- end_product_item4 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">HỌC TẬP - VĂN PHÒNG</a></h3>
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
    <!-- end-main -->
    <?php require "footer.php" ?>
    <!-- end-footer -->
</body>

</html>