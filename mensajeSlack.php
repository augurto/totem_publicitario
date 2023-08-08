<?php
$token = "xoxb-16060872976-5733378532096-ME5NLPxqlG7UDjsMx0jguCKM";
$channel = "C05G7CUT2GG";
$message = "Hola, este es un mensaje enviado desde PHP.";

$data = array(
    'token' => $token,
    'channel' => $channel,
    'text' => $message
);

$options = array(
    'http' => array(
        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ),
);

$context  = stream_context_create($options);
$result = file_get_contents('https://slack.com/api/chat.postMessage', false, $context);

if ($result === FALSE) { 
    echo "Ha ocurrido un error al enviar el mensaje.";
} else {
    echo "Mensaje enviado correctamente.";
}
?>
