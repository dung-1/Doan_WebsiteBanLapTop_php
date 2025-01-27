<?php
// Khởi tạo giá trị mặc định cho biến $cart_count
$cart_count = 0;
?>

<header>
    <div class="container">
        <div class="navbar align-items-center justify-content-between">
            <div class="navbar__logo hvr-buzz">
                <a href="home.php"><img alt="laptopaz.com chuyên laptop cũ, bán laptop cũ uy tín Hà Nội và toàn quốc" src="../../public/img/icons/icon.png" class="img-fluid"></a>
            </div>

            

            <?php
            // Kiểm tra nếu người dùng đã đăng nhập
            $cart_count = 0;
            if (isset($_SESSION['username'])) {
                // Lấy số lượng sản phẩm trong giỏ hàng từ cookie
                if (isset($_COOKIE["shopping_cart"])) {
                    $cookie_data = stripslashes($_COOKIE['shopping_cart']);
                    $cart_data = json_decode($cookie_data, true);
                    $cart_count = count($cart_data);
                }
            ?>
            
                <div class="navbar__cart align-items-center  flex-column ">
                    <a href="cart.php"><i class="bi bi-cart-fill"></i></a>
                    <a href="cart.php">Giỏ hàng</a>
                    <span class="cart-quantity-counter" id="count_shopping_cart_store"><?php echo $cart_count; ?></span>
                </div>
            <?php
            } else {
            ?>
                <div class="navbar__cart align-items-center  flex-column ">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <a href="cart.php"><i class="bi bi-cart-fill"></i></a>
                        <a href="cart.php">Giỏ hàng</a>
                        <span class="cart-quantity-counter" id="count_shopping_cart_store"><?php echo $cart_count; ?></span>
                    <?php else : ?>
                        <a href="javascript:void(0)" onclick="showLoginAlert()"><i class="bi bi-cart-fill"></i></a>
                        <a href="javascript:void(0)" onclick="showLoginAlert()">Giỏ hàng</a>
                        <span class="cart-quantity-counter" id="count_shopping_cart_store"><?php echo $cart_count; ?></span>
                    <?php endif; ?>
                </div>

            <?php
            }
            ?>
            <div class="navbar__search-form">
                <form class="input-group" action="resultSearch.php" method="GET">
                    <input type="search" class="form-control rounded" name="search" placeholder="Bạn muốn tìm kiếm gì..." aria-label="Search" aria-describedby="search-addon" />
                    <button type="submit" class="btn"><i class="bi bi-search"></i></button>
                </form>
            </div>
            <div class="navbar__hotline align-items-center  flex-column hide-mobile hide-tablet">
                <p class="m-0 text-danger text-center">HOTLINE</p>
                <p>0825 233 233</p>
            </div>
        </div>
    </div>

    <!-- end_container -->
    <div class="menu">
        <nav class="navbar navbar-expand-lg">

            <div class="container-fluid">
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">

                    <i class="bi bi-list menu__toggler"></i>

                </button>
                <div class="collapse navbar-collapse container" id="navbarCollapse">

                    <div class="navbar-nav">

                        <a href="#" class="nav-item nav-link me-2"><i class="bi bi-laptop"></i> LAPTOP MỚI</a>

                        <a href="#" class="nav-item nav-link me-2"><i class="bi bi-windows"></i> SURFACE</a>

                        <a href="#" class="nav-item nav-link me-2"><i class="bi bi-laptop"></i> LAPTOP LIKE NEW</a>

                        <a href="#" class="nav-item nav-link me-2"><i class="bi bi-fire"></i> KHUYẾN MÃI</a>
                        <a href="#" class="nav-item nav-link me-2"><i class="bi bi-cash-coin"></i> TRẢ GÓP</a>

                    </div>

                    <div class="navbar-nav ms-auto">
                        <?php
                        if (isset($_SESSION['username'])) {
                            // Lấy user_id từ session
                            $user_id = $_SESSION['user_id'];
                            // Hiển thị "Chào 'username'" và nút Đăng xuất
                            echo '<span class="nav-item nav-link me-4 text-light">Chào ' . $_SESSION['username'] . ' <i class="bi bi-person-circle"></i></span>';
                            echo '<a href="logout.php" class="nav-item nav-link me-4" onclick="resetCart()"><i class="bi bi-door-closed-fill"></i> Đăng xuất</a>';
                        } else {
                            // Ngược lại hiển thị nút Đăng nhập và Đăng ký
                            echo '<a href="loginPage.php" class="nav-item nav-link me-4" data-toggle="modal" data-target="#modalLoginForm">
                <i class="bi bi-box-arrow-in-left"></i> Đăng nhập
            </a>
            <a href="registerPage.php" class="nav-item nav-link me-4"><i class="bi bi-box-arrow-right"></i> Đăng ký</a>';
                        }
                        ?>
                    </div>

                </div>

            </div>

        </nav>
    </div>
    <!-- end_menu -->
    <script>
        function showLoginAlert() {
            swal("Lỗi", "Bạn cần đăng nhập để xem giỏ hàng", "error");
        }

        function showBtnBuyAlert() {
            alert("Bạn cần đăng nhập để xem giỏ hàng !"); 
        }
    </script>
</header>