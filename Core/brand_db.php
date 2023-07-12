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
    $sql = "INSERT INTO brands(brand_name, brand_country,brand_nsx) VALUES(:name, :country,:date)";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':date', $date);
    $stmt->execute();
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
    $sql = "UPDATE brands SET brand_name=:name, brand_country=:country  ,brand_nsx=:date WHERE brand_id=:id";
    $stmt = $pdo->prepare($sql);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':country', $country);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}

class BrandModel {
    public function deleteBrands($ids) {
        try {
            $pdo = get_pdo();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Escape the IDs to prevent SQL injection
            $escapedIds = array_map(function ($id) use ($pdo) {
                return $pdo->quote($id);
            }, $ids);

            // Create the comma-separated list of IDs
            $idList = implode(',', $escapedIds);

            // Delete the selected items
            $query = "DELETE FROM brands WHERE brand_id IN ($idList)";
            $stmt = $pdo->prepare($query);
            $stmt->execute();

            // Check if any rows were affected
            $rowCount = $stmt->rowCount();

            return $rowCount > 0;
        } catch (PDOException $e) {
            return false;
        }
    }
}

function delete_brands($ids)
{
    global $pdo;
    $placeholders = implode(',', array_fill(0, count($ids), '?'));
    $sql = "DELETE FROM brands WHERE brand_id IN ($placeholders)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute($ids);
    return $stmt->rowCount();
}
