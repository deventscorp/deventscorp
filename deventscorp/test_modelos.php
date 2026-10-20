<?php
// Coloca tu API Key real
$apiKey = 'AQ.Ab8RN6IKBjnKWzRpk-aBmB6RGgvP0ajiLUxeTFtn7OdwATVSDA'; 

$url = "https://generativelanguage.googleapis.com/v1beta/models?key=" . $apiKey;

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
// curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Descomenta si usas XAMPP en local

$response = curl_exec($ch);
curl_close($ch);

header('Content-Type: application/json');
echo $response;