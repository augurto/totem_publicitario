<?php
require 'conexion.php';

if (isset($_POST['atributo'])) {
    $nuevoAtributo = $_POST['atributo'];

    $query = "INSERT INTO atributos (Atributo) VALUES ('$nuevoAtributo')";
    $result = mysqli_query($con, $query);

    if ($result) {
        mysqli_close($con);
        header("Location: ../nuevoProducto.php");
        exit;
    } else {
        echo "Error al registrar el atributo: " . mysqli_error($con);
    }

    mysqli_close($con);
}
?>
