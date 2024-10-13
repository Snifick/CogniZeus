<?php
header('Content-Type: application/json');

// Получение IP-адреса пользователя
$user_ip = $_SERVER['REMOTE_ADDR'];

// Используем cURL для запроса к API
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://ipapi.co/{$user_ip}/json/",
    CURLOPT_RETURNTRANSFER => true,
]);

$response = curl_exec($curl);
curl_close($curl);

$geo_data = json_decode($response, true);

// Логика обработки ответа
if ($geo_data && $geo_data['country'] === 'VN') {
    $result = ['response' => 'OK'];
} else {
    $result = ['response' => 'NOT OK', 'message' => "Country: " . $geo_data['country']];
}

echo json_encode($result);
?>