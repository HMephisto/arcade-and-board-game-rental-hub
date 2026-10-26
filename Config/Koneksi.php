<?php
$host = "localhost";
$nama_db = "arcade_rental";
$username = "root";
$password = "";
$dsn = "mysql:host=" . $host . ";dbname=" . $nama_db . ";charset=utf8";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}