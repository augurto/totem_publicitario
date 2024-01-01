<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Establecer la zona horaria a "America/Lima"
date_default_timezone_set('America/Lima');

// Recibir datos del formulario
$para = mysqli_real_escape_string($con, $_POST['para']);
$asunto = mysqli_real_escape_string($con, $_POST['asunto']);
$mensaje = mysqli_real_escape_string($con, $_POST['area']);

// Obtener la fecha y hora actual de Perú
$fechaEnvio = date('Y-m-d H:i:s');

// Insertar datos en la base de datos
$sql = "INSERT INTO mensajes (para, asunto, mensaje, fecha_envio) 
        VALUES ('$para', '$asunto', '$mensaje', '$fechaEnvio')";

if (mysqli_query($con, $sql)) {
    // Obtener el ID del último mensaje insertado
    $idMensaje = mysqli_insert_id($con);

    // Procesar archivo adjunto
    $nombreArchivo = $_FILES['adjunto']['name'];
    $carpetaDestino = "archivos_email/" . $idMensaje . "/";
    $rutaArchivo = $carpetaDestino . $nombreArchivo;

    // Crear la carpeta del mensaje si no existe
    if (!is_dir($carpetaDestino)) {
        mkdir($carpetaDestino, 0777, true);
    }

    // Mover el archivo al directorio de destino
    move_uploaded_file($_FILES['adjunto']['tmp_name'], $rutaArchivo);

    echo "Mensaje enviado y almacenado en la base de datos con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>
