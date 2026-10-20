<?php
header('Content-Type: application/json');

// 1. Recibir mensaje del frontend
$input = json_decode(file_get_contents('php://input'), true);
$userMessage = $input['message'] ?? '';

if (empty($userMessage)) {
    echo json_encode(['reply' => 'Por favor escribe un mensaje.']);
    exit;
}

// 2. Configuración de API Key y Endpoint con el modelo dinámico activo
$apiKey = 'AQ.Ab8RN6IKBjnKWzRpk-aBmB6RGgvP0ajiLUxeTFtn7OdwATVSDA'; // Coloca tu API Key que empieza con AIzaSy...
$url = "https://generativelanguage.googleapis.com/v1beta/models/gemini-flash-latest:generateContent?key=" . $apiKey;

$data = [
    "contents" => [
        [
            "role" => "user",
            "parts" => [
                ["text" => "Eres un asistente virtual de D' Events Catering. Responde de forma amable y concisa sobre eventos: " . $userMessage]
            ]
        ]
    ]
];

// 3. Petición cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

// Descomenta la siguiente línea si trabajas en localhost (XAMPP/WAMP) y cURL falla por certificado SSL:
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);

$response = curl_exec($ch);
$curlError = curl_error($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(['reply' => 'Error de conexión cURL: ' . $curlError]);
    exit;
}

$responseData = json_decode($response, true);

// 4. Manejo de errores de la API
if (isset($responseData['error'])) {
    echo json_encode(['reply' => 'Error API Gemini: ' . $responseData['error']['message']]);
    exit;
}

// 5. Respuesta final
$reply = $responseData['candidates'][0]['content']['parts'][0]['text'] ?? 'Lo siento, no pude procesar la respuesta.';

echo json_encode(['reply' => $reply]);