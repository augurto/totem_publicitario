

<?php
include 'conexion.php'; // Incluir el archivo de conexión

// Obtener los datos enviados desde el formulario
$documentoCliente = $_POST['idcliente'];
$tipoCliente = $_POST['tipoCliente'];
$prospecto = $_POST['prospecto'];
$observacionCliente = $_POST['observacion'];
$idid = $_POST['idid'];
$id_user = $_POST['iduser'];
$estadoWeb = 1;

// Consultar la tabla cliente para obtener los datosCliente, telefonoCliente y emailCliente según el documentoCliente
$queryCliente = "SELECT datosCliente, telefonoCliente, emailCliente FROM cliente WHERE documentoCliente='$documentoCliente'";
$resultCliente = mysqli_query($con, $queryCliente);

// Verificar si se encontraron resultados
if ($resultCliente && mysqli_num_rows($resultCliente) > 0) {
    // Obtener los valores de datosCliente, telefonoCliente y emailCliente
    $rowCliente = mysqli_fetch_assoc($resultCliente);
    $datosCliente = $rowCliente['datosCliente'];
    $telefonoCliente = $rowCliente['telefonoCliente'];
    $emailCliente = $rowCliente['emailCliente'];
    $mensajeCliente = $rowCliente['mensajeCliente'];

    // Preparar la consulta SQL para realizar la inserción en web_formularios con los valores obtenidos
    $query = "INSERT INTO web_formularios (documentoCliente, datos_form, telefono, email, tipoCliente, prospecto, idid, id_user, fuente_dato,mensaje) VALUES ('$documentoCliente', '$datosCliente', '$telefonoCliente', '$emailCliente', '$tipoCliente', '$prospecto', '$idid', '$id_user', '$estadoWeb','$observacionCliente')";

    // Ejecutar la consulta y verificar si se realizó correctamente
    if (mysqli_query($con, $query)) {
        // La inserción fue exitosa, obtén el id_form_web generado
        $id_web = mysqli_insert_id($con);

        // Guardar el valor de id_form_web en la variable $id_web
        $id_web = $id_web;

        // Redirecciona a la página cliente.php con el id_form_web como parámetro en la URL
        header("Location: ../vendedor.php?id=" . $id_web);
        exit();
    } else {
        // Ocurrió un error durante la inserción, puedes enviar un mensaje de error al cliente si lo deseas
        echo 'Error al guardar los datos: ' . mysqli_error($con);
    }
} else {
    // No se encontró el cliente con el documento especificado, puedes enviar un mensaje de error al cliente si lo deseas
    echo $datosCliente.$telefonoCliente.$emailCliente;
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
