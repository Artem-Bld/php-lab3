<?php
// db.php
$host = 'mysql-8.0';
$dbname = 'php_BALUEV';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Ошибка БД: " . $e->getMessage());
}
?>