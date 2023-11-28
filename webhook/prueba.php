<?php
// Recibir datos del webhook
$data = file_get_contents("php://input");
echo $data;

?>
