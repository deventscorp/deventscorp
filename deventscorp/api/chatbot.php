<?php
// api/chatbot.php
header('Content-Type: application/json');
require_once '../config/conexion.php';

$data = json_decode(file_get_contents('php://input'), true);
$mensajeUsuario = trim($data['mensaje'] ?? '');

if (empty($mensajeUsuario)) {
    echo json_encode(['status' => 'error', 'message' => 'Mensaje vacío']);
    exit;
}

// 1. Guardar mensaje del usuario en PostgreSQL 9.1
$sqlUser = "INSERT INTO chat_historial (rol, mensaje) VALUES ($1, $2)";
pg_query_params($dbconn, $sqlUser, array('user', $mensajeUsuario));

// 2. Generar respuesta (Regla de negocio o integración de IA)
$respuestaIA = "Gracias por contactarnos. Para eventos de ese estilo, te sugiero calcular tu cotización en nuestro panel principal e incluir la barra libre.";

if (stripos($mensajeUsuario, 'hola') !== false) {
    $respuestaIA = "¡Hola! Bienvenido a nuestra plataforma. ¿En qué tipo de evento estás pensando hoy?";
} elseif (stripos($mensajeUsuario, 'descuento') !== false || stripos($mensajeUsuario, 'precio') !== false) {
    $respuestaIA = "Nuestros precios son ajustables según el volumen de invitados. Prueba modificando el número de invitados en el cotizador.";
}

// 3. Guardar la respuesta del asistente
$sqlBot = "INSERT INTO chat_historial (rol, mensaje) VALUES ($1, $2)";
pg_query_params($dbconn, $sqlBot, array('assistant', $respuestaIA));

echo json_encode([
    'status' => 'success',
    'respuesta' => $respuestaIA
]);
?>