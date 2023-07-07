
<?php
// Incluir el archivo de conexión a la base de datos
include 'conexion.php';

// Obtener los datos enviados por el formulario
$datos = $_POST['datos'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$comentario = $_POST['comentario'];
$idweb = $_POST['idweb'];
$iduser = $_POST['iduser'];

// Realizar la consulta para insertar los datos en la base de datos
$query = "INSERT INTO cliente (datosCliente, documentoCliente, telefonoCliente, emailCliente, mensajeCliente, idWeb, idUsuarioMake) VALUES ('$datos', '$documento', '$telefono', '$email', '$comentario', '$idweb', '$iduser')";
$result = mysqli_query($con, $query);

// Verificar si la consulta fue exitosa
if ($result) {
    // La inserción de datos fue exitosa
    // Obtener el último ID generado
    $lastId = mysqli_insert_id($con);

    // Redireccionar a la misma página con el parámetro de ID en la URL
    header("Location: cliente.php?id=" . $lastId);
    exit();
} else {
    // Ocurrió un error durante la inserción de datos, puedes mostrar un mensaje de error o realizar alguna acción adicional si lo deseas
    echo "Error al guardar los datos";
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
