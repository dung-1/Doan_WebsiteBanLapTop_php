<?php
session_start();
include "../../Core/Conecting.php";
$conn = get_pdo();

if (!isset($_GET['search'])) {
    header('Location: user.php');
    exit();
}
$search_query = $_GET['search'];

$sql = "SELECT product_id, product_name, price, discounted_price, product_image, product_info FROM products WHERE product_name LIKE '%$search_query%'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tìm Kiếm</title>
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/reponsive.css">
    <link rel="stylesheet" href="css/home.css">
    <link rel="stylesheet" href="css/hover.css">
    <script src="js/jquery-1.8.3.min.js"></script>
    <script src="js/jquery.elevatezoom.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <style>
        .card {
            border: none;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }

        .card-title {
            font-size: 27px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .card-text {
            color: #555;
            margin-bottom: 10px;
        }

        .card-text.price {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .card-text.discount-price {
            color: red;
            font-weight: bold;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            font-weight: bold;
        }

        .btn-primary:hover {
            background-color: #0069d9;
            border-color: #0062cc;
        }

        .text-success {
            color: green;
            font-weight: bold;
        }

        .text-danger {
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <?php include "header.php" ?>

    <main>
        <div class="container">
            <?php if (empty($search_query)) : ?>
                <h5 class="mt-3 text-danger text-center fs-3">Vui lòng nhập từ khóa tìm kiếm!!!</h5>
            <?php else : ?>
                <h3 class="mt-3">Kết quả tìm kiếm cho <span class="text-danger">"<?php echo $search_query; ?>"</span></h3>
                <hr>

                <?php
                if ($result->rowCount() > 0) {
                    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                        $product_id = $row['product_id'];
                        $product_image = $row['product_image'];
                        $product_name = $row['product_name'];
                        $product_info = $row['product_info'];
                        $price = $row['price'];
                        $discounted_price = $row['discounted_price'];
                ?>
                        <div class="card mb-3">
                            <div class="row g-0">
                                <div class="col-md-4 hvr-buzz">
                                    <a href="product_detail.php?id=<?php echo $product_id; ?>">
                                        <img class="w-100" style="max-width:250px;" src="../../public/img/products/<?php echo $product_image; ?>" class="card-img-top" alt="Product Image">
                                    </a>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body" style="font-family:'Times New Roman', Times, serif;">
                                        <h2 class="card-title"><?php echo $product_name; ?></h2>
                                        <p class="card-text"><?php echo $product_info; ?></p>
                                        <?php if ($discounted_price) { ?>
                                            <p class="card-text price"><strike><?php echo number_format($price, 0, ',', '.'); ?> đ</strike></p>
                                            <p class="card-text price discount-price"><?php echo number_format($discounted_price, 0, ',', '.'); ?> đ</p>
                                        <?php } else { ?>
                                            <p class="card-text price">Price: <?php echo number_format($price, 0, ',', '.'); ?> đ</p>
                                        <?php } ?>
                                        <a href="product_detail.php?id=<?php echo $product_id; ?>" class="btn btn-primary mt-4">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                    }
                } else {
                    echo '<h5 class="text-danger">Không tìm thấy sản phẩm !!!</h5>';
                }
                ?>
            <?php endif; ?>
        </div>
    </main>

    <?php include "footer.php" ?>
</body>

</html>

<?php
$conn = null;
?>