<?php
$host     = 'localhost';
$port     = '5432';
$db       = 'eventos_db';
$user     = 'postgres';
$password = '123*asd'; // Cambia por tu contraseña de Postgres

$dsn = "pgsql:host=$host;port=$port;dbname=$db;";

try {
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]);
} catch (PDOException $e) {
    header('Content-Type: application/json');
    echo json_encode([
        'status'  => 'error',
        'message' => 'Error de conexión a PostgreSQL: ' . $e->getMessage()
    ]);
    exit;
}