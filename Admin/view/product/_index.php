<?php include_once '../view/inc/headerAdmin.php' ?>



<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Quản Lý Sản Phẩm</h1>
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
                            <button class="btn btn-primary "> <a class="text-light" href="<?php echo BASE_URL . '/Admin/product/create_Product.php'; ?> "><i class="fa-sharp fa-solid fa-circle-plus"></i> Thêm Dữ Liệu</a></button>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Trong view.php -->

                            <form method="POST" action="../product/delete_Product.php">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr class="text-center">
                                            <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                            <th>ID Sản Phẩm</th>
                                            <th>Tên Sản Phẩm</th>
                                            <th>Tên Loại</th>
                                            <th>Tên Hãng</th>
                                            <th>Giá</th>
                                            <th>Giá Giảm</th>
                                            <th>ảnh</th>
                                            <th>Thông Tin</th>
                                            <th>Sửa</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $index = 0; ?>
                                        <?php foreach ($product_list as $product) : ?>
                                            <tr class="text-center">
                                                <td><input type="checkbox" class="checkbox" name="delete[]" value="<?php echo $product['id']; ?>"></td>
                                                <td class="td"><?php echo $product['id']; ?></td>
                                                <td class="td"><?php echo $product['name']; ?></td>
                                                <td class="td"><?php echo $product['category']; ?></td>
                                                <td class="td"><?php echo $product['brand']; ?></td>
                                                <td class="td"><?php echo $product['price']; ?></td>
                                                <td class="td"><?php echo $product['discounted']; ?></td>
                                                <td><img src="<?php echo $product['image']; ?>" width="60" height="60" /></td>
                                                <td class="td"><?php echo $product['info']; ?></td>
                                                <td>
                                                    <a class="btn btn-warning" href="edit_Product.php?product_id=<?php echo $product['id']; ?>"><i class="fa-solid fa-pen-to-square"></i> Sửa</a>
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
<?php include_once '../view/inc/footerAdmin.php' ?>