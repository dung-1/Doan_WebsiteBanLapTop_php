    <?php include_once '../view/inc/headerAdmin.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Hóa Đơn</h1>
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
                         
                            <!-- /.card-header -->
                            <div class="card-body">
                                <form method="POST" action="../order_detail/delete_Order_detail.php">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                                <th>ID Chi Tiết HOá Đơn</th>
                                                <th>ID Hóa Đơn</th>
                                                <th>Tên Sản Phẩm</th>
                                                <th>Số Lượng</th>
                                                <th>Gía Sản Phẩm</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $index = 0; ?>
                                            <?php foreach ($order_detail_list as $order_detail) : ?>
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="checkbox " name="delete[]" value="<?php echo $order_detail['id']; ?>"></td>
                                                    <td class="td"><?php echo $order_detail['id']; ?></td>
                                                    <td class="td"><?php echo $order_detail['order_id']; ?></td>
                                                    <td class="td"><?php echo $order_detail['product_name']; ?></td>
                                                    <td class="td"><?php echo $order_detail['quantity']; ?></td>
                                                    <td class="td"><?php echo $order_detail['price']; ?></td>
                                                 
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

    <?php include_once 'C:/xampp/htdocs/Project-php-mysql/Admin/view/inc/footerAdmin.php' ?>