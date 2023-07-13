    <?php include_once '../view/inc/headerAdmin.php' ?>

    <!--ADD BRAND-->
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Hãng Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="../brand/insert_Brand.php" method="POST" onsubmit="return validateForm()">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Hãng Sản Phẩm</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Nhập Quốc Gia</label>
                            <input type="text" name="country" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label>Ngày Thành Lập</label>
                            <input type="date" name="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" name="insertdata" class="btn btn-primary">Thêm Dữ Liệu</button>
                    </div>
                </form>



            </div>
        </div>
    </div>

    <!-- EDIT PRODUCT -->
    <div class="modal fade" id="editmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> cập Nhật Hãng LapTop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../brand/edit_Brand.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Hãng Sản Phẩm</label>
                            <input type="text" name="name" id="name" class="form-control" onkeypress="validateInput(event)" required>
                        </div>
                        <div class="form-group">
                            <label>Nhập Quốc Gia</label>
                            <input type="text" name="country" id="country" class="form-control" onkeypress="validateInput(event)" required>
                        </div>
                        <div class="form-group">
                            <label>Ngày Thành Lập</label>
                            <input type="date" name="date" id="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                        <button type="submit" class="btn btn-primary">Cập Nhật</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hãng Sản Phẩm</h1>
                    </div>

                </div>
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- /.card -->
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary" data-toggle="modal" data-target="#studentaddmodal"> <i class="fa-sharp fa-solid fa-circle-plus"></i> Thêm Dữ Liệu</button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="../brand/delete_Brand.php">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                                <th>ID Hãng</th>
                                                <th>Tên Hãng</th>
                                                <th>Quốc Gia</th>
                                                <th>Ngày Thành Lập</th>
                                                <th>Sửa</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($brand_list as $category) : ?>
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="checkbox " name="delete[]" value="<?php echo $category['id']; ?>"></td>
                                                    <td class="td"><?php echo $category['id']; ?></td>
                                                    <td class="td"><?php echo $category['name']; ?></td>
                                                    <td class="td"><?php echo $category['country']; ?></td>
                                                    <td class="td"><?php echo $category['date']; ?></td>
                                                    <td>
                                                        <a class="btn btn-warning editbtn" data-toggle="modal" data-target="#editmodal"> <i class="fa-solid fa-pen-to-square"></i> Sửa</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                    <button type="submit" id="delete-selected" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i> Xóa Được Chọn</button>
                                </form>

                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
   




    </script>
    <script>
        function validateInput(event) {
            var input = event.target.value;
            var regex = /^[a-zA-Z\s]*$/;

            if (!regex.test(input)) {
                event.preventDefault();
            }
        }
    </script>
    <?php include_once '../view/inc/footerAdmin.php' ?>