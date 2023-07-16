<?php include_once '../view/inc/headerAdmin.php' ?>

<!--ADD inventory-->
<div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm Kho Sản Phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="../inventory/insert_inventory.php" method="post" onsubmit="return validateForm()">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Tên Sản Phẩm</label>
                        <select name="product_id" id="product_id" class="form-control">
                            <?php
                            // Truy vấn để lấy danh sách các sản phẩm chưa tồn tại trong bảng kho
                            $sql = "SELECT * FROM products ";

                            $stmt = $pdo->query($sql);

                            // Kiểm tra kết quả truy vấn
                            if ($stmt->rowCount() > 0) {
                                // Lặp qua từng hàng dữ liệu
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    // Hiển thị tên sản phẩm trong combobox
                                    echo '<option value="' . $row["product_id"] . '">' . $row["product_name"] . '</option>';
                                }
                            } else {
                                echo '<option value="">Không có sản phẩm chưa tồn tại và chưa được lấy ra</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Ngày Nhập</label>
                        <input type="date" name="date" class="form-control" max="<?php echo date('Y-m-d'); ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Số Lượng</label>
                        <input type="number" name="quantity" class="form-control" required>
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

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kho Sản Phẩm</h1>
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
                            <form method="POST" action="../inventory/delete_inventory.php">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                            <th>ID Kho</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Ngày Nhập</th>
                                            <th>Số lượng</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($inventory_list as $inventory) : ?>
                                            <tr class="text-center">
                                                <td><input type="checkbox" class="checkbox " name="delete[]" value="<?php echo $inventory['id']; ?>"></td>
                                                <td class="td"><?php echo $inventory['id']; ?></td>
                                                <td class="td"><?php echo $inventory['product_name']; ?></td>
                                                <td class="td"><?php echo $inventory['date_add']; ?></td>
                                                <td class="td"><?php echo $inventory['quantity']; ?></td>
                                             
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