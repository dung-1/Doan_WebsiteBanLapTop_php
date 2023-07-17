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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/reponsive.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>
    <?php include "../../Core/Conecting.php" ?>
    <?php require "header.php" ?>

    <main>
        <?php require "spanner.php" ?>
        <div class="products">
            <?php
            $categories = [
                5 => "LAPTOP GAMING",
                2 => "LAPTOP MỎNG VÀ NHẸ",
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
                        $product_count = 0; // Đếm số lượng sản phẩm hiển thị
                        echo '
                <div class="product-item" data-category="' . $category_id . '">
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
                            if ($product_count < 4) {
                                $product_id = $row['product_id'];
                                $product_image = $row['product_image'];
                                $product_name = $row['product_name'];
                                $product_info = $row['product_info'];
                                $price = $row['price'];
                                $discounted_price = $row['discounted_price'];

                                echo '
                            <div class="col-md-6 col-lg-3 hvr-float">
                                <div class="card mb-3">
                                    <a href="product_detail.php?id=' . $product_id . '">
                                        <img src="' . $product_image . '" class="card-img-top" alt="Hình ảnh sản phẩm">
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

                                if (isset($_SESSION['username'])) {
                                    echo '<form method="post" action="cart.php">
                                        <input type="hidden" name="hidden_id" value="' . $product_id . '">
                                        <input type="hidden" name="hidden_name" value="' . $product_name . '">
                                        <input type="hidden" name="hidden_price" value="' . $price . '">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="add_to_cart" class="btn btn-primary btn-add-to-cart "> Mua ngay</button>
                                    </form>';
                                } else {
                                    echo '<a href="loginPage.php?login_required=1" class="btn btn-primary" onclick="showBtnBuyAlert()"><i class="bi bi-bag-plus-fill"></i>Mua ngay</a>';
                                }

                                echo '</div>
                                </div>
                            </div>';

                                $product_count++;
                            } else {
                                // Ẩn sản phẩm thứ 5 trở đi
                                echo '<div class="col-md-6 col-lg-3 hvr-float hidden-product" style="display: none;">
                            <div class="card mb-3">
                                <a href="product_detail.php?id=' . $row['product_id'] . '">
                                    <img src="' . $row['product_image'] . '" class="card-img-top" alt="Hình ảnh sản phẩm">
                                </a>
                                <div class="card-body">
                                    <h5 class="card-title">' . $row['product_name'] . '</h5>
                                    <p class="card-info">' . $row['product_info'] . '</p>
                                    <div class="d-flex">';
                                if ($row['discounted_price']) {
                                    echo '<p class="product_discount-price">' . number_format($row['discounted_price'], 0, ',', '.') . '</p>';
                                }
                                echo '<p class="product_price">' . number_format($row['price'], 0, ',', '.') . '</p>
                                    </div>';

                                if (isset($_SESSION['username'])) {
                                    echo '<form method="post" action="cart.php">
                                        <input type="hidden" name="hidden_id" value="' . $row['product_id'] . '">
                                        <input type="hidden" name="hidden_name" value="' . $row['product_name'] . '">
                                        <input type="hidden" name="hidden_price" value="' . $row['price'] . '">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" name="add_to_cart" class="btn btn-primary btn-add-to-cart "> Mua ngay</button>
                                    </form>';
                                } else {
                                    echo '<a href="loginPage.php?login_required=1" class="btn btn-primary" onclick="showBtnBuyAlert()"><i class="bi bi-bag-plus-fill"></i>Mua ngay</a>';
                                }

                                echo '</div>
                            </div>
                        </div>';
                            }
                        }

                        echo '
                        </div>
                        <button class="btn btn-primary btn-show-more" data-category="' . $category_id . '">Hiển thị thêm</button>
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
        <script>
            const showMoreButtons = document.querySelectorAll(".product-item .btn-show-more");
            showMoreButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const categoryID = this.getAttribute("data-category");
                    const hiddenProducts = document.querySelectorAll(`.product-item[data-category='${categoryID}'] .hidden-product`);
                    hiddenProducts.forEach((product) => {
                        product.style.display = "block";
                    });
                    this.style.display = "none";
                });
            });
        </script>

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
  
</body>

</html>