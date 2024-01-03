<?php
require '../includes/conexion.php';

// Verificar si se han enviado datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $fechaAgenda = $_POST["fechaAgenda"];
    $comentarioAgenda = $_POST["agendarComentario"];
    $idOriginal = $_POST["idOriginal"];

    // Preparar la consulta SQL para insertar en la tabla agendas
    $sql = "INSERT INTO agendas (fecha_agenda, comentario, id_original) VALUES (?, ?, ?)";

    // Preparar la sentencia
    $stmt = mysqli_prepare($con, $sql);

    // Vincular los parámetros
    mysqli_stmt_bind_param($stmt, 'sss', $fechaAgenda, $comentarioAgenda, $idOriginal);

    // Ejecutar la sentencia
    mysqli_stmt_execute($stmt);

    // Verificar si la inserción fue exitosa
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        // Redirigir a la página de éxito
        header("Location: ../exito_agenda.php");
        exit();
    } else {
        echo "Error al insertar en la tabla agendas: " . mysqli_error($con);
    }

    // Cerrar la sentencia
    mysqli_stmt_close($stmt);
} else {
    echo "Error: No se han recibido datos del formulario.";
}

// Cerrar la conexión
mysqli_close($con);
?>
