
<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Obtener los datos enviados desde el formulario
$documentoCliente = $_POST['idCliente'];
$tipoCliente = $_POST['tipoCliente'];
$prospecto = $_POST['prospecto'];
$observacionCliente = $_POST['observacion'];
$idid = $_POST['idid'];
$id_user = $_POST['iduser'];

// Preparar la consulta SQL para realizar la inserción
$query = "INSERT INTO web_formularios (documentoCliente,tipoCliente, prospecto, observacionCliente, idid, id_user) VALUES ('$documentoCliente','$tipoCliente', '$prospecto', '$observacionCliente', '$idid', '$id_user')";

// Ejecutar la consulta y verificar si se realizó correctamente
if (mysqli_query($con, $query)) {
    // La inserción fue exitosa, obtén el id_form_web generado
    $id_web = mysqli_insert_id($con);

    // Guardar el valor de id_form_web en la variable $id_web
    $id_web = $id_web;

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