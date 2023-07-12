<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header('location:../Admin/index.php');
        exit();
    }
}
else {
    header('location:../View/loginPage.php');
    exit();
} ?>
<!DOCTYPE html>
<html lang="en">

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
    <!-- link_js -->
    <script src="js/cart.js"></script>
</head>

<body>
    <?php include  "../Core/Conecting.php" ?>

    <header>
        <div class="container">
            <div class="navbar align-items-center justify-content-between ">
                <div class=" navbar__logo">
                    <a href="home.php"><img alt="laptopaz.com chuyên laptop cũ, bán laptop cũ uy tín Hà Nội và toàn quốc" src="../public/img/icons/icon.png" class="img-fluid"></a>
                </div>
                <div class="navbar__cart align-items-center  flex-column ">
                    <i class="bi bi-cart3"></i>
                    <a href="">Giỏ hàng</a>
                    <span class="cart-quantity-counter" id="count_shopping_cart_store">0</span>
                </div>
                <div class=" navbar__search-form ">
                    <div class="input-group ">
                        <input type="search" class="form-control rounded" placeholder="Bạn muốn tìm kiếm gì..." aria-label="Search" aria-describedby="search-addon" />
                        <button type="button" class="btn "><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <div class=" navbar__hotline align-items-center  flex-column hide-mobile hide-tablet ">
                    <p class="m-0 text-danger text-center">HOTLINE</p>
                    <p>0825 233 233</p>
                </div>
            </div>
        </div>

        <!-- end_container -->
        <div class="menu">
            <nav class="navbar navbar-expand-lg">

                <div class="container-fluid">
                    <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">

                        <i class="bi bi-list menu__toggler"></i>

                    </button>
                    <div class="collapse navbar-collapse container" id="navbarCollapse">

                        <div class="navbar-nav">

                            <a href="#" class="nav-item nav-link me-2"><i class="bi bi-laptop"></i> LAPTOP MỚI</a>

                            <a href="#" class="nav-item nav-link me-2"><i class="bi bi-windows"></i> SURFACE</a>

                            <a href="#" class="nav-item nav-link me-2"><i class="bi bi-laptop"></i> LAPTOP LIKE NEW</a>

                            <a href="#" class="nav-item nav-link me-2"><i class="bi bi-fire"></i> KHUYẾN MÃI</a>
                            <a href="#" class="nav-item nav-link me-2"><i class="bi bi-cash-coin"></i> TRẢ GÓP</a>

                        </div>

                        <div class="navbar-nav ms-auto">
                            <?php
                            if (isset($_SESSION['username'])) {
                                // Nếu có session username thì hiển thị nút Logout
                                echo '<a href="logout.php" class="nav-item nav-link me-4"><i class="bi bi-door-closed-fill"></i>Đăng xuất</a>';
                            } else {
                                // Ngược lại hiển thị nút Đăng nhập và Đăng ký
                                echo '<a href="loginPage.php" class="nav-item nav-link me-4" data-toggle="modal" data-target="#modalLoginForm">
                                    <i class="bi bi-box-arrow-in-left"></i> Đăng nhập
                                </a>

                                <a href="registerPage.php" class="nav-item nav-link me-4"><i class="bi bi-box-arrow-right"></i> Đăng ký</a>';
                            }
                            ?>
                        </div>
                    </div>

                </div>

            </nav>
        </div>
        <!-- end_menu -->
    </header>
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
                                                <button class="btn btn-primary">Mua ngay</button>
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