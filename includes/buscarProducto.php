<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    // Consulta para obtener el producto con la mayoría de los atributos seleccionados
    $query = "SELECT p.Nombre, p.Precio
              FROM productos p
              WHERE p.ID IN (
                  SELECT pa.Producto_ID
                  FROM producto_atributos pa
                  WHERE pa.Atributo_ID IN ($atributosCondition)
                  GROUP BY pa.Producto_ID
                  HAVING COUNT(DISTINCT pa.Atributo_ID) = " . count($selectedAtributos) . "
              )
              LIMIT 1";

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $producto = $row['Nombre'];
        $precio = $row['Precio'];
        echo $producto . " - Precio: $" . $precio;
    } else {
        echo 'Ningún producto coincide con los atributos seleccionados.';
    }

    mysqli_free_result($result);
    mysqli_close($con);
}
?>
