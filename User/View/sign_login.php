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
            <form action="../model/sendmail.php" class="signup__form none" id="login-up" method="post" onsubmit="return validateForm()">
                <div>
                    <h1 class="login__title">
                        <span>Đăng Ký</span>
                    </h1>
                </div>

                <div>
                    <div class="__inputs">
                        <div>
                            <label for="username" class="login__label">Tên Tài Khoản</label>
                            <input type="text" name="username" id="username" class="login__input sign__input" required placeholder="Nhập tên tài khoản" />
                        </div>
                        <div>
                            <label for="password" class="login__label">Mật Khẩu</label>
                            <div class="login__box">
                                <input type="password" name="password" id="password" placeholder="Nhập mật khẩu" required class="login__input sign__input" />
                            </div>
                        </div>
                        <div>

                            <label for="full_name" class="login__label">Họ Và Tên</label>
                            <input type="text" name="full_name" id="full_name" required class="login__input sign__input" placeholder="Nhập họ và tên" />
                        </div>
                        <div>
                            <label for="phone" class="login__label">Số Điện Thoại</label>
                            <input type="tel" name="phone" id="phone" required class="login__input sign__input" placeholder="Nhập số điện thoại" />
                        </div>

                        <div>
                            <label for="emailInput" class="login__label">Email</label>
                            <input type="email" name="email" id="emailInput" required class="login__input sign__input" placeholder="vd: username@gmail.com" />
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

            <script>
    // Mảng chứa các đầu số điện thoại hợp lệ
    var validPhonePrefixes = [
        "030", "032", "033", "034", "035", "036", "037", "038", "039", // Viettel
        "070", "079", // Viettel, Mobifone, Vinaphone, Vietnamobile
        "090", "093", "089", // Mobifone
        "081", "082", "083", "084", "085", "086", "087", "088", // Vinaphone
        "092", // Vietnamobile
        "056", "058", // Vietnamobile
        "059", // Gmobile (Beeline)
        "087" // Itelecom
    ];

    function validateForm() {
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;
        var fullName = document.getElementById("full_name").value;
        var phone = document.getElementById("phone").value;
        var email = document.getElementById("emailInput").value;

        if (username.length < 8 || username.length > 32) {
            alert("Tên tài khoản phải từ 8-32 ký tự");
            return false;
        }

        if (password.length < 6 || password.length > 24 || password.includes(" ")) {
            alert("Mật khẩu phải từ 6-24 ký tự và không chứa khoảng trắng");
            return false;
        }

        if (fullName.trim() === "") {
            alert("Vui lòng nhập họ và tên");
            return false;
        }

        if (phone.length !== 10 || isNaN(phone) || !isValidPhone(phone)) {
            alert("Số điện thoại không hợp lệ");
            return false;
        }

        if (!isValidEmail(email)) {
            alert("Vui lòng nhập đúng định dạng email");
            return false;
        }

        return true;
    }

    function isValidPhone(phone) {
        // Kiểm tra số điện thoại bằng cách so sánh với các đầu số hợp lệ
        var prefix = phone.substr(0, 3);
        return validPhonePrefixes.includes(prefix);
    }

    function isValidEmail(email) {
        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
</script>


        </div>
    </div>

    <!--=============== MAIN JS ===============-->
</body>

<script src="js/sign_login.js"></script>

</html>