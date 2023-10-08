<?php
require 'conexion.php';

if (isset($_POST['atributos'])) {
    $selectedAtributos = $_POST['atributos'];
    $atributosCondition = implode(',', $selectedAtributos);

    // Moneda seleccionada (0 para Soles y 1 para Dólares)
    $tipoMonedaSeleccionada = isset($_POST['tipoMoneda']) ? intval($_POST['tipoMoneda']) : 0;

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
        // Definir las variables de precio y descuento según la moneda seleccionada
        $precioPrincipal = ($tipoMonedaSeleccionada === 1) ? $row['precioDolar'] : $row['Precio'];
        $precioSecundario = ($tipoMonedaSeleccionada === 1) ? $row['precioDolarMin'] : $row['precioMin'];
        $descuentoGeneral = ($tipoMonedaSeleccionada === 1) ? $row['descuentoMaxDolar'] : $row['descuentoMax'];

        $productoInfo = array(
            'ID' => $row['ID'],
            'Nombre' => $row['Nombre'],
            'Descripcion' => $row['Descripcion'],
            'PrecioPrincipal' => $precioPrincipal,
            'PrecioSecundario' => $precioSecundario,
            'DescuentoGeneral' => $descuentoGeneral
        );
        echo json_encode($productoInfo); // Devuelve los datos como JSON
    } else {
        // Si no se encuentra ningún producto, devuelve un mensaje
        echo json_encode(array(
            'ID' => '',
            'Nombre' => 'Ningún producto coincide',
            'Descripcion' => '',
            'PrecioPrincipal' => '',
            'PrecioSecundario' => '',
            'DescuentoGeneral' => ''
        ));
    }

    mysqli_free_result($result);
    mysqli_close($con);
}


?>


