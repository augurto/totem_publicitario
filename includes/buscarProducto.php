<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    // Consulta para obtener el último producto que cumple con la mayoría de los requisitos
    $query = "SELECT p.Nombre, p.Precio, COUNT(pa.ID) AS contador
              FROM productos p
              INNER JOIN producto_atributos pa ON p.ID = pa.Producto_ID
              WHERE pa.Atributo_ID IN ($atributosCondition)
              GROUP BY p.ID
              ORDER BY contador DESC, p.ID DESC
              LIMIT 1";

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $producto = $row['Nombre'];
        $precio = $row['Precio']; // Obtenemos el precio del producto
        echo $producto . " - Precio: $" . $precio; // Mostramos el nombre del producto y su precio
    }

    mysqli_free_result($result);
    mysqli_close($con);
}
?>
