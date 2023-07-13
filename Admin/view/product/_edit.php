    <?php include_once 'C:/xampp/htdocs/Project-php-mysql/Admin/view/inc/headerAdmin.php';

    $product_id = $_GET['product_id'];
    $product_list = get_product($product_id);

    ?>
    <?php
    $product_id = $_GET['product_id'];
    $sql = "SELECT * FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $category_id = $row['category_id'];
    $brand_id = $row['brand_id'];

    ?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1 class=" text-center">Sửa Sản Phẩm</h1>
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
                            <form action="../product/edit_Product.php" method="POST" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <input type="hidden" name="product_id" value="<?php echo isset($product_list['id']) ? $product_list['id'] : ''; ?>" />
                                    <div class="form-group">
                                        <label>Tên Sản Phẩm</label>
                                        <input type="text" required name="name" id="name" class="form-control" value="<?php echo isset($product_list['name']) ? $product_list['name'] : ''; ?>" />
                                    </div>
                                    <div class="form-group">
                                        <label for="category">Loại sản phẩm:</label>
                                        <select name="category" id="category" class="form-control">
                                            <?php list_options($pdo, 'categories', 'category_id', 'category_name', $category_id); ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="brand">Hãng sản phẩm:</label>
                                        <select name="brand" id="brand" class="form-control">
                                            <?php list_options($pdo, 'brands', 'brand_id', 'brand_name', $brand_id);
                                            ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Giá Sản Phẩm</label>
                                        <input type="number" required onkeypress="validateNumberInput(event)" name="price" id="price" class="form-control" placeholder="Nhập giá Sản Phẩm" value="<?php echo isset($product_list['price']) ? $product_list['price'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label>Giá Sale</label>
                                        <input type="number" required onkeypress="validateNumberInput(event)" name="discounted" id="discounted" class="form-control" placeholder="Nhập giá Sản Phẩm" value="<?php echo isset($product_list['discounted_price']) ? $product_list['discounted_price'] : ''; ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Hình ảnh</label>
                                        <input type="file" name="image" id="image" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="image">Thông Tin Sản Phẩm</label>
                                        <textarea id="compose-textarea" name="info" class="form-control" required><?php echo isset($product_list['info']) ? $product_list['info'] : ''; ?></textarea>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Cập Nhật</button>
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
    <?php include_once 'C:/xampp/htdocs/Project-php-mysql/Admin/view/inc/footerAdmin.php' ?>