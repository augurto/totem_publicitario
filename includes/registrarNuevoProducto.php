<?php
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $precio = $_POST['precio'];
    $atributos = $_POST['atributos'];

    // Insertar el nuevo producto en la tabla "productos"
    $insertProductoQuery = "INSERT INTO productos (Nombre, Descripcion, Precio) VALUES ('$nombre', '$descripcion', $precio)";
    $resultProducto = mysqli_query($con, $insertProductoQuery);

    if (!$resultProducto) {
        echo "Error al agregar el producto: " . mysqli_error($con);
        mysqli_close($con);
        exit;
    }

    $nuevoProductoID = mysqli_insert_id($con);

    // Insertar los atributos del producto en la tabla "producto_atributos"
    if (!empty($atributos)) {
        foreach ($atributos as $atributoID) {
            $insertAtributoQuery = "INSERT INTO producto_atributos (Producto_ID, Atributo_ID) VALUES ($nuevoProductoID, $atributoID)";
            $resultAtributo = mysqli_query($con, $insertAtributoQuery);

            if (!$resultAtributo) {
                echo "Error al asociar atributos al producto: " . mysqli_error($con);
                mysqli_close($con);
                exit;
            }
        }
    }

    mysqli_close($con);
    header("Location: ../nuevoProducto.php");
    exit;
} else {
    echo "Acceso no válido";
}
?>
