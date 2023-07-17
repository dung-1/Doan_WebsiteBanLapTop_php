<?php
session_start();
if (isset($_SESSION['username'])) {
    // Kiểm tra vai trò của người dùng và điều hướng tới các trang phù hợp
    if ($_SESSION['role'] == 'admin') {
        header('location: ../../Admin/index.php');
        exit();
    } else if ($_SESSION['role'] == 'customer') {
        header('location: user.php');
        exit();
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Link_thuvien -->
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">

    <!-- link_css -->
    <link rel="stylesheet" href="css/hover.css">
    <link rel="stylesheet" href="../View/css/reponsive.css">
    <link rel="stylesheet" href="../View/css/home.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        .is-invalid {
            border-color: red;
        }
    </style>
</head>

<body>
    <?php include 'header.php'; ?>
    <div class="login-form">
        <form action="../model/xuLyRegisterPage.php" method="post" onsubmit="return validateForm() && validateUsername() && checkUsernameExist()">
            <section class="vh-80">
                <div class="container py-5 h-20">
                    <div class="row d-flex justify-content-center align-items-center h-80">
                        <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                            <div class="card  text-white" style="border-radius: 0.5rem;background-color: #2b80dd;">
                                <div class="card-body p-5 text-center">

                                    <div class="pb-5">

                                        <h2 class="fw-bold mb-2 text-uppercase">ĐĂNG KÝ</h2>
                                        <p class="text-white-30 mb-5">Vui lòng nhập đầy đủ thông tin</p>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label d-flex" for="typeEmailX">Tên tài khoản</label>
                                            <input type="text" class="form-control form-control-xl" name="username" id="username" placeholder="Nhập tên tài khoản của bạn..." onblur="validateUsername()" />
                                            <div id="usernameError" class="invalid-feedback"></div>
                                        </div>

                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label d-flex " for="typePasswordX">Mật khẩu</label>
                                            <input type="password" class="form-control form-control-xl" name="password" id="password" placeholder="Nhập mật khẩu của bạn..." onblur="validateField('password')" />
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label d-flex " for="typePasswordX">Họ và tên</label>
                                            <input type="text" class="form-control form-control-xl" name="full_name" id="full_name" placeholder="Nhập họ và tên..." onblur="validateField('full_name')" />
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label d-flex " for="typePasswordX">Số điện thoại</label>
                                            <input type="tel" class="form-control form-control-xl" name="phone" id="phone" placeholder="Nhập số điện thoại..." onblur="validateField('phone')" />
                                        </div>
                                        <div class="form-outline form-white mb-4">
                                            <label class="form-label d-flex " for="typePasswordX">Email</label>
                                            <input type="email" class="form-control form-control-xl" name="email" id="emailInput" placeholder="Nhập email..." onblur="validateField('email')" />
                                        </div>

                                        <button class="btn btn-outline-light btn-lg px-5 mb-3" type="submit">ĐĂNG KÝ</button>

                                        <div class="d-flex justify-content-center text-center">
                                            <a href="#!" class="text-white"><i class="bi bi-facebook"></i></a>
                                            <a href="#!" class="text-white"><i class="bi bi-youtube"></i></a>
                                            <a href="#!" class="text-white"><i class="bi bi-tiktok"></i></a>
                                        </div>
                                    </div>
                                    <div>
                                        <?php $signup = "loginPage.php";   ?>
                                        <p class="mb-0">you have an account? <a href="<?php echo $signup; ?>" class="text-white-50 fw-bold">Login</a>
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

    <script>
        var isFieldBlurred = {
            username: false,
            password: false,
            full_name: false,
            phone: false,
            email: false
        };
        var isUsernameValid = false;

        function validateUsername() {
            var username = document.getElementById("username").value;
            var usernameError = document.getElementById("usernameError");

            if (username.length < 8 || username.length > 32) {
                usernameError.textContent = "Tên tài khoản phải từ 8-32 ký tự.";
                usernameError.classList.add("invalid-feedback");
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Tên tài khoản phải từ 8-32 ký tự',
                    confirmButtonText: 'Đóng'
                });
                return false;
            } else {
                usernameError.textContent = "";
                usernameError.classList.remove("invalid-feedback");
                isUsernameValid = true;
                checkUsernameExist();
                return true;
            }
        }


        function checkUsernameExist() {
            if (!isUsernameValid) {
                return;
            }

            var username = document.getElementById("username").value;
            var usernameError = document.getElementById("usernameError");

            // Gửi yêu cầu AJAX đến file xử lý và nhận kết quả trả về
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.exists) {
                            // Username đã tồn tại, hiển thị thông báo lỗi
                            Swal.fire({
                                icon: 'error',
                                title: 'Lỗi',
                                text: 'Tên tài khoản đã tồn tại !!!',
                                confirmButtonText: 'Đóng'
                            });
                            usernameError.classList.add("invalid-feedback");
                            document.getElementById("username").classList.add("is-invalid");
                            isUsernameValid = false; // Đặt lại giá trị của biến isUsernameValid thành false
                        } else {
                            // Username không tồn tại, xóa thông báo lỗi
                            usernameError.textContent = "";
                            usernameError.classList.remove("invalid-feedback");
                            document.getElementById("username").classList.remove("is-invalid");
                            isUsernameValid = true; // Đặt lại giá trị của biến isUsernameValid thành true
                        }
                    } else {
                        console.error("Error:", xhr.status);
                    }
                }
            };
            xhr.open("POST", "../model/check_username.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.send("username=" + encodeURIComponent(username));
        }


        function validateField(fieldName) {
            isFieldBlurred[fieldName] = true;
            validateForm();
        }

        function validateForm() {
            var username = document.getElementById("username");
            var password = document.getElementById("password");
            var fullName = document.getElementById("full_name");
            var phone = document.getElementById("phone");
            var email = document.getElementById("emailInput");

            if (isFieldBlurred.username && !isUsernameValid) {
                username.classList.add('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Tên tài khoản phải từ 8-32 ký tự',
                    confirmButtonText: 'Đóng'
                });
                return false;
            } else {
                username.classList.remove('is-invalid');
            }

            if (isFieldBlurred.password && (password.value.length < 6 || password.value.length > 24 || password.value.includes(" "))) {
                password.classList.add('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Mật khẩu phải từ 6-24 ký tự và không chứa khoảng trắng',
                    confirmButtonText: 'Đóng'
                });
                return false;
            } else {
                password.classList.remove('is-invalid');
            }

            if (isFieldBlurred.full_name && fullName.value.trim() === "") {
                fullName.classList.add('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập họ và tên',
                    confirmButtonText: 'Đóng'
                });
                return false;
            } else {
                fullName.classList.remove('is-invalid');
            }

            if (isFieldBlurred.phone && (phone.value.length !== 10 || isNaN(phone.value) || !isValidPhone(phone.value))) {
                phone.classList.add('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Số điện thoại không hợp lệ, phải bắt đầu bằng "084"',
                    confirmButtonText: 'Đóng'
                });
                return false;
            } else {
                phone.classList.remove('is-invalid');
            }

            if (isFieldBlurred.email && !isValidEmail(email.value)) {
                email.classList.add('is-invalid');
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập đúng định dạng email',
                    confirmButtonText: 'Đóng'
                });
                return false;
            } else {
                email.classList.remove('is-invalid');
            }
            if (username.value.trim() === "" && password.value.trim() === "" && fullName.value.trim() === "" && phone.value.trim() === "" && email.value.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Vui lòng nhập đầy đủ thông tin',
                    confirmButtonText: 'Đóng'
                });
                return false;
            }
            return true;
        }

        function isValidPhone(phone) {
            var validPhonePrefixes = [
                "084" //vn
            ];
            var prefix = phone.substr(0, 3);
            return validPhonePrefixes.includes(prefix);
        }

        function isValidEmail(email) {
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
    </script>
    
</body>

</html>