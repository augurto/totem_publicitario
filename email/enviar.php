<?php
// Incluir el archivo de conexión
include('conexion.php');

// Establecer la zona horaria a "America/Lima"
date_default_timezone_set('America/Lima');

// Recibir datos del formulario
$para = mysqli_real_escape_string($con, $_POST['para']);
$asunto = mysqli_real_escape_string($con, $_POST['asunto']);
$mensaje = mysqli_real_escape_string($con, $_POST['area']);

// Procesar archivo adjunto
$nombreArchivo = $_FILES['adjunto']['name'];
$rutaArchivo = "archivos_email/" . $nombreArchivo;

// Mover el archivo al directorio de destino
move_uploaded_file($_FILES['adjunto']['tmp_name'], $rutaArchivo);

// Obtener la fecha y hora actual de Perú
$fechaEnvio = date('Y-m-d H:i:s');

// Insertar datos en la base de datos
$sql = "INSERT INTO mensajes (para, asunto, mensaje, archivo_adjunto, fecha_envio) 
        VALUES ('$para', '$asunto', '$mensaje', '$nombreArchivo', '$fechaEnvio')";

if (mysqli_query($con, $sql)) {
    echo "Mensaje enviado y almacenado en la base de datos con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>
