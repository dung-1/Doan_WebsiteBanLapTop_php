<?php include_once '../view/inc/headerAdmin.php' ?>

    <!--ADD BRAND-->
    <div class="modal fade" id="studentaddmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm Loại Sản Phẩm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="../category/insert_Category.php" method="POST">

                    <div class="modal-body">
                        <div class="form-group">
                            <label> Tên Loại Sản Phẩm</label>
                            <input type="text" name="name" class="form-control">
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
                    <h5 class="modal-title" id="exampleModalLabel"> cập Nhật Loại LapTop</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="../category/edit_Category.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label>Tên Loại Sản Phẩm</label>
                            <input type="text" name="name" id="name" class="form-control">
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
                        <h1>Loại Sản Phẩm</h1>
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
                                <form method="POST" action="../category/delete_Category.php">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr class="text-center">
                                                <th><input type="checkbox" id="select-all"> Chọn Tất Cả</th>
                                                <th>ID Loại</th>
                                                <th>Tên Loại</th> 
                                                <th>Sửa</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $index = 0; ?>
                                            <?php foreach ($category_list as $category) : ?>
                                                <tr class="text-center">
                                                    <td><input type="checkbox" class="checkbox " name="delete[]" value="<?php echo $category['id']; ?>"></td>
                                                    <td class="td"><?php echo $category['id']; ?></td>
                                                    <td class="td"><?php echo $category['name']; ?></td>
                                                    <td>
                                                        <a class="btn btn-primary editbtn" data-toggle="modal" data-target="#editmodal">Edit</a>
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