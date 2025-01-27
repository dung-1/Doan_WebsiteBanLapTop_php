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
                                <form method="POST" action="../order/delete_Order.php">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                                <th>ID Hóa Đơn</th>
                                                <th>Tên Khách Hàng</th>
                                                <th>Ngày Mua</th>
                                                <th>Tổng Thanh Toán</th>
                                                <th>Trạng Thái</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $index = 0; ?>
                                            <?php foreach ($order_list as $order) : ?>
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="checkbox " name="delete[]" value="<?php echo $order['id']; ?>"></td>
                                                    <td class="td"><?php echo $order['id']; ?></td>
                                                    <td class="td"><?php echo $order['name']; ?></td>
                                                    <td class="td"><?php echo $order['date']; ?></td>
                                                    <td class="td"><?php echo $order['total_amount']; ?></td>
                                                    <td class="td"><?php echo $order['status']; ?></td>
                                                 
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

    <?php include_once '../view/inc/footerAdmin.php' ?>