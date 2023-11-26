<?php
// Recibir datos del webhook
$data = file_get_contents("php://input");

// Puedes procesar los datos según tus necesidades
// En este ejemplo, simplemente los imprimo
file_put_contents("webhook_data.txt", $data);

// Puedes realizar acciones adicionales aquí

?>
