
<header>
    <div class="container">
        <div class="navbar align-items-center justify-content-between ">
            <div class=" navbar__logo">
                <a href="home.php"><img alt="laptopaz.com chuyên laptop cũ, bán laptop cũ uy tín Hà Nội và toàn quốc" src="../../public/img/icons/icon.png" class="img-fluid"></a>
            </div>
            <div class="navbar__cart align-items-center  flex-column ">
                <i class="bi bi-cart3 "></i>
                <a href="">Giỏ hàng</a>
                <span class="cart-quantity-counter" id="count_shopping_cart_store">0</span>
            </div>
            <div class=" navbar__search-form ">
                <div class="input-group ">
                    <input type="search" class="form-control rounded" placeholder="Bạn muốn tìm kiếm gì..." aria-label="Search" aria-describedby="search-addon" />
                    <button type="button" class="btn "><i class="bi bi-search"></i></button>
                </div>
            </div>
            <div class=" navbar__hotline align-items-center  flex-column hide-mobile hide-tablet ">
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
                            // Nếu có session username thì hiển thị nút Logout
                            echo '<a href="logout.php" class="nav-item nav-link me-4"><i class="bi bi-door-closed-fill"></i>Đăng xuất</a>';
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
</header>