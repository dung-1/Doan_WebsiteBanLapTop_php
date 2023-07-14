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
            <form action="" class="login__form" id="login-in" method="POST">
                <div>
                    <h1 class="login__title">
                        <span>Đổi Mật Khẩu</span>
                    </h1>
                </div>

                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="" class="login__label">Mật Khẩu Mới </label>
                            <input type="password" name="password" placeholder="Nhập mật khẩu" required class="login__input" id="input-pass" />
                        </div>

                        <div>
                            <label for="" class="login__label">Nhập Lại Mật Khẩu</label>

                            <div class="login__box">
                                <input type="password" name="password_confirm" placeholder="Nhập lại mật khẩu" required class="login__input" id="input-pass" />
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Xác Nhận</button>
                        <?php
                    $forgotPasswordPage = "sign_login.php";
                    ?>
                        <button class="login__button login__button-ghost" id="sign-up">  <a href="<?php echo $forgotPasswordPage; ?>" class="login__forgot">Đăng Nhập</a> </button>
                    </div>
                    
                </div>
            </form>
          
        </div>
    </div>
 
    <!--=============== MAIN JS ===============-->
    <script src="js/sign_login.js"></script>
</body>

</html>