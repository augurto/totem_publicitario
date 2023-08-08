<?php

// Datos de tu aplicación en Slack
$slackToken = 'xoxb-16060872976-5733378532096-ME5NLPxqlG7UDjsMx0jguCKM';  // Reemplaza con tu token de acceso
$channel = 'C05LF94CS07';  // Reemplaza con el ID del canal de destino
$message = 'tada';  // El mensaje que deseas enviar

// Construye los datos para la solicitud POST
$data = http_build_query([
    'token' => $slackToken,
    'channel' => $channel,
    'text' => $message,
]);

// Configura la solicitud HTTP POST
$options = [
    'http' => [
        'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
        'method' => 'POST',
        'content' => $data,
    ],
];

// Realiza la solicitud HTTP POST
$context = stream_context_create($options);
$response = file_get_contents('https://slack.com/api/chat.postMessage', false, $context);

// Procesa la respuesta (puede ser en formato JSON)
if ($response) {
    $responseData = json_decode($response, true);
    if ($responseData['ok']) {
        echo 'Mensaje enviado exitosamente.';
    } else {
        echo 'Error al enviar el mensaje: ' . $responseData['error'];
    }
} else {
    echo 'Error al realizar la solicitud.';
}
?>
