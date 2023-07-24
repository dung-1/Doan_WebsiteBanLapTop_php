<?php
session_start();
if (isset($_SESSION['username'])) {
    if ($_SESSION['role'] == 'admin') {
        header('location: ../../Admin/index.php');
        exit();
    } else if ($_SESSION['role'] == 'customer') {
        header('location:user.php');
        exit();
    }
} else {
    $_SESSION['previous_page'] = $_SERVER['REQUEST_URI'];
}


?>

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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php include 'header.php'; ?>
    <div class="login-form">
    <form action="../model/send_mail_check.php" method="post" onsubmit="return validateForm()">
        <section class="vh-80">
            <div class="container py-5 h-20">
                <div class="row d-flex justify-content-center align-items-center h-80">
                    <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                        <div class="card text-white" style="border-radius: 0.5rem;background-color: #2b80dd;">
                            <div class="card-body p-5 text-center">

                            <div class="pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Kiểm Tra Tài Khoản</h2>
                                <p class="text-white-30 mb-5">Vui nhập mã xác minh</p>
                                
                                <div class="form-outline form-white mb-4">
                                    <label class="form-label d-flex" for="typeEmailX">Mã xác minh</label>
                                    <input type="text" class="form-control form-control-xl" name="confirmation_code" id="confirmation_code" placeholder="Nhập mã xác minh của bạn..." />
                                </div>
                               
                                <!-- Checkbox -->
                               

                                <button class="btn btn-outline-light btn-lg px-5 mb-3" type="submit">Xác Nhận</button>

                                <div class="d-flex justify-content-center text-center">
                                    <a href="#!" class="text-white"><i class="bi bi-facebook"></i></a>
                                    <a href="#!" class="text-white"><i class="bi bi-youtube"></i></a>
                                    <a href="#!" class="text-white"><i class="bi bi-tiktok"></i></a>
                                </div>

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
    function validateForm() {
        var confirmationCode = document.getElementById("confirmation_code").value;

        if (confirmationCode.trim() === "") {
            Swal.fire({
                icon: 'error',
                title: 'Lỗi',
                text: 'Vui lòng nhập mã xác minh',
                confirmButtonText: 'Đóng'
            });
            return false;
        }
        
        return true;
    }
</script>