<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    $query = "SELECT p.Nombre, pa.Atributo_ID FROM productos p
              INNER JOIN producto_atributos pa ON p.ID = pa.Producto_ID
              WHERE pa.Atributo_ID IN ($atributosCondition)
              GROUP BY p.ID
              HAVING COUNT(DISTINCT pa.Atributo_ID) = " . count($selectedAtributos);

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $producto = $row['Nombre'];
        echo $producto;
    } else {
        // Devuelve el ID del atributo que no coincide junto con el mensaje de error
        echo 'Ningún producto coincide con los atributos seleccionados.' . mysqli_real_escape_string($con, $atributosCondition);
    }

    mysqli_free_result($result);
    mysqli_close($con);
}

?>
