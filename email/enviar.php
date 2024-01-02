<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Incluir la librería PHPMailer
use PHPMailer\PHPMailer;
use PHPMailer\SMTP;
use PHPMailer\Exception;


require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

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

    // Actualizar el nombre del archivo en la base de datos
    $sqlUpdateArchivo = "UPDATE mensajes SET archivo_adjunto = '$nombreArchivo' WHERE id = $idMensaje";
    mysqli_query($con, $sqlUpdateArchivo);

    // Enviar el correo
    try {
        // Crear una instancia de PHPMailer
        $mail = new PHPMailer(true);

        // Configurar el servidor de correo
        $mail->SMTPDebug = SMTP::DEBUG_OFF; // Puedes cambiar a DEBUG_SERVER para obtener más información
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ego.17.22@gmail.com';
        $mail->Password = 'yxpg decu fxnq egsv';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Configurar el remitente y destinatario
        $mail->setFrom('ego.17.22@gmail.com', 'Nombre del Remitente');
        $mail->addAddress($para);

        // Configurar el mensaje
        $mail->isHTML(true);
        $mail->Subject = $asunto;
        $mail->Body = $mensaje;

        // Adjuntar archivo si se ha seleccionado
        if ($_FILES['adjunto']['size'] > 0) {
            $mail->addAttachment($rutaArchivo, $nombreArchivo);
        }

        // Enviar el correo
        $mail->send();
        echo "Mensaje enviado y almacenado en la base de datos con éxito";
    } catch (Exception $e) {
        echo "Error al enviar el mensaje: {$mail->ErrorInfo}";
    }
} else {
    echo "Error al almacenar en la base de datos: " . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>
