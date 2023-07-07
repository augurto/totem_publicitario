<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Obtener los datos enviados desde el formulario
$idCliente = $_POST['idcliente'];
$tipoCliente = $_POST['tipoCliente'];
$prospecto = $_POST['prospecto'];
$observacion = $_POST['observacion'];
$idid = $_POST['idid'];
$iduser = $_POST['iduser'];

// Preparar la consulta SQL para realizar la inserción
$query = "INSERT INTO web_formularios (documentoCliente,tipoCliente, prospecto, observacionCliente, idid, id_user) VALUES ('$idCliente', '$tipoCliente', '$prospecto', '$observacion', '$idid', '$iduser')";

// Ejecutar la consulta y verificar si se realizó correctamente
if (mysqli_query($con, $query)) {
    // Obtén el último id_form_web generado
    $id_web = mysqli_insert_id($con);

    // Redirecciona a la página cliente.php con el id_form_web como parámetro en la URL
    header("Location: cliente.php?id=" . $id_web);
    exit();
} else {
    // Ocurrió un error durante la inserción, puedes enviar un mensaje de error al cliente si lo deseas
    echo 'Error al guardar los datos: ' . mysqli_error($con);
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
