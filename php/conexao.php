<?php

$local_host = '127.0.0.1'; 
$local_db   = 'nuvvo_db'; 
$local_user = 'root';
$local_pass = '';


$host = getenv('MYSQLHOST') ?: $local_host;
$db   = getenv('MYSQLDATABASE') ?: $local_db;
$user = getenv('MYSQLUSER') ?: $local_user;
$pass = getenv('MYSQLPASSWORD') ?: $local_pass;
$port = getenv('MYSQLPORT') ?: '3306'; 

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
    error_log("Erro de Conexão com o Banco de Dados: " . $e->getMessage());
    die("Desculpe, estamos com problemas técnicos. Tente novamente mais tarde.");
}
?>