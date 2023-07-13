<?php
require_once 'Conecting.php';
$pdo = get_pdo();

function get_all_brands()
{
    global $pdo;

    $sql = "SELECT * FROM brands";
    $stmt = $pdo->prepare($sql);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    $brand_list = array();

    // Lặp kết quả
    foreach ($result as $row) {
        $brand_list[] = array(
            'id' => $row['brand_id'],
            'name' => $row['brand_name'],
            'country' => $row['brand_country'],
            'date' => $row['brand_nsx'],

        );
    }

    return $brand_list;
}

function insert_brand($name, $date, $country)
{
    global $pdo;
    $sql = "INSERT INTO brands(brand_name, brand_country, brand_nsx) VALUES(:name, :country, :date)";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':date', $date);
        $stmt->execute();

        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi thêm hãng.');
        }
    } catch (Exception $e) {
        header('Location: ../view/inc/error_insert.php');
        exit;
    }
}


function get_brand($brand_id)
{
    global $pdo;

    $sql = "SELECT * FROM brands WHERE brand_id=:id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $brand_id);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);

    // Lấy danh sách kết quả
    $result = $stmt->fetchAll();

    // Lặp kết quả
    foreach ($result as $row) {
        return array(
            'id' => $row['brand_id'],
            'name' => $row['brand_name'],
            'country' => $row['brand_country'],
            'date' => $row['brand_nsx']

        );
    }
    return null;
}
function update_brand($id, $name, $date, $country)
{
    global $pdo;
    $sql = "UPDATE brands SET brand_name=:name, brand_country=:country, brand_nsx=:date WHERE brand_id=:id";
    try {
        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':country', $country);
        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        echo '<script>';
        echo 'alert("Cập nhật thành công");';
        echo '</script>';
        if ($stmt->rowCount() === 0) {
            throw new Exception('Lỗi cập nhật hãng.');
        }
    } catch (Exception $e) {
        header('Location: ../view/inc/error_insert.php');
        exit;
    }
}



function delete_brands($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM brands WHERE brand_id IN ($placeholders)";
    try {
        $stmt = $pdo->prepare($sql);
        if ($stmt) {
            if ($stmt->execute($ids)) {
                return $stmt->rowCount();
            }
        }
        throw new Exception('Lỗi xóa hãng.'); // Ném ngoại lệ nếu có lỗi xảy ra
    } catch (Exception $e) {
        header('Location: ../view/inc/error_delete.php');
        exit;
    }
}
