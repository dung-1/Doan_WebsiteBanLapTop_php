<<<<<<< HEAD
<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header('location: ../../Admin/index.php');
        exit();
    } else if ($_SESSION['role'] == 'customer') {
        header('location:user.php');
        exit();
    }
} else {
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
}


?>
<<<<<<< HEAD
=======
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78
=======

>>>>>>> 86819313a6c5449046e06b881fac22213c1a9b4b
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
<<<<<<< HEAD
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">
<<<<<<< HEAD
=======
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.12.0/css/mdb.min.css" />
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78

    <!-- link_css -->
    <link href="../view/css/demo-page.css" rel="stylesheet" media="all">
    <link href="../view/css/hover.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="../view/css/reponsive.css">
    <link rel="stylesheet" href="../view/css/home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
=======
    <link rel="stylesheet" href="css/reponsive.css">
    <link rel="stylesheet" href="css/home.css">
>>>>>>> 86819313a6c5449046e06b881fac22213c1a9b4b
</head>

<body>
    <?php include "../../Core/Conecting.php" ?>
    <?php require "header.php" ?>

    <main>
        <?php require "spanner.php" ?>
        <div class="products">
<<<<<<< HEAD
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
                    <div class="row" id="product-container">
                        <?php
                        $conn = get_pdo();
                        if ($conn) {
                            $sql = "SELECT product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = 1";
                            $result = $conn->query($sql);

                            if ($result->rowCount() > 0) {
                                $count = 0;
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                    $count++;
                        ?>
                                    <div class="col-md-6 col-lg-3 hvr-float">
                                        <div class="card mb-3">
<<<<<<< HEAD
                                            <img src="../../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
=======
                                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top hvr-trim" alt="Product Image">
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info text-secondary"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary add-to-cart"><i class="fa-sharp fa-solid fa-cart-plus"></i> Mua ngay</a>
                                            </div>
                                        </div>
                                    </div>
                        <?php
                                    // Break the loop after displaying 4 products
                                    if ($count == 4) {
                                        break;
                                    }
                                }
                            } else {
                                echo "Không có sản phẩm.";
                            }
                        } else {
                            echo "Kết nối không thành công.";
                        }
                        ?>
                    </div>

                    <?php
                    // Check if there are more products to display
                    if ($result->rowCount() > 4) {
                    ?>
                        <style>
                            #load-more-btn {
                                display: flex;
                                justify-content: center;
                                align-items: center;
                                margin: 20px auto;
                            }
                        </style>
                        <div class="row" id="load-more-btn-container">
                            <div class="col-12">
                                <button id="load-more-btn" class="btn btn-secondary text-center">Hiển thị thêm sản phẩm</button>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <script>
                        var loadMoreBtn = document.getElementById('load-more-btn');
                        var productContainer = document.getElementById('product-container');
                        var displayedProducts = 4; // Number of products initially displayed
                        var totalProducts = <?php echo $result->rowCount(); ?>; // Total number of products

                        loadMoreBtn.addEventListener('click', function() {
                            var remainingProducts = totalProducts - displayedProducts;
                            var batchSize = remainingProducts > 4 ? 4 : remainingProducts;

                            // AJAX call to fetch next batch of products
                            var xhr = new XMLHttpRequest();
                            xhr.open('GET', 'fetch_products.php?offset=' + displayedProducts + '&limit=' + batchSize, true);
                            xhr.onreadystatechange = function() {
                                if (xhr.readyState === 4 && xhr.status === 200) {
                                    var newProducts = xhr.responseText;

                                    // Append the new products to the container
                                    productContainer.insertAdjacentHTML('beforeend', newProducts);

                                    // Update the number of displayed products
                                    displayedProducts += batchSize;

                                    // Hide the load more button if all products are displayed
                                    if (displayedProducts >= totalProducts) {
                                        loadMoreBtn.style.display = 'none';
                                    }
                                }
                            };
                            xhr.send();
                        });
                    </script>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item1 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href=""> Gaming</a></h3>
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
=======
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
                foreach ($categories as $category_id => $category_name) {
                    $sql = "SELECT product_id, product_name, price, discounted_price, product_image, product_info FROM products WHERE category_id = $category_id";
                    $result = $conn->query($sql);

                    if ($result->rowCount() > 0) {
                        echo '
                        <div class="product-item">
                            <div class="pro-head pt-2">
                                <div class="container">
                                    <div class="product-title">
                                        <h3><a href="">' . $category_name . '</a></h3>
                                    </div>
                                </div>
                            </div>
                            <div class="product__show container">
                                <div class="row">';

                        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                            $product_id = $row['product_id'];
                            $product_image = $row['product_image'];
                            $product_name = $row['product_name'];
                            $product_info = $row['product_info'];
                            $price = $row['price'];
                            $discounted_price = $row['discounted_price'];

                            echo '
                                <div class="col-md-6 col-lg-3">
                                    <div class="card mb-3">
                                        <a href="product_detail.php?id=' . $product_id . '">
                                            <img src="../../public/img/products/' . $product_image . '" class="card-img-top" alt="Hình ảnh sản phẩm">
                                        </a>
                                        <div class="card-body">
                                            <h5 class="card-title">' . $product_name . '</h5>
                                            <p class="card-info">' . $product_info . '</p>
                                            <div class="d-flex">';
                            if ($discounted_price) {
                                echo '<p class="product_discount-price">' . number_format($discounted_price, 0, ',', '.') . '</p>';
                            }
                            echo '<p class="product_price">' . number_format($price, 0, ',', '.') . '</p>
                                            </div>';
>>>>>>> 86819313a6c5449046e06b881fac22213c1a9b4b

                            if (isset($_SESSION['username'])) {
                                echo '<form method="post" action="cart.php">
                                            <input type="hidden" name="hidden_id" value="' . $product_id . '">
                                            <input type="hidden" name="hidden_name" value="' . $product_name . '">
                                            <input type="hidden" name="hidden_price" value="' . $price . '">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" name="add_to_cart" class="btn btn-primary btn-add-to-cart">Mua ngay</button>
                                        </form>';
                            } else {
                                echo '<a href="loginPage.php?login_required=1" class="btn btn-primary" onclick="showBtnBuyAlert()">Mua ngay</a>';
                            }

<<<<<<< HEAD
                            // Execute the query
                            $result = $conn->query($sql);

                            // Check if there are any products
                            if ($result->rowCount() > 0) {
                                while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        ?>
                                    <div class="col-md-6 col-lg-3 hvr-float">
                                        <div class="card mb-3">
<<<<<<< HEAD
                                            <img src="../../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
=======
                                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
                                                <div class="d-flex">
                                                    <?php if ($row['discounted_price']) { ?>
                                                        <p class="product_discount-price"><?php echo number_format($row['discounted_price'], 0, ',', '.'); ?></p>
                                                    <?php } ?>
                                                    <p class="product_price"><?php echo number_format($row['price'], 0, ',', '.'); ?></p>
                                                </div>
                                                <a href="#" class="btn btn-primary"> <i class="fa-sharp fa-solid fa-cart-plus"></i> Mua ngay</a>
                                            </div>
                                        </div>
=======
                            echo '</div>
>>>>>>> 86819313a6c5449046e06b881fac22213c1a9b4b
                                    </div>
                                </div>';
                        }
<<<<<<< HEAD
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
                            <h3><a href="">Đồ họa</a></h3>
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
                                    <div class="col-md-6 col-lg-3 hvr-float">
                                        <div class="card mb-3">
<<<<<<< HEAD
                                            <img src="../../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
=======
                                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
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
                    </div>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item3 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">Mỏng nhẹ cao cấp</a></h3>
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
                                    <div class="col-md-6 col-lg-3 hvr-float">
                                        <div class="card mb-3">
<<<<<<< HEAD
                                            <img src="../../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
=======
                                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
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
                    </div>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item4 -->
            <div class="product-item">
                <div class="pro-head pt-2">
                    <div class="container">
                        <div class="product-title">
                            <h3><a href="">Like new</a></h3>
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
                                    <div class="col-md-6 col-lg-3 hvr-float">
                                        <div class="card mb-3">
<<<<<<< HEAD
                                            <img src="../../public/img/products/<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
=======
                                            <img src="<?php echo $row['product_image']; ?>" class="card-img-top" alt="Product Image">
>>>>>>> 67fcafc0a1c5d93b6a530c568a72bfff5aca8e78
                                            <div class="card-body">
                                                <h5 class="card-title"><?php echo $row['product_name']; ?></h5>
                                                <p class="card-info"><?php echo $row['product_info']; ?></p>
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
                    </div>
                </div>
                <!-- end_product_show-->
            </div>
            <!-- end_product_item5-->
        </div>
        <!-- end_products -->

    </main>

    </script>
    <!-- end-main -->
    <?php require "footer.php" ?>
    <script src="../../plugins/jquery/jquery.min.js"></script>
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <script src="../../plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/mdb-ui-kit@3.12.0/js/mdb.min.js"></script>

=======

                        echo '
                                </div>
                            </div>
                        </div>';
                    } else {
                        echo '<p>Không có sản phẩm.</p>';
                    }
                }
            } else {
                echo '<p>Kết nối không thành công.</p>';
            }
            ?>
        </div>
    </main>
    <?php require "footer.php" ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var countElement = document.getElementById('count_shopping_cart_store');
            countElement.innerText = '0';
            var countValue = 0;


            function updateCartCounter() {
                countValue += 1;
                countElement.innerText = countValue;
            }

            var addToCartButtons = document.querySelectorAll('.btn-add-to-cart');
            addToCartButtons.forEach(function(button) {
                button.addEventListener('click', function() {
                    updateCartCounter();
                    Swal.fire(
                        'Thêm vào giỏ hàng thành công!',
                        'success'
                    )
                });
            });
        });

        function resetCart() {
            // Xóa giỏ hàng bằng cách xóa cookie shopping_cart
            document.cookie = "shopping_cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }
    </script>
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
                    alert('Thêm vào giỏ hàng thành công!!');
                });
            });
        });

        function resetCart() {
            // Xóa giỏ hàng bằng cách xóa cookie shopping_cart
            document.cookie = "shopping_cart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
        }

        
    </script>
>>>>>>> 86819313a6c5449046e06b881fac22213c1a9b4b
t 
</body>

</html>