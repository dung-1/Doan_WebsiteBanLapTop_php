<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header('location:../../Admin/index.php');
        exit();
    }
} else {
    header('location:../View/loginPage.php');
    exit();
}

include "../../Core/Conecting.php";

$conn = get_pdo();
$message = '';

// Xử lý thêm sản phẩm vào giỏ hàng
if (isset($_POST["add_to_cart"])) {
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
    } else {
        $cart_data = array();
    }

    $item_id_list = array_column($cart_data, 'item_id');

    if (in_array($_POST["hidden_id"], $item_id_list)) {
        foreach ($cart_data as $keys => $values) {
            if ($cart_data[$keys]["item_id"] == $_POST["hidden_id"]) {
                $cart_data[$keys]["item_quantity"] = $cart_data[$keys]["item_quantity"] + $_POST["quantity"];
            }
        }
    } else {
        $item_array = array(
            'item_id' => $_POST["hidden_id"],
            'item_name' => $_POST["hidden_name"],
            'item_price' => $_POST["hidden_price"],
            'item_quantity' => $_POST["quantity"]
        );
        $cart_data[] = $item_array;
    }

    $item_data = json_encode($cart_data);
    setcookie('shopping_cart', $item_data, time() + (86400 * 30));
    header("location:cart.php?success=1");
}

// Xử lý xóa sản phẩm khỏi giỏ hàng
if (isset($_GET["id"])) {
    $item_id = $_GET["id"];
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);

        foreach ($cart_data as $key => $value) {
            if ($cart_data[$key]["item_id"] == $item_id) {
                unset($cart_data[$key]);
                $item_data = json_encode($cart_data);
                setcookie('shopping_cart', $item_data, time() + (86400 * 30));
                header("location:cart.php");
            }
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/reponsive.css">
    <link rel="stylesheet" href="css/home.css">
</head>

<body>
    <?php require "header.php" ?>

    <main>
        <div class="container mt-4">
            <h2>Giỏ hàng</h2>

            <?php
            if (isset($_GET["success"])) {
                $message = '
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    Sản phẩm đã được thêm vào giỏ hàng
                </div>
                ';
                echo $message;
            }

            // Hiển thị sản phẩm trong giỏ hàng
            if (isset($_COOKIE["shopping_cart"])) {
                $total = 0;
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                if (!empty($cart_data)) {
            ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th width="5%">STT</th>
                                <th width="45%">Sản phẩm</th>
                                <th width="6%">Số lượng</th>
                                <th width="15%">Giá</th>
                                <th width="15%">Tổng</th>
                                <th width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            foreach ($cart_data as $keys => $values) {
                                $item_name = $values["item_name"];
                                $item_quantity = $values["item_quantity"];
                                $item_price = $values["item_price"];
                                $item_total = $item_quantity * $item_price;
                                $total += $item_total;
                            ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td><?php echo $item_name; ?></td>
                                    <td>
                                        <input type="number" class="form-control item-quantity" data-item-id="<?php echo $values["item_id"]; ?>" value="<?php echo $item_quantity; ?>" min="1">
                                    </td>
                                    <td class="item-price"><?php echo number_format($item_price, 2); ?></td>
                                    <td class="item-total"><?php echo number_format($item_total, 2); ?></td>
                                    <td>
                                        <a href="#" class="btn btn-danger btn-remove-item" data-item-id="<?php echo $values["item_id"]; ?>">Xóa</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                            <tr>
                                <td class="fs-4" colspan="4" align="right"><strong>Tổng cộng</strong></td>
                                <td class="fs-4 text-danger fw-bold" id="cart-total" colspan="2"><?php echo number_format($total, 2); ?></td>
                            </tr>
                        </tbody>
                    </table>
            <?php
                } else {
                    echo '<p>Không có sản phẩm trong giỏ hàng</p>';
                }
            } else {
                echo '<p>Không có sản phẩm trong giỏ hàng</p>';
            }
            ?>

            <div class="text-center mt-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#emailModal">In hóa đơn qua email</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailModalLabel">Nhập địa chỉ email</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Nhập địa chỉ email">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-primary" id="sendInvoiceButton">Gửi hóa đơn</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php require "footer.php" ?>
</body>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var itemQuantityInputs = document.querySelectorAll('.item-quantity');
        itemQuantityInputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                var itemId = input.getAttribute('data-item-id');
                var quantity = parseInt(input.value);
                if (quantity > 0) {
                    var itemPrice = parseFloat(input.closest('tr').querySelector('.item-price').innerText.replace(/,/g, ''));
                    var itemTotalElement = input.closest('tr').querySelector('.item-total');
                    var itemTotal = quantity * itemPrice;
                    itemTotalElement.innerText = formatCurrency(itemTotal);
                    updateCartTotal();
                } else {
                    input.value = 1;
                    alert('Số lượng phải lớn hơn 0');
                }
            });
        });

        function formatCurrency(amount) {
            return amount.toLocaleString('en-US', {
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });
        }
        var removeItemButtons = document.querySelectorAll('.btn-remove-item');
        removeItemButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                if (confirm('Bạn có chắc chắn muốn xóa sản phẩm này khỏi giỏ hàng?')) {
                    var itemId = button.getAttribute('data-item-id');
                    window.location.href = 'cart.php?id=' + itemId;
                }
            });
        });

        function updateCartTotal() {
            var itemTotals = document.querySelectorAll('.item-total');
            var total = 0;
            itemTotals.forEach(function(itemTotal) {
                var itemTotalValue = parseFloat(itemTotal.innerText.replace(/,/g, ''));
                total += itemTotalValue;
            });
            var cartTotalElement = document.getElementById('cart-total');
            cartTotalElement.innerText = formatCurrency(total);
        }

        var cartData = <?php echo isset($cart_data) ? json_encode($cart_data) : '[]'; ?>;

        var sendInvoiceButton = document.getElementById('sendInvoiceButton');
        sendInvoiceButton.addEventListener('click', function() {
            var emailInput = document.getElementById('emailInput');
            var email = emailInput.value.trim();
            if (email !== '') {
                var data = new FormData();
                data.append('mail', email);
                data.append('subject', 'Hóa đơn mua hàng');
                data.append('cart_data', JSON.stringify(cartData));
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'sendmail.php', true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        alert('Hóa đơn đã được gửi thành công');
                        location.reload(); // Tải lại trang để reset giỏ hàng
                    } else {
                        alert('Đã xảy ra lỗi khi gửi hóa đơn');
                    }
                };
                xhr.send(data);
            } else {
                alert('Vui lòng nhập địa chỉ email');
            }
        });


        function resetCart() {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = xhr.responseText;
                    if (response === 'success') {
                        location.reload(); // Tải lại trang để reset giỏ hàng
                    }
                }
            };
            xhr.send();
        }

    });
</script>

</html>