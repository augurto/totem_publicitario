<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Recibir datos del formulario
$para = mysqli_real_escape_string($con, $_POST['para']);
$asunto = mysqli_real_escape_string($con, $_POST['asunto']);
$mensaje = mysqli_real_escape_string($con, $_POST['area']);

// Procesar archivo adjunto
$nombreArchivo = $_FILES['adjunto']['name'];
$rutaArchivo = "archivos_email/" . $nombreArchivo;

// Mover el archivo al directorio de destino
move_uploaded_file($_FILES['adjunto']['tmp_name'], $rutaArchivo);

// Insertar datos en la base de datos
$sql = "INSERT INTO mensajes (para, asunto, mensaje, archivo_adjunto) VALUES ('$para', '$asunto', '$mensaje', '$nombreArchivo')";

if (mysqli_query($con, $sql)) {
    echo "Mensaje enviado y almacenado en la base de datos con éxito";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>
