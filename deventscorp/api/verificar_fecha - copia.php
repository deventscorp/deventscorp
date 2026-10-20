<?php
header('Content-Type: application/json');
require_once '../config/conexion.php';

$fecha    = $_GET['fecha'] ?? '';
$locacion = $_GET['locacion'] ?? '';

if (empty($fecha) || empty($locacion)) {
    echo json_encode(['disponible' => false, 'error' => 'Parámetros incompletos']);
    exit;
}

try {
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM reservas WHERE fecha_evento = ? AND locacion = ? AND estado = 'bloqueado'");
    $stmt->execute([$fecha, $locacion]);
    $conteo = (int)$stmt->fetchColumn();

    echo json_encode(['disponible' => ($conteo === 0)]);

} catch (PDOException $e) {
    echo json_encode(['disponible' => false, 'error' => $e->getMessage()]);
}