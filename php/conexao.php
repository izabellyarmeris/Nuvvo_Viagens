<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$host = getenv('MYSQLHOST');
$db   = getenv('MYSQLDATABASE');
$user = getenv('MYSQLUSER');
$pass = getenv('MYSQLPASSWORD');
$port = getenv('MYSQLPORT');


if (empty($host)) {
    $host = '127.0.0.1';
    $db   = 'nuvvo_db';
    $user = 'root';
    $pass = '';
    $port = '3306';
}

$charset = 'utf8mb4';
$dsn = "mysql:host=$host;port=$port;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    error_log("DATABASE CONNECTION ERROR: " . $e->getMessage());
    die("Desculpe, estamos com problemas técnicos. Tente novamente mais tarde.");
}
?>