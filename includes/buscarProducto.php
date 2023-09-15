<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    // Consulta para obtener el último producto que cumple con la mayoría de los requisitos
    $query = "SELECT p.ID, p.Nombre, COUNT(pa.ID) AS contador
              FROM productos p
              INNER JOIN producto_atributos pa ON p.ID = pa.Producto_ID
              WHERE pa.Atributo_ID IN ($atributosCondition)
              GROUP BY p.ID
              ORDER BY contador DESC, p.ID DESC
              LIMIT 1";

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $productoID = $row['ID'];
        $productoNombre = $row['Nombre'];

        // Consulta para obtener el precio del producto
        $precioQuery = "SELECT Precio FROM productos WHERE ID = $productoID";
        $precioResult = mysqli_query($con, $precioQuery);

        if ($precioRow = mysqli_fetch_assoc($precioResult)) {
            $precio = $precioRow['Precio'];
        } else {
            $precio = "Precio no disponible";
        }

        echo "Nombre del Producto: $productoNombre - Precio: $precio";
    }

    mysqli_free_result($result);
    mysqli_close($con);
}
?>
