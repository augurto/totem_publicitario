<?php
include 'conexion.php';

// Obtener los datos enviados por el formulario
$datos = $_POST['datos'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fuente = $_POST['fuente'];
$fuenteDato = $_POST['fuenteDato'];

/* estado es igual a tipo cliente */
// Asignar el valor a $tipoCliente según el valor de $documento
if (empty($documento)) {
    $tipoCliente = 4;
} else {
    $tipoCliente = $_POST['tipoCliente'];
}

$comentario = $_POST['comentario'];
/* FIN datos obtenidos de los inputs */
$idweb = $_POST['idweb'];
$iduser = $_POST['iduser'];
$pr = $_POST['pr'];
$URL = $_POST['URL'];
$nombreFormulario = $_POST['nombreFormulario'];
$ipFormulario = $_POST['ipFormulario'];
$aterrizaje = $_POST['aterrizaje'];
$formActualizado = $_POST['formActualizado'];
$empresa = $_POST['empresaUser'];
$mensajeOriginal = $_POST['mensajeOriginal'];

$estadoWeb = 1;


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
