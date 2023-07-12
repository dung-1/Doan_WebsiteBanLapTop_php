    <?php include_once '../view/inc/headerAdmin.php' ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Khách Hàng</h1>
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
                                <form method="POST" action="../customer/delete_customer.php">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                                <th>ID Khách Hàng</th>
                                                <th>Tên Khách Hàng</th>
                                                <th> Email</th>
                                                <th>Giới Tính</th>
                                                <th>Ngày Sinh</th>
                                                <th>Số Điện Thoại</th>
                                                <th>Tên Tài Khoản</th>
                                                <th>Mật Khẩu</th>

                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $index = 0; ?>
                                            <?php foreach ($customer_list as $customer) : ?>
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="checkbox " name="delete[]" value="<?php echo $customer['id']; ?>"></td>
                                                    <td class="td"><?php echo $customer['id']; ?></td>
                                                    <td class="td"><?php echo $customer['full_name']; ?></td>
                                                    <td class="td"><?php echo $customer['email']; ?></td>
                                                    <td class="td"><?php echo $customer['gender']; ?></td>
                                                    <td class="td"><?php echo $customer['birthdate']; ?></td>
                                                    <td class="td"><?php echo $customer['phone']; ?></td>
                                                    <td class="td"><?php echo $customer['user_name']; ?></td>
                                                    <td class="td"><?php echo str_repeat('*', strlen($customer['password'])); ?></td>
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