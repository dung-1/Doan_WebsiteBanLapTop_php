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
<<<<<<< HEAD
    echo json_encode(array('success' => true, 'message' => 'Sản phẩm đã được thêm vào giỏ hàng.'));
    exit();
=======
    if (isset($_SESSION['username']) && !empty($_SESSION['username'])) {
        $username = $_SESSION['username'];

        // Chuỗi URL chứa tham số 'success' với tên người dùng được mã hóa
        $url = "cart.php?success=" . urlencode($username);

        // Chuyển hướng người dùng đến trang cart.php với tham số 'success' chứa tên người dùng
        header("Location: " . $url);
        exit; // Chắc chắn dừng thực hiện mã sau khi chuyển hướng
    } else {
        // Trường hợp không có tên người dùng được lưu trong biến $_SESSION['username']
        // Xử lý tùy ý ở đây, ví dụ: chuyển hướng người dùng đến trang đăng nhập
        header("Location: login.php");
        exit; // Chắc chắn dừng thực hiện mã sau khi chuyển hướng
    }
>>>>>>> 42411b443ef6ddd00fa9ac2d8f9b264dcc274b2e
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
                echo json_encode(array('success' => true, 'message' => 'Sản phẩm đã được xóa khỏi giỏ hàng.'));
                exit();
            }
        }
    }
}

// Xử lý cập nhật số lượng sản phẩm trong giỏ hàng
if (isset($_POST["update_cart"])) {
    $new_cart_data = array();
    if (isset($_COOKIE["shopping_cart"])) {
        $cookie_data = stripslashes($_COOKIE['shopping_cart']);
        $cart_data = json_decode($cookie_data, true);
        foreach ($cart_data as $keys => $values) {
            $item_id = $values['item_id'];
            if (isset($_POST['item_quantity_' . $item_id])) {
                $item_quantity = $_POST['item_quantity_' . $item_id];
                $values['item_quantity'] = $item_quantity;
            }
            $new_cart_data[] = $values;
        }
        $item_data = json_encode($new_cart_data);
        setcookie('shopping_cart', $item_data, time() + (86400 * 30));
        echo json_encode(array('success' => true, 'message' => 'Giỏ hàng đã được cập nhật.'));
        exit();
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
            <h2><i class="bi bi-basket2 fs-3"></i>Giỏ hàng </h2>
            <hr>
            <?php
            // Hiển thị sản phẩm trong giỏ hàng
            if (isset($_COOKIE["shopping_cart"])) {
                $total = 0;
                $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                $cart_data = json_decode($cookie_data, true);
                if (!empty($cart_data)) {
            ?>
                    <form method="post">
                        <table class="table table-bordered cart-table">
                            <thead>
                                <tr>
                                    <th width="5%">STT</th>
                                    <th width="45%">Sản phẩm</th>
                                    <th width="10%">Số lượng</th>
                                    <th width="20%">Giá</th>
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
                                            <input type="number" class="form-control item-quantity" name="item_quantity_<?php echo $values["item_id"]; ?>" value="<?php echo $item_quantity; ?>" min="1">
                                        </td>
                                        <td class="item-price"><?php echo number_format($item_price, 0); ?>đ</td>
                                        <td class="item-total"><?php echo number_format($item_total, 0); ?>đ</td>

                                        <td>
                                            <a href="#" class="btn-outline-danger btn btn-remove-item p-1" data-item-id="<?php echo $values["item_id"]; ?>"><i class="bi bi-trash3-fill"></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                                <tr>
                                    <td class="fs-4" colspan="4" align="right"><strong>Tổng cộng</strong></td>
                                    <td class="fs-4 text-danger fw-bold" id="cart-total" colspan="2"><?php echo number_format($total, 0); ?> đ</td>
                                </tr>
                            </tbody>
                        </table>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary" name="update_cart"><i class="bi bi-cart4"></i>Cập nhật giỏ hàng</button>
                        </div>
                    </form>
            <?php
                } else {
                    echo '<p>Không có sản phẩm trong giỏ hàng</p>';
                }
            } else {
                echo '<p>Không có sản phẩm trong giỏ hàng</p>';
            }
            ?>

            <div class="text-center mt-4">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#emailModal"><i class="bi bi-receipt"></i>Thanh Toán</button>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="emailModalLabel"> Thông Tin Thanh Toán</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Họ và Tên Người Nhận</label>
                                <input type="text" class="form-control" name="user_name" placeholder="Nhập Tên">
                            </div>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Email</label>
                                <input type="email" class="form-control" id="emailInput" placeholder="Nhập địa chỉ email">
                            </div>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Số Điện Thoại </label>
                                <input type="tel" class="form-control" name="phone" placeholder="Nhập Tên">
                            </div>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Địa chỉ(số nhà/huyện(Phường),tỉnh(Tp))</label>
                                <input type="text" class="form-control" name="addres" placeholder="Nhập Tên">
                            </div>
                            <div class="mb-3">
                                <label for="emailInput" class="form-label">Phương Thức Thanh Toán</label>
                                <select class="form-select text-capitalize" name="pay" aria-label="Default select example">
                                    <option selected>Chọn phương thức thanh toán</option>
                                    <option value="1">Chuyển Tiền Qua Momo</option>
                                    <option value="2">Chuyển Tiền Qua Thẻ</option>
                                    <option value="3">Thanh Toán Khi Nhận hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Đóng</button>
                            <button type="button" class="btn btn-success buyshop" id="sendInvoiceButton" data-bs-toggle="modal">Thanh Toán</button>
                        </div>
                    </div>
                </div>
            </div>

            
        </div>
    </main>
    <!-- Trước khi kết thúc thẻ </body> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            // Xử lý sự kiện khi click vào nút "Đồng ý mua"
            $(".buyshop").click(function() {
                // Thực hiện gửi Ajax để lưu thông tin đơn hàng
                $.ajax({
                    url: "save_invoice.php", // Đường dẫn đến tệp xử lý lưu đơn hàng
                    type: "POST",
                    data: {}, // Bạn có thể truyền dữ liệu từ trang này qua Ajax nếu cần thiết
                    success: function(response) {
                        // Xử lý phản hồi từ tệp xử lý lưu đơn hàng (nếu cần)
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // Xử lý lỗi (nếu có)
                        console.error(error);
                    }
                });
            });
        });
    </script>

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
                    removeItemFromCart(itemId);
                }
            });
        });

        // Kiểm tra xem thông báo thành công có tồn tại hay không
        var successMessage = document.getElementById('successMessage');
        if (successMessage) {
            // Đặt một độ trễ để loại bỏ thông báo thành công sau 3 giây
            setTimeout(function() {
                successMessage.remove();
            }, 3000);
        }

        function removeItemFromCart(itemId) {
            var xhr = new XMLHttpRequest();
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        alert(response.message);
                        location.reload(); // Tải lại trang để reset giỏ hàng
                    } else {
                        alert('Đã xảy ra lỗi khi xóa sản phẩm khỏi giỏ hàng');
                    }
                }
            };
            xhr.open('GET', 'cart.php?id=' + itemId, true);
            xhr.send();
        }

        // cập nhật giỏ hàng
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
    });
</script>

</html>
