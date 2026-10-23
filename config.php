<?php
// config.php - Conexión PDO a MySQL en XAMPP
$host   = 'localhost';
$dbname = 'workshop1';       // cambia si usaste otro nombre
$user   = 'root';
$pass   = '';                // en XAMPP por defecto vacío
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    die('Error de conexión: ' . $e->getMessage());
}