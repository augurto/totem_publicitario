<?php
require '../includes/conexion.php';

// Obtener el valor de la URL
$valor = isset($_GET['valor']) ? $_GET['valor'] : null;

// Validar el valor (asegúrate de realizar más validaciones según tus necesidades)
if ($valor !== null && is_numeric($valor)) {
    // Obtener el ID del documento desde la URL
    $id_documento = isset($_GET['id_documento']) ? $_GET['id_documento'] : null;

    // Validar el ID del documento (asegúrate de realizar más validaciones según tus necesidades)
    if ($id_documento !== null && is_numeric($id_documento)) {
        // Preparar la consulta SQL para actualizar el estado_agenda
        $sql = "UPDATE agendas SET estado_agenda = ? WHERE id_original = ?";

        // Preparar la sentencia
        $stmt = mysqli_prepare($con, $sql);

        // Vincular los parámetros
        mysqli_stmt_bind_param($stmt, 'ss', $valor, $id_documento);

        // Ejecutar la sentencia
        mysqli_stmt_execute($stmt);

        // Verificar si la actualización fue exitosa
        if (mysqli_stmt_affected_rows($stmt) > 0) {
            echo "Estado de la agenda actualizado correctamente.";
            header("Location: ../recordatorio.php");
            exit();
        } else {
            echo "Error al actualizar el estado de la agenda: " . mysqli_error($con);
            header("Location: ../recordatorio.php");
            exit();
        }

        // Cerrar la sentencia
        mysqli_stmt_close($stmt);
    } else {
        echo "ID del documento no válido.";
        header("Location: ../recordatorio.php");
        exit();
    }
} else {
    echo "Valor no válido.";
    header("Location: ../recordatorio.php");
    exit();
}

// Cerrar la conexión
mysqli_close($con);
