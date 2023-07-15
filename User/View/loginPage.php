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
    <title>Document</title>
    <!-- Link_thuvien -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="../../plugins/css/bootstrap.min.css">
    <script src="../../plugins/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="../../plugins/icons-1.10.5/font/bootstrap-icons.css">

    <!-- link_css -->
    <link rel="stylesheet" href="../View/css/reponsive.css">
    <link rel="stylesheet" href="../View/css/home.css">
</head>

<body>
    <?php include 'header.php'; ?>
    <form action="xuLyLoginPage.php" method="POST" onsubmit="return validateForm()">
        <section class="vh-80">
            <div class="container py-5 h-20">
                <div class="row d-flex justify-content-center align-items-center h-80">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card bg text-white" style="border-radius: 0.5rem;">
                            <div class="card-body p-5 text-center">

                                <div class="pb-5">

                                    <h2 class="fw-bold mb-2 text-uppercase">ĐĂNG NHẬP</h2>
                                    <p class="text-white-30 mb-5">Xin hãy nhập tài khoản và mật khẩu !</p>
                                    <?php if (isset($_SESSION['error'])) : ?>
                                        <script>
                                            Swal.fire({
                                                icon: 'error',
                                                title: '',
                                                text: '<?php echo $_SESSION['error']; ?>',
                                            });
                                        </script>
                                        <?php unset($_SESSION['error']); ?>
                                    <?php endif; ?>
                                    <?php if (isset($_SESSION['success'])) : ?>
                                        <script>
                                            Swal.fire({
                                                icon: 'success',
                                                title: '',
                                                text: '<?php echo $_SESSION['success']; ?>',
                                            });
                                        </script>
                                        <?php unset($_SESSION['success']); ?>
                                    <?php endif; ?>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex" for="typeEmailX">Tên tài khoản</label>
                                        <input type="text" class="form-control form-control-xl" name="username" id="username" placeholder="Nhập tên tài khoản của bạn..." />

                                    </div>

                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label d-flex " for="typePasswordX">Mật khẩu</label>
                                        <input type="password" id="password" class="form-control form-control-xl" name="password" id="password" placeholder="Nhập mật khẩu của bạn..." />

                                    </div>
                                    <!-- Checkbox -->
                                    <div class="form-check d-flex justify-content-start mb-4">
                                        <input class="form-check-input" type="checkbox" value="" id="form1Example3" />
                                        <label class="form-check-label px-2" for="form1Example3">Lưu mật khẩu </label>
                                    </div>
                                    <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Quên mật khẩu ?</a></p>

                                    <button class="btn btn-outline-light btn-lg px-5 mb-3" type="submit">ĐĂNG NHẬP</button>

                                    <div class="d-flex justify-content-center text-center">
                                        <a href="#!" class="text-white"><i class="bi bi-facebook"></i></a>
                                        <a href="#!" class="text-white"><i class="bi bi-youtube"></i></a>
                                        <a href="#!" class="text-white"><i class="bi bi-tiktok"></i></a>
                                    </div>

                                </div>

                                <div>
                                    <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a>
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </form>

    <?php include 'footer.php'; ?>
</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var countElement = document.getElementById('count_shopping_cart_store');
        countElement.innerText = '0';
        var countValue = 0;
    });

    function validateForm() {
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;

        if (username.trim() === '' || password.trim() === '') {
            Swal.fire({
                icon: 'warning',
                title: '',
                text: 'Vui lòng nhập đầy đủ thông tin!',
            });
            return false;
        }

        return true;
    }
</script>

</html>

<style>
    .bg {
        background-color: #2b80dd;
    }
</style>