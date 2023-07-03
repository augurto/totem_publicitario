<?php
// Incluir el archivo de conexión
include 'conexion.php';

// Obtener el valor de idFormWeb enviado por AJAX
$idFormWeb = $_POST['idFormWeb'];

// Realizar la consulta SQL
$query = "SELECT id_user FROM web_formularios WHERE id_form_web = $idFormWeb";
$result = mysqli_query($con, $query);

// Verificar si se obtuvo algún resultado
if ($result) {
    // Obtener el valor de la consulta
    $row = mysqli_fetch_assoc($result);
    $valor = $row['id_user'];

    // Devolver el valor como respuesta AJAX
    echo $valor;
} else {
    // Manejar el caso de error
    echo "Error al realizar la consulta";
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
