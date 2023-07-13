    <?php include_once '../view/inc/headerAdmin.php' ?>


    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class=" text-center">Thêm Sản Phẩm</h1>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-12">
                        <!-- jquery validation -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title text-center">Hệ Thống Bán Lap Top</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="../product/create_Product.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label>Tên Sản Phẩm</label>
                                        <input type="text" name="name" id="name" class="form-control" placeholder="Nhập Tên Sản Phẩm" required >
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Loại sản phẩm:</label>
                                        <select name="category" id="category" class="form-control">
                                            <?php
                                            // Truy vấn để lấy danh sách các loại sản phẩm từ cơ sở dữ liệu

                                            $sql = "SELECT * FROM categories";
                                            $stmt = $pdo->query($sql);

                                            // Kiểm tra kết quả truy vấn
                                            if ($stmt->rowCount() > 0) {
                                                // Lặp qua từng hàng dữ liệu
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // Hiển thị tên loại sản phẩm trong combobox
                                                    echo '<option value="' . $row["category_id"] . '">' . $row["category_name"] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">Không có loại sản phẩm</option>';
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Hãng sản phẩm:</label>
                                        <select name="brand" id="brand" class="form-control">
                                            <?php
                                            // Truy vấn để lấy danh sách các loại sản phẩm từ cơ sở dữ liệu

                                            $sql = "SELECT * FROM brands";
                                            $stmt = $pdo->query($sql);

                                            // Kiểm tra kết quả truy vấn
                                            if ($stmt->rowCount() > 0) {
                                                // Lặp qua từng hàng dữ liệu
                                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    // Hiển thị tên loại sản phẩm trong combobox
                                                    echo '<option value="' . $row["brand_id"] . '">' . $row["brand_name"] . '</option>';
                                                }
                                            } else {
                                                echo '<option value="">Không có loại sản phẩm</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá Sản Phẩm</label>
                                        <input type="number" name="price" id="price" class="form-control" placeholder="Nhập giá Sản Phẩm" onkeypress="validateNumberInput(event)" required>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá Sale</label>
                                        <input type="number" name="discounted" id="discounted" class="form-control" placeholder="Nhập giá Sale" onkeypress="validateNumberInput(event)" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Hình ảnh</label>
                                        <input type="file" name="image" id="image" class="form-control"  required>
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Thông Tin Sản Phẩm</label>
                                        <textarea id="compose-textarea" name="info" class="form-control" required>

                                             </textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary">Làm Mới</button>
                                    <button type="submit" class="btn btn-primary">Thêm Dữ Liệu</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-6">

                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <script>
        function validateNumberInput(event) {
            var input = event.target.value;
            var regex = /^[0-9]*$/;

            if (!regex.test(input)) {
                event.preventDefault();
            }
        }
    </script>
    <?php include_once '../view/inc/footerAdmin.php' ?>