<?php
include 'conexion.php';

// Obtener los valores del formulario
$idProducto = $_POST['idProductoInput'];
$nombreProducto = $_POST['nombreInput'];
$precioProducto = $_POST['precioInput'];
$cantidad = $_POST['cantidad'];
$montoAdicional = $_POST['montoAdicional'];
$montoTotal = $_POST['montoTotal'];
$observacion = $_POST['observacion'];
$idVenta = $_POST['idid'];
$idUsuario = $_POST['iduser'];
$empresaUser = $_POST['empresaUser'];
//nuevos datos
$formRadiosValue = $_POST['formRadios'];
$formRadiosPlanValue = $_POST['formRadiosPlan'];
$tipoServicio = $_POST['tipoServicio'];

$estado = 0;

// Obtener información sobre el archivo subido
$archivoNombre = $_FILES['archivo']['name'];
$archivoTipo = $_FILES['archivo']['type'];
$archivoTamano = $_FILES['archivo']['size'];
$archivoRutaTemp = $_FILES['archivo']['tmp_name'];

// Directorio de destino donde se guardarán los archivos
$directorioDestino = '../archivos/';

// Crear la carpeta con el nombre de la variable $_POST['idid']
$rutaCarpetaDestino = $directorioDestino . $_POST['idid'] . '/';
if (!is_dir($rutaCarpetaDestino)) {
    if (!mkdir($rutaCarpetaDestino, 0755, true)) {
        echo "Error al crear la carpeta de destino.";
        exit();
    }
}

// Ruta de destino completa donde se guardará el archivo
$rutaDestino = $rutaCarpetaDestino . $archivoNombre;

// Mover el archivo a la ruta de destino
if ($_FILES['archivo']['error'] !== UPLOAD_ERR_OK) {
    echo "Error al subir el archivo: " . $_FILES['archivo']['error'];
    exit();
}

if (move_uploaded_file($archivoRutaTemp, $rutaDestino)) {
    // Preparar la consulta SQL para insertar los datos en la tabla de ventas
    $query = "INSERT INTO ventas (idProducto, nombreProducto, precioProducto, cantidadProducto, montoAdicional, montoTotal, observacionVenta, id_web_formularios, idUser, rutaArchivo, nombreArchivo, estadoVenta,empresaUser,valor1,valor2,valor3) 
    VALUES ('$idProducto', '$nombreProducto', '$precioProducto', '$cantidad', '$montoAdicional', '$montoTotal', '$observacion', '$idVenta', '$idUsuario', '$rutaDestino', '$archivoNombre', '$estado','$empresaUser','$formRadiosValue ','$formRadiosPlanValue ','$tipoServicio ')";

    // Ejecutar la consulta
    if (mysqli_query($con, $query)) {
       // Redireccionar a ventas.php con el ID de la venta en la URL
        header("Location: ../reporteVentas.php?idVenta=" . $idVenta);
        exit();
    } else {
        echo "Error al guardar los datos: " . mysqli_error($con);
    }
} else {
    echo "Error al mover el archivo a la ruta de destino.";
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
