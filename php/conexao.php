<?php

ini_set('display_errors', 1);
error_reporting(E_ALL);

$database_url = getenv('DATABASE_URL');

if ($database_url) {
  
    $url_parts = parse_url($database_url);
    
    $host = $url_parts['host'];
    $user = $url_parts['user'];
    $pass = $url_parts['pass'];
    $db   = ltrim($url_parts['path'], '/');
    $port = $url_parts['port'];

} else {
   
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