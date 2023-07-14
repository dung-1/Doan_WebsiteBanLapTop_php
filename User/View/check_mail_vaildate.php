<?php
session_start();

// Kiểm tra xem người dùng đã gửi yêu cầu kiểm tra hay chưa
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Lấy mật khẩu ngẫu nhiên đã lưu trữ trong phiên làm việc
    $randomPassword = $_SESSION['randomPassword'];

    // Kiểm tra xem người dùng đã nhập mật khẩu đúng hay chưa
    if ($_POST['password'] === $randomPassword) {
        // Mật khẩu đúng
        header("Location: ../View/change_password.php");
        exit();
            } else {
        // Mã Kiểm Tra sai
        header("Location: ../View/check_mail_vaildate.php");
        exit();
            }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="../View/css/sign_login.css" />

    <title>Form Đăng Ký - Đăng Nhập </title>
</head>

<body>
    <div class="container">
        <div class="login__content">
            <img src="../../public/img/icons/hinh-nen-4k-cho-laptop-phong-vu-4.jpg" alt="login image" class="login__img" />
            <form action="check_mail_vaildate.php" class="login__form" id="login-in" method="POST">
                <div>
                <h1 class="login__title">
                        <span>Kiểm Tra Tài Khoản </span>
                    </h1>
                </div>
                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="" class="login__label">Mã Kiểm Tra</label>
                            <input type="text" name="password" placeholder="Nhập mã kiểm tra của bạn" required class="login__input" />
                        </div>
                    </div>
                </div>
                <?php $forgotPasswordPage = "sign_login.php";
                ?>
                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Gửi</button>
                        <button class="login__button login__button-ghost"> <a style="text-decoration:none;" href="<?php echo $forgotPasswordPage; ?> "   >Đăng nhập</a></button>
            </form>

        </div>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="js/sign_login.js"></script>
</body>

</html>