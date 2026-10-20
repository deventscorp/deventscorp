<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

require_once '../config/conexion.php';

$input = json_decode(file_get_contents('php://input'), true);

$nombre        = trim($input['nombre'] ?? '');
$email         = trim($input['email'] ?? '');
$celular       = trim($input['celular_cliente'] ?? ''); // Recibir celular
$fecha         = $input['fecha'] ?? '';
$locacion      = $input['locacion'] ?? '';
$cotizacion_id = !empty($input['cotizacion_id']) ? (int)$input['cotizacion_id'] : null;

if (empty($nombre) || empty($email) || empty($fecha) || empty($locacion)) {
    echo json_encode(['status' => 'error', 'message' => 'Faltan datos obligatorios para la reserva.']);
    exit;
}

try {
    // Insertar en PostgreSQL

    $stmt = $pdo->prepare("INSERT INTO reservas (cliente_nombre, cliente_email, cliente_celular, fecha_evento, locacion, cotizacion_id, estado) VALUES (?, ?, ?, ?, ?, ?, 'bloqueado')");
    $stmt->execute([$nombre, $email, $celular, $fecha, $locacion, $cotizacion_id]);

    // Envío por PHPMailer
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'rdiaz@mba3.com';
    $mail->Password   = 'pqsc bpjs vwvq lnfb';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port       = 587;
    $mail->CharSet    = 'UTF-8';

    $mail->setFrom('rdiaz@mba3.com', 'Luxury Events');
    $mail->addAddress($email, $nombre);
    $mail->addReplyTo('rdiaz@mba3.com', 'Atención al Cliente');

    $mail->isHTML(true);
    $mail->Subject = 'Confirmación de Reserva - Luxury Events';

    $id_str       = htmlspecialchars((string)($cotizacion_id ?? 'N/A'));
    $nombre_clean = htmlspecialchars($nombre);
    $celular_clean  = htmlspecialchars($celular !== '' ? $celular : 'No proporcionado');
    $locacion_clean = htmlspecialchars($locacion);
    $fecha_clean  = htmlspecialchars($fecha);

    $mail->Body = "
        <h2>¡Hola, {$nombre_clean}!</h2>
        <p>Hemos registrado con éxito tu solicitud de bloqueo de fecha en PostgreSQL.</p>
        <ul>
            <li><strong>Locación:</strong> {$locacion_clean}</li>
            <li><strong>Fecha:</strong> {$fecha_clean}</li>
            <li><strong>N° Cotización:</strong> #{$id_str}</li>
            <li><strong>Teléfono de Contacto:</strong> {$celular_clean}</li>
        </ul>
        <p>Nos pondremos en contacto contigo a la brevedad.</p>
    ";
    $mail->AltBody = "Hola {$nombre},\nHemos registrado tu solicitud para {$locacion} el día {$fecha}. N° Cotización: #{$id_str}";

    $mail->send();

    echo json_encode([
        'status' => 'success',
        'message' => 'Reserva guardada en PostgreSQL y correo de confirmación enviado correctamente.'
    ]);

} catch (Exception $e) {
    echo json_encode([
        'status' => 'warning',
        'message' => 'La reserva se guardó en PostgreSQL, pero falló el envío del correo: ' . $mail->ErrorInfo
    ]);
} catch (PDOException $e) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Error de base de datos PostgreSQL: ' . $e->getMessage()
    ]);
}