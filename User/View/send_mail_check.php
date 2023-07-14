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
            <form action="../model/sendmail.php" class="login__form" id="login-in" method="POST">
                <div>
                    <h4 class="login__title">
                        <span>  LẤY MÃ KIỂM TRA  </span>
                    </h4>
                </div>
                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="" class="login__label">Email</label>
                            <input type="mail" name="mail" placeholder="Nhập Email của bạn" required class="login__input" />
                        </div>
                    </div>
                </div>
                <?php $forgotPasswordPage = "sign_login.php";
                ?>
                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button" id="sign-up">Gửi</button>
                        <button class="login__button login__button-ghost"> <a style="text-decoration: none;" href="<?php echo $forgotPasswordPage; ?>">Đăng nhập</a></button>
            </form>

        </div>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="js/sign_login.js"></script>
</body>

</html>