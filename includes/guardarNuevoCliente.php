<?php
include 'conexion.php';

// Obtener los datos enviados por el formulario
$datos = $_POST['datos'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$comentario = $_POST['comentario'];
$idweb = $_POST['idweb'];
$iduser = $_POST['usuario'];
$pr = $_POST['pr'];
$tipoCliente = $_POST['tipoCliente'];
$prospecto = $_POST['prospecto'];
$empresa = $_POST['empresa'];

$estadoWeb = 0;
$estadoCliente = ($documento == '') ? 4 : $tipoCliente;

$query = "INSERT INTO web_formularios 
(documentoCliente, datos_form, telefono, email, tipoCliente, prospecto, id_user, estado_web, mensaje, estadoCliente, idEmpresa) 
    VALUES 
('$documento', '$datos', '$telefono', '$email', '$tipoCliente', '$prospecto', '$iduser', '$estadoWeb', '$comentario', '$estadoCliente', '$empresa')";

if (mysqli_query($con, $query)) {
    // La inserción fue exitosa, redirecciona a editarcliente.php con el parámetro id
    $id = mysqli_insert_id($con);
    header("Location: ../vendedor.php?p=0");
    exit();
} else {
    // Manejar el caso de error en la inserción
    echo "Error en la inserción de datos: " . mysqli_error($con);
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
