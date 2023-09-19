<?php
// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Establecer la conexión a la base de datos (usando tu configuración)
    $con = mysqli_connect('localhost', 'u291982824_prueba', '21.17.Prueba', 'u291982824_prueba');
    mysqli_set_charset($con, "utf8");

    // Verificar la conexión a la base de datos
    if (!$con) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    // Obtener valores del formulario
    $fuente = $_POST["fuente"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $cantidad = $_POST["cantidad"];

    // Insertar datos en la tabla facturacionMKT
    $insert_query = "INSERT INTO facturacionMKT (fuente, start, end, cantidad) VALUES ('$fuente', '$start', '$end', '$cantidad')";

    if (mysqli_query($con, $insert_query)) {
        // Obtener el ID generado para esta inserción
        $id_facturacionMKT = mysqli_insert_id($con);

        // Crear una carpeta con el nombre del ID de facturacionMKT
        $carpeta_facturacion = "facturacionMKT/" . $id_facturacionMKT;
        if (!is_dir($carpeta_facturacion)) {
            mkdir($carpeta_facturacion, 0777, true);
        }

        // Mover el archivo subido a la carpeta
        $archivo_nombre = $_FILES["facturacion"]["name"];
        $archivo_temporal = $_FILES["facturacion"]["tmp_name"];
        $archivo_destino = $carpeta_facturacion . "/" . $archivo_nombre;

        if (move_uploaded_file($archivo_temporal, $archivo_destino)) {
            echo "Datos guardados y archivo subido con éxito.";
        } else {
            echo "Error al subir el archivo.";
        }
    } else {
        echo "Error al insertar datos en la tabla: " . mysqli_error($con);
    }

    // Cerrar la conexión a la base de datos
    mysqli_close($con);
}
?>
