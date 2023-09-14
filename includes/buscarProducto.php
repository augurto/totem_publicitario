<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    $query = "SELECT p.Nombre
              FROM productos p
              WHERE p.ID = (
                  SELECT pa.Producto_ID
                  FROM producto_atributos pa
                  WHERE pa.Atributo_ID IN ($atributosCondition)
                  GROUP BY pa.Producto_ID
                  HAVING COUNT(DISTINCT pa.Atributo_ID) = " . count($selectedAtributos) . "
                  ORDER BY pa.Producto_ID DESC
                  LIMIT 1
              )";

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $producto = $row['Nombre'];
        echo $producto;
    } else {
        // No se encontró ningún producto coincidente, devuelve un mensaje.
        echo 'Ningún producto coincide con los atributos seleccionados.';
    }

    mysqli_free_result($result);
    mysqli_close($con);
}

?>
