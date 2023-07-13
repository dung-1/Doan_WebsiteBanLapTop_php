<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_categories()
{
    global $pdo;

    $sql = "SELECT * FROM categories";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $category_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $category_list[] = array(
            'id' => $row['category_id'],
            'name' => $row['category_name'],
           

        );
    }

    return $category_list;
}

function insert_category($cate_name)
{
    global $pdo;
    $sql = "INSERT INTO categories(category_name) VALUES(:cate_name)";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':cate_name', $cate_name);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi thêm danh mục.');
        }
    } catch (Exception $e) {
        header('Location: ../view/inc/error_insert.php');
        exit;
    }
}

function get_category($category_id)
{
    global $pdo;

    $sql = "SELECT * FROM categories WHERE category_id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $category_id);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    // Lặp kết quả
    foreach ($result as $row) {
        return array(
            'id' => $row['category_id'],
            'name' => $row['category_name'],
 
        );
    }
    return null;
}
function update_category($id, $name)
{
    global $pdo;
    $sql = "UPDATE categories SET category_name=:name WHERE category_id=:id";
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi cập nhật danh mục.');
        }
    } catch (Exception $e) {
        header('Location: ../view/inc/error_insert.php');
        exit;
    }
}


function delete_categories($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM categories WHERE category_id IN ($placeholders)";
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt) {
            $stmt->execute($ids);
            return $stmt->rowCount();
        }
        throw new Exception('Lỗi xóa loại sản phẩm.'); // Ném ngoại lệ nếu có lỗi xảy ra
    } catch (Exception $e) {
        header('Location: ../view/inc/error_delete.php');
        exit;
    }
}
