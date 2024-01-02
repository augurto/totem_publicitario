<?php
// Incluir el archivo de conexión
include('../includes/conexion.php');

// Configuración de la cuenta de correo
$correo = 'ego.17.22@gmail.com';
$contrasena = 'yxpg decu fxnq egsv';

// Conectar al servidor IMAP de Gmail
$conexion = imap_open('{imap.gmail.com:993/ssl}INBOX', $correo, $contrasena);

if (!$conexion) {
    die('No se pudo conectar al servidor IMAP de Gmail: ' . imap_last_error());
}

// Obtener los mensajes no leídos
$mensajesNoLeidos = imap_search($conexion, 'UNSEEN', SE_UID, "UTF-8");

if ($mensajesNoLeidos) {
    foreach ($mensajesNoLeidos as $numeroMensaje) {
        // Obtener encabezado y cuerpo del mensaje
        $encabezado = imap_headerinfo($conexion, $numeroMensaje);
        $cuerpo = imap_fetchbody($conexion, $numeroMensaje, 1, FT_PEEK);

        // Procesar el encabezado y el cuerpo según tus necesidades
        $para = $encabezado->toaddress;
        $asunto = $encabezado->subject;
        $mensaje = $cuerpo;

        // Guardar en la base de datos
        $para = mysqli_real_escape_string($con, $para);
        $asunto = mysqli_real_escape_string($con, $asunto);
        $mensaje = mysqli_real_escape_string($con, $mensaje);

        $fechaEnvio = date('Y-m-d H:i:s');

        $sql = "INSERT INTO mensajes (para, asunto, mensaje, fecha_envio) 
                VALUES ('$para', '$asunto', '$mensaje', '$fechaEnvio')";

        if (mysqli_query($con, $sql)) {
            echo "Mensaje insertado en la base de datos con éxito";
        } else {
            echo "Error al insertar en la base de datos: " . mysqli_error($con);
        }

        // Marcar el mensaje como leído
        imap_setflag_full($conexion, $numeroMensaje, "\\Seen");
    }
}

// Cerrar la conexión
imap_close($conexion);
?>
