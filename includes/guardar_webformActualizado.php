<?php
include 'conexion.php';

// Obtener los datos enviados por el formulario
$datos = $_POST['datos'];
$datosSunat = $_POST['datosSunat'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fuente = $_POST['fuente'];
$fuenteDato = $_POST['fuenteDato'];
$tipoCliente = $_POST['tipoCliente'];
/* estado es igual a tipo cliente */
// Asignar el valor a $tipoCliente según el valor de $documento

/* if($_POST['tipoCliente'] == 3) {
    $tipoCliente = $_POST['tipoCliente'];
}else{
    // Verificamos si $documento está vacío
    if (empty($documento)) {
        $tipoCliente = 4; // Asignamos el valor 4 a $tipoCliente si $documento está vacío
    } else {
        $tipoCliente = $_POST['tipoCliente']; // En caso contrario, utilizamos el valor recibido por POST
    }
} */

$comentario = $_POST['comentario'];
/* FIN datos obtenidos de los inputs */
$idweb = $_POST['idweb'];
$iduser = $_POST['iduser'];
/* para redireccionar cuando sea venta */
$pr = $_POST['pr'];
$URL = $_POST['URL'];
$nombreFormulario = $_POST['nombreFormulario'];
$ipFormulario = $_POST['ipFormulario'];
$aterrizaje = $_POST['aterrizaje'];
$formActualizado = $_POST['formActualizado'];
$empresa = $_POST['empresaUser'];
$mensajeOriginal = $_POST['mensajeOriginal'];
$idOriginal = $_POST['idOriginal'];

$estadoWeb = 1;


$query = "INSERT INTO web_formularios 
(documentoCliente, datos_form, telefono, email, tipoCliente, prospecto, id_user, estado_web, mensaje, estadoCliente, idEmpresa,fuente_dato,idid,URL,nombre_formulario,ip_formulario,formActualizado,aterrizajeFormulario,mensajeOriginal,idOriginal,datosSunat) 
VALUES ('$documento', '$datos', '$telefono', '$email', '$tipoCliente', '$fuente', '$iduser', '$estadoWeb', '$comentario', '$estadoCliente', '$empresa','$fuenteDato','$idweb','$URL','$nombreFormulario', '$ipFormulario','$formActualizado','$aterrizaje','$mensajeOriginal','$idOriginal','$datosSunat')";

if (mysqli_query($con, $query)) {
    // La inserción fue exitosa, obtener el ID insertado
    $id = mysqli_insert_id($con);

    // Actualizar el estado_web a 99 en la tabla web_formularios
    $updateQuery = "UPDATE web_formularios SET estado_web = 99 WHERE id_form_web = $idweb";
    mysqli_query($con, $updateQuery); 

    if ($tipoCliente == 5 && $empresa == 2) {
        // Redireccionar a seguimientoCliente.php con variables en la URL
        header("Location: ../seguimientoClienteVendido.php?id=$id&pr=$pr");
        exit;
    }elseif ($tipoCliente == 6 && $empresa == 2) {
        // Redireccionar a seguimientoCliente.php con variables en la URL
        header("Location: ../seguimientoClienteCotizado.php?id=$id");
        exit;
    } else {
        // Redireccionar a vendedor.php con el parámetro p=0
        header("Location: ../vendedor.php?p=0");
        exit;
    }

    exit();
} else {
    // Manejar el caso de error en la inserción
    echo "Error en la inserción de datos: " . mysqli_error($con);
}
