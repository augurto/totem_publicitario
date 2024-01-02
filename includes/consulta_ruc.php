<?php
$documento = $_POST['documento'];
$token = 'apis-token-6245.wt-VO39h1kYcilm8CMcL-WdJ6p7C-J-s';

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.apis.net.pe/v2/sunat/ruc?numero=$documento",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'GET',
    CURLOPT_HTTPHEADER => array(
        'Authorization: Bearer ' . $token
    ),
));

$response = curl_exec($curl);

curl_close($curl);

$data = json_decode($response, true);

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
