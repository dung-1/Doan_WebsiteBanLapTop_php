<?php
define('DB_NAME', 'doanwebsite');
define('DB_USER', 'root');
define('DB_USER_PASS', 'Hung0976661824');

function get_pdo(){
    $pdo = null;
    try {
        $pdo = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_USER_PASS);     
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    } 
    catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
    }

    return $pdo;
}
