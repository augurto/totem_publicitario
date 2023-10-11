<?php
include 'conexion.php';

// Obtener los datos enviados por el formulario
$datos = $_POST['datos'];
$datosSunat = $_POST['datosSunat'];
$documento = $_POST['documento'];
$telefono = $_POST['telefono'];
$email = $_POST['email'];
$fuente = $_POST['fuente'];
$fuenteDato = $_POST['fuenteDato'];
$tipoCliente = $_POST['tipoCliente'];

/* datos de la tabla */
$nombreProductos = $_POST['nombreProducto'];
$monedas = $_POST['moneda'];
$preciosPrincipales = $_POST['precioPrincipal'];
$preciosSecundarios = $_POST['precioSecundario'];
$cantidades = $_POST['cantidad'];
$descuentosMonto = $_POST['descuentoMonto'];
$descuentosMaximo = $_POST['descuentoMaximo'];
$subtotales = $_POST['subtotal'];

/* Fin de captura de datos de la Tabla */

/* estado es igual a tipo cliente */
// Asignar el valor a $tipoCliente según el valor de $documento

/* if($_POST['tipoCliente'] == 3) {
    $tipoCliente = $_POST['tipoCliente'];
}else{
    // Verificamos si $documento está vacío
    if (empty($documento)) {
        $tipoCliente = 4; // Asignamos el valor 4 a $tipoCliente si $documento está vacío
    } else {
        $tipoCliente = $_POST['tipoCliente']; // En caso contrario, utilizamos el valor recibido por POST
    }
} */

$comentario = $_POST['comentario'];
/* FIN datos obtenidos de los inputs */
$idweb = $_POST['idweb'];
$iduser = $_POST['iduser'];
/* para redireccionar cuando sea venta */
$pr = $_POST['pr'];
$URL = $_POST['URL'];
$nombreFormulario = $_POST['nombreFormulario'];
$ipFormulario = $_POST['ipFormulario'];
$aterrizaje = $_POST['aterrizaje'];
$formActualizado = $_POST['formActualizado'];
$empresa = $_POST['empresaUser'];
$mensajeOriginal = $_POST['mensajeOriginal'];
$idOriginal = $_POST['idOriginal'];

$estadoWeb = 1;


$query = "INSERT INTO web_formularios 
(documentoCliente, datos_form, telefono, email, tipoCliente, prospecto, id_user, estado_web, mensaje, estadoCliente, idEmpresa,fuente_dato,idid,URL,nombre_formulario,ip_formulario,formActualizado,aterrizajeFormulario,mensajeOriginal,idOriginal,datosSunat) 
VALUES ('$documento', '$datos', '$telefono', '$email', '$tipoCliente', '$fuente', '$iduser', '$estadoWeb', '$comentario', '$estadoCliente', '$empresa','$fuenteDato','$idweb','$URL','$nombreFormulario', '$ipFormulario','$formActualizado','$aterrizaje','$mensajeOriginal','$idOriginal','$datosSunat')";

if (mysqli_query($con, $query)) {
    // La inserción fue exitosa, obtener el ID insertado
    $id = mysqli_insert_id($con);

    // Actualizar el estado_web a 99 en la tabla web_formularios
    $updateQuery = "UPDATE web_formularios SET estado_web = 99 WHERE id_form_web = $idweb";
    mysqli_query($con, $updateQuery);

    if ($tipoCliente == 5 && $empresa == 2) {
        // Redireccionar a seguimientoCliente.php con variables en la URL
        header("Location: ../seguimientoClienteVendido.php?id=$id&pr=$pr");
        exit;
    } elseif ($tipoCliente == 6 && $empresa == 2) {
        // Realizar la inserción en la tabla tabla_productos
        // Suponiendo que los datos de la tabla productos están almacenados en arrays
        for ($i = 0; $i < count($nombreProductos); $i++) {
            $nombreProducto = $nombreProductos[$i];
            $moneda = $monedas[$i];
            $precioPrincipal = $preciosPrincipales[$i];
            $precioSecundario = $preciosSecundarios[$i];
            $cantidad = $cantidades[$i];
            $descuentoMonto = $descuentosMonto[$i];
            $descuentoMaximo = $descuentosMaximo[$i];
            $subtotal = $subtotales[$i];
    
            // Consulta SQL para insertar en tabla_productos
            $insertProductoQuery = "INSERT INTO tabla_productos 
                (id_form_web, nombreProducto, moneda, precioPrincipal, precioSecundario, cantidad, descuentoMonto, descuentoMaximo, subtotal)
                VALUES ($id, '$nombreProducto', '$moneda', $precioPrincipal, $precioSecundario, $cantidad, $descuentoMonto, $descuentoMaximo, $subtotal)";
            
            // Ejecutar la consulta de inserción
            if (mysqli_query($con, $insertProductoQuery)) {
                echo "Producto insertado: " . $nombreProducto . "<br>";
            } else {
                echo "Error al insertar producto: " . mysqli_error($con) . "<br>";
            }
        }
    }else {
        // Redireccionar a vendedor.php con el parámetro p=0
        header("Location: ../vendedor.php?p=0");
        exit;
    }
} else {
    // Manejar el caso de error en la inserción
    echo "Error en la inserción de datos: " . mysqli_error($con);
}

