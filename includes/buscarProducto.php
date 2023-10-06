<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    // Consulta para obtener el último producto que cumple con la mayoría de los requisitos
    $query = "SELECT p.ID, p.Nombre, p.Descripcion, p.Precio, p.precioDolar, p.descuentoMax, p.precioMin, p.precioDolarMin, p.descuentoMaxDolar, COUNT(pa.ID) AS contador
              FROM productos p
              INNER JOIN producto_atributos pa ON p.ID = pa.Producto_ID
              WHERE pa.Atributo_ID IN ($atributosCondition)
              GROUP BY p.ID
              ORDER BY contador DESC, p.ID DESC
              LIMIT 1";

    $result = mysqli_query($con, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $productoInfo = array(
            'ID' => $row['ID'],
            'Nombre' => $row['Nombre'],
            'Descripcion' => $row['Descripcion'],
            'Precio' => $row['Precio'],
            'precioDolar' => $row['precioDolar'],
            'descuentoMax' => $row['descuentoMax'],
            'precioMin' => $row['precioMin'],
            'precioDolarMin' => $row['precioDolarMin'],
            'descuentoMaxDolar' => $row['descuentoMaxDolar']
        );
        echo json_encode($productoInfo); // Devuelve los datos como JSON
    } else {
        // Si no se encuentra ningún producto, devuelve un mensaje
        echo json_encode(array(
            'ID' => '',
            'Nombre' => 'Ningún producto coincide',
            'Descripcion' => '',
            'Precio' => '',
            'precioDolar' => '',
            'descuentoMax' => '',
            'precioMin' => '',
            'precioDolarMin' => '',
            'descuentoMaxDolar' => ''
        ));
    }

    mysqli_free_result($result);
    mysqli_close($con);
}
?>


