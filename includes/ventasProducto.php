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
$estado=0;

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
    mkdir($rutaCarpetaDestino, 0755, true); // Crea la carpeta con permisos 0755
}

// Ruta de destino completa donde se guardará el archivo
$rutaDestino = $rutaCarpetaDestino . $archivoNombre;

// Mover el archivo a la ruta de destino
if (move_uploaded_file($archivoRutaTemp, $rutaDestino)) {
    // Preparar la consulta SQL para insertar los datos en la tabla de ventas
    $query = "INSERT INTO ventas (idProducto, nombreProducto, precioProducto, cantidadProducto, montoAdicional, montoTotal, observacionVenta, id_web_formularios, idUser, rutaArchivo,nombreArchivo,estadoVenta) VALUES ('$idProducto', '$nombreProducto', '$precioProducto', '$cantidad', '$montoAdicional', '$montoTotal', '$observacion', '$idVenta', '$idUsuario', '$rutaDestino','$archivoNombre','$estado')";

    // Ejecutar la consulta
    if (mysqli_query($con, $query)) {
        echo "Los datos se guardaron correctamente en la base de datos.";
    } else {
        echo "Error al guardar los datos: " . mysqli_error($con);
    }
} else {
    echo "Error al mover el archivo a la ruta de destino.";
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
