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
                    <link rel="stylesheet" href="css/product_detail.css">


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
                                    <h1 class="display-6 fw-bolder"><?php echo $product_name; ?></h1>
                                    <div class="fs-5 mb-5">
                                        <?php if ($discounted_price) { ?>

                                            <span class="text-danger fs-3 fw-bold"><?php echo number_format($discounted_price, 0, ',', '.'); ?></span>
                                            <span class="text-decoration-line-through mx-3 "><?php echo number_format($price, 0, ',', '.'); ?></span>
                                            <p class="mt-3 fs-5" style="font-family:'Times New Roman', Times, serif;">Với thiết kế sang trọng, kiểu dáng thanh lịch màn hình chuyên biệt, độ sáng cao, màu sắc chân thực sống động cùng với hiệu năng mới mẻ và cực kì mạnh mẽ từ vi xử lý AMD 7000 mới nhất hiện nay. Sự kết hợp hoàn hảo và cực kì tuyệt vờ cho những ai có công việc liên quan đến thiết kế hình ảnh hay đồ họa cao cấp. Nghe đến đây mọi người đã thấy ưng ý chưa ạ, hãy cùng LaptopAZ đi tìm hiểu chi tiết về chiếc laptop này ngay thôi nào!</p>
                                        <?php } else { ?>
                                            <span><?php echo number_format($price, 0, ',', '.'); ?></span>

                                        <?php } ?>
                                    </div>
                                    <p class="lead">Cấu hình: <?php echo $product_info; ?></p>
                                    <div class="d-flex">
                                        <?php if (isset($_SESSION['username'])) { ?>
                                            <form action="cart.php" method="post">
                                                <input type="hidden" name="hidden_id" value="<?php echo $product_id; ?>">
                                                <input type="hidden" name="hidden_name" value="<?php echo $product_name; ?>">
                                                <input type="hidden" name="hidden_price" value="<?php echo $discounted_price ? $discounted_price : $price; ?>">
                                                <div class="d-flex">
                                                    <input class="form-control text-center me-3" name="quantity" id="inputQuantity" type="number" value="1" min="1" style="max-width: 3rem">
                                                    <button class="btn btn-outline-success flex-shrink-0" name="add_to_cart" type="submit">
                                                        <i class="bi bi-cart-fill me-1"></i>
                                                        Thêm vào giỏ
                                                    </button>
                                                </div>
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
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-sm-12">
                                    <div class="title-tab col-12">
                                        <h3>Đặc điểm nổi bật</h3>
                                    </div>
                                    <h5 style="text-align: left;" align="center"><span><?php echo $product_name ?> hướng đến đối tượng nào?</span></h5>
                                    <img class="w-100 mt-3 mb-3" src="../../public/img/products/product_detail.jpg" alt="">
                                    <p class="d-block" style="font-family:'Times New Roman', Times, serif;">Với thiết kế sang trọng, kiểu dáng thanh lịch màn hình chuyên biệt, độ sáng cao, màu sắc chân thực sống động cùng với hiệu năng mới mẻ và cực kì mạnh mẽ từ vi xử lý AMD 7000 mới nhất hiện nay. Sự kết hợp hoàn hảo và cực kì tuyệt vờ cho những ai có công việc liên quan đến thiết kế hình ảnh hay đồ họa cao cấp. Nghe đến đây mọi người đã thấy ưng ý chưa ạ, hãy cùng LaptopAZ đi tìm hiểu chi tiết về chiếc laptop này ngay thôi nào!</p>
                                </div>
                                <div class="col-md-4 col-sm-12">
                                    <div class=" pl-0">
                                        <div class="title-tab">
                                            <h3>Thông số kỹ thuật</h3>
                                        </div>
                                        <div class="pro-parameter">
                                            <div class="prodetail-spec-full" style="font-size: 11px;font-family: Times New Roman;">

                                                <p><span style="color: #0000ff; font-family: arial, helvetica, sans-serif; font-size: 10pt;"><strong>Thông số kỹ thuật <?php echo $product_name ?></strong></span></p>
                                                <table class="table table-striped table-bordered" style="height: 270px; float: left;" width="262">
                                                    <tbody>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>CPU</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">AMD Ryzen 5-7530U (2.00GHz up to 4.50GHz, 19MB Cache)</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>RAM</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">16GB LPDDR4-3200MHz</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Ổ cứng</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">512GB NVMe PCIe Gen3x4 SSD</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Card VGA</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">AMD Radeon Graphics</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Màn hình</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">14 inch FHD(1920 x 1080) IPS-Level</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Webcam</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">720p HD</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Cổng kết nối</strong></span></td>
                                                            <td scope="row">
                                                                <p><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">1 x Type-C USB3.2 Gen2 with PD charging</span></p>
                                                                <p><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">1 x Type-A USB3.2 Gen2</span></p>
                                                                <p><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">2 x Type-A USB2.0</span></p>
                                                                <p><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">1 x&nbsp;HDMI™ 2.1 (4K @ 60Hz)</span></p>
                                                                <p><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">1 x Mic-in/Headphone-out Combo Jack</span></p>
                                                                <p><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">1 x Micro SD</span></p>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Trọng lượng</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">1.4kg</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Pin</strong></span></td>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">3Cell 39Whrs</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td scope="row"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;"><strong>Hệ điều hành</strong></span></td>
                                                            <td scope="row"><span style="font-size: 8pt; font-family: arial, helvetica, sans-serif;">Windows 11 bản quyền</span></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                                <div id="eJOY__extension_root" class="eJOY__extension_root_class" style="all: unset;"><span style="font-family: arial, helvetica, sans-serif; font-size: 8pt;">&nbsp;</span></div>

                                                <a href="javascript:;" data-fancybox="" data-src="#box_product-spec" class="view-full mt-2">Xem cấu hình chi tiết</a>
                                            </div>

                                        </div>
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
    <style>
        .card-img-detail {
            max-width: 350px;
           min-width:350px;
        }
    </style>