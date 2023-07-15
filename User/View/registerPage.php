<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Link_thuvien -->
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">

    <!-- link_css -->
    <link rel="stylesheet" href="../View/css/reponsive.css">
    <link rel="stylesheet" href="../View/css/home.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="login-form">
    <form action="../model/sendmail.php" method="post" onsubmit="return validateForm()" >
        <section class="vh-80">
            <div class="container py-5 h-20">
                <div class="row d-flex justify-content-center align-items-center h-80">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg text-white" style="border-radius: 0.5rem;">
                            <div class="card-body p-5 text-center">

                                <div class="pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">ĐĂNG Ký</h2>
                                    <p class="text-white-30 mb-5">Vui nhập đầy đủ thông tin</p>
                                    
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex" for="typeEmailX">Tên tài khoản</label>
                                        <input type="text" class="form-control form-control-xl" name="username" id="username" placeholder="Nhập tên tài khoản của bạn..." />
                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex " for="typePasswordX">Mật khẩu</label>
                                        <input type="password"  class="form-control form-control-xl" name="password" id="password" placeholder="Nhập mật khẩu của bạn..." />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex " for="typePasswordX">Họ và tên</label>
                                        <input type="text"  class="form-control form-control-xl" name="full_name" id="full_name" placeholder="Nhập họ và tên..." />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex " for="typePasswordX">số điện thoại</label>
                                        <input type="tel"  class="form-control form-control-xl" name="phone" id="phone" placeholder="Nhập số điện thoại..." />
                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex " for="typePasswordX">email</label>
                                        <input type="email"  class="form-control form-control-xl" name="email" id="emailInput" placeholder="Nhập email..." />
                                    </div>

                                    <!-- Checkbox -->
                                   

                                    <button class="btn btn-outline-light btn-lg px-5 mb-3" type="submit">ĐĂNG KÝ</button>

                                    <div class="d-flex justify-content-center text-center">
                                        <a href="#!" class="text-white"><i class="bi bi-facebook"></i></a>
                                        <a href="#!" class="text-white"><i class="bi bi-youtube"></i></a>
                                        <a href="#!" class="text-white"><i class="bi bi-tiktok"></i></a>
                                    </div>
                                </div>
                                <div>
                                    <?php $signup="loginPage.php";   ?>
                                    <p class="mb-0">youhave an account? <a href="<?php echo $signup; ?>" class="text-white-50 fw-bold">Login</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    </div>
    <?php include 'footer.php'; ?>
</body>
<style>
    .bg {
        background-color: #2b80dd;
    }
</style>
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

</html>