<?php
// Obtener los datos enviados desde el formulario
$idCliente = $_POST['idCliente'];
$tipoCliente = $_POST['tipoCliente'];
$prospecto = $_POST['prospecto'];
$observacion = $_POST['observacion'];
$idid = $_POST['idid'];
$iduser = $_POST['iduser'];

// Realizar la inserción en la base de datos (aquí debes adaptarlo a tu estructura y lógica de base de datos)
// ...

// Enviar una respuesta al cliente
echo 'Datos guardados correctamente';
?>
