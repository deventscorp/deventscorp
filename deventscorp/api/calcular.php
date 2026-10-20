<?php
header('Content-Type: application/json');
require_once '../config/conexion.php';

$input = json_decode(file_get_contents('php://input'), true);

$invitados      = (int)($input['invitados'] ?? 0);
$tiempos        = (int)($input['tiempos_comida'] ?? 1);
$barra_libre    = !empty($input['barra_libre']);
$costo_locacion = (float)($input['costo_locacion'] ?? 0);

if ($invitados <= 0) {
    echo json_encode(['status' => 'error', 'message' => 'El número de invitados debe ser mayor a 0']);
    exit;
}

// Lógica de cálculo
$precio_plato = ($tiempos === 1) ? 15 : (($tiempos === 2) ? 22 : 30);
$subtotal_comida = $invitados * $precio_plato;
$costo_barra = $barra_libre ? ($invitados * 10) : 0;
$total = $costo_locacion + $subtotal_comida + $costo_barra;

try {
    // En PostgreSQL usaremos RETURNING id para obtener el valor recién insertado
    $sql = "INSERT INTO cotizaciones (invitados, tiempos_comida, barra_libre, costo_locacion, total_estimado) 
            VALUES (?, ?, ?, ?, ?) RETURNING id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $invitados, 
        $tiempos, 
        $barra_libre ? 'true' : 'false', 
        $costo_locacion, 
        $total
    ]);
    
    $cotizacion_id = $stmt->fetchColumn();

    echo json_encode([
        'status' => 'success',
        'cotizacion_id' => $cotizacion_id,
        'resumen' => [
            'invitados' => $invitados,
            'subtotal_comida' => number_format($subtotal_comida, 2, '.', ''),
            'costo_barra' => number_format($costo_barra, 2, '.', ''),
            'total_estimado' => '$' . number_format($total, 2, '.', '')
        ]
    ]);

} catch (PDOException $e) {
    echo json_encode(['status' => 'error', 'message' => 'Error SQL: ' . $e->getMessage()]);
}