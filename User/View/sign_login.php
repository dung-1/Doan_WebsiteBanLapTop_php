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
            <form action="../View/xuLyLoginPage.php" class="login__form" id="login-in" method="POST">
                <div>
                    <h1 class="login__title">
                        <span>Đăng Nhập</span>
                    </h1>
                </div>

                <div>
                    <div class="login__inputs">
                        <div>
                            <label for="" class="login__label">Tên Tài Khoản</label>
                            <input type="text" name="username" placeholder="Nhập Tên Tài Khoản" required class="login__input" />
                        </div>

                        <div>
                            <label for="" class="login__label">Mật Khẩu</label>

                            <div class="login__box">
                                <input type="password" name="password" placeholder="Nhập mật khẩu" required class="login__input" id="input-pass" />
                                <i class="ri-eye-off-line login__eye" id="input-icon"></i>
                            </div>
                        </div>
                    </div>

                    <div class="login__check">
                        <input type="checkbox" class="login__check-input" />
                        <label for="" class="login__check-label">Đồng ý với mọi điều khoản</label>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="login__button">Đăng Nhập</button>
                        <button class="login__button login__button-ghost" id="sign-up"> Đăng Ký </button>
                    </div>
                    <?php
                    $forgotPasswordPage = "send_mail_check.php";
                    ?>
                    <a href="<?php echo $forgotPasswordPage; ?>" class="login__forgot">Bạn Quên Mật Khẩu? Bấm ngay</a>
                </div>
            </form>
            <form action="" class="signup__form none" id="login-up" method="Post">
                <div>
                    <h1 class="login__title">
                        <span>Đăng Ký</span>
                    </h1>
                </div>

                <div>
                    <div class="__inputs">
                        <div>
                            <label for="" class="login__label">Tên Tài Khoản</label>
                            <input type="text" name="username" class="login__input sign__input " required placeholder=" Nhập tên tài khoản"/>
                        </div>
                        <div>
                            <label for="" class="login__label">Mật Khẩu</label>
                            <div class="login__box">
                                <input type="password" name="password" placeholder=" Nhập mật khẩu" required class="login__input sign__input " id="input-pass" />
                            </div>
                        </div>
                        <div>

                            <label for="" class="login__label">Họ Và Tên</label>
                            <input type="text" name="full_name" required class="login__input sign__input " placeholder=" Nhập họ và tên" />
                        </div>
                        <div>
                            <label for="" class="login__label">Số Điện Thoại</label>
                            <input type="number" name="phone" required class="login__input sign__input " placeholder=" Nhập số điện thoại" />
                        </div>

                        <div>
                            <label for="" class="login__label">Email</label>
                            <input type="email" name="email" id="emailInput" required class="login__input sign__input " placeholder=" vd: username@gmail.com"/>
                        </div>
                        <div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="login__buttons">
                        <button type="submit" class="sign__button">Đăng Ký</button>
                        <button class="sign__button login__button-ghost" id="sign-in">
                            Đăng Nhập
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!--=============== MAIN JS ===============-->
    <script src="js/sign_login.js"></script>
</body>

</html>