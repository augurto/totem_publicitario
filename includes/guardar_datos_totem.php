<?php
require_once 'conexion.php';

// Obtener los valores enviados desde el formulario
$name = $_POST['nombre'];
$email = $_POST['email'];
$phone = $_POST['telefono'];
$mensaje = $_POST['mensaje'];
$var1 = $_POST['utm_source'];
$var2 = $_POST['utm_medium'];
$var3 = $_POST['utm_campaign'];
// Establecer la zona horaria de Perú
date_default_timezone_set('America/Lima');

// Obtener la fecha y hora actual
$fechaHoraPeru = date('Y-m-d H:i:s');


// Consulta SQL para insertar los datos en la tabla
$query = "INSERT INTO formulario_totem (name, email, phone, mensaje, var1, var2, var3,fecha2)
          VALUES ('$name', '$email', '$phone', '$mensaje', '$var1', '$var2', '$var3', '$fechaHoraPeru')";

// Ejecutar la consulta
if (mysqli_query($con, $query)) {
    // Redireccionar a la página de agradecimiento
    header('Location: https://totempublicitario.com.pe/totem-publicitario/gracias/');
    exit; // Asegurar que se detiene la ejecución del script después de la redirección
} else {
    // Error al guardar los datos
    echo 'Error al guardar los datos: ' . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>