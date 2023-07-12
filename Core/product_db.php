<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_products()
{
    global $pdo;

    $sql = "SELECT p.*, c.category_name, b.brand_name
            FROM products p
            INNER JOIN categories c ON p.category_id = c.category_id
            INNER JOIN brands b ON p.brand_id = b.brand_id";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $product_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $product_list[] = array(
            'id' => $row['product_id'],
            'name' => $row['product_name'],
            'category' => $row['category_name'],
            'brand' => $row['brand_name'],
            'price' => $row['price'],
            'discounted' => $row['discounted_price'],
            'image' => $row['product_image'],
            'info' => $row['product_info'],
        );
    }

    return $product_list;
}


function insert_product($product_name, $category, $brand, $price, $discount_pice, $image, $info)
{
    global $pdo;
    $sql = "INSERT INTO products(product_name,category_id,brand_id ,price,discounted_price,product_image,product_info) VALUES(:name, :category,:brand,:price,:discounted,:image,:info)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $product_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':discounted', $discount_pice);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':info', $info);

    $stmt->execute();
}
function get_product($product_id)
{
    global $pdo;

    $sql = "SELECT p.*, c.category_id, c.category_name, b.brand_id, b.brand_name FROM products p
            JOIN categories c ON p.category_id = c.category_id
            JOIN brands b ON p.brand_id = b.brand_id
            WHERE p.product_id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $product_id);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    // Lặp kết quả
    foreach ($result as $row) {
        return array(
            'id' => $row['product_id'],
            'name' => $row['product_name'],
            'category_id' => $row['category_id'],
            'category_name' => $row['category_name'],
            'brand_id' => $row['brand_id'],
            'brand_name' => $row['brand_name'],
            'price' => $row['price'],
            'discounted_price' => $row['discounted_price'],
            'image' => $row['product_image'],
            'info' => $row['product_info'],
        );
    }
    return null;
}
function update_product($id, $product_name, $category, $brand, $price, $discount_price, $image, $info)
{
    global $pdo;
    $sql = "UPDATE products SET product_name=:product_name, category_id=:category, brand_id=:brand, price=:price, discounted_price=:discount_price, product_image=:product_image, product_info=:product_info WHERE product_id=:product_id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':product_name', $product_name);
    $stmt->bindParam(':category', $category);
    $stmt->bindParam(':brand', $brand);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':discount_price', $discount_price);
    $stmt->bindParam(':product_image', $image);
    $stmt->bindParam(':product_info', $info);
    $stmt->bindParam(':product_id', $id); 

    $stmt->execute();
}

// Trong model.php

function get_product_by_id($product_id)
{
    global $pdo;
    $sql = "SELECT * FROM products WHERE product_id = :product_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':product_id', $product_id);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// list cho loại và hãng sản phẩm
function list_options($pdo, $table_name, $id_field, $name_field, $id)
{
    $sql = "SELECT * FROM $table_name";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($result as $row) {
?>
        <option <?php if ($row[$id_field] == $id) {
                    echo "selected";
                } ?> value="<?php echo $row[$id_field]; ?>"><?php echo $row[$name_field]; ?></option>
<?php
    }
}
// Trong model.php

function delete_products($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM products WHERE product_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    return $stmt->rowCount();
}
