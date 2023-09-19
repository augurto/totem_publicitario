<?php
// Incluye el archivo de conexión
include('conexion.php');

// Verificar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener valores del formulario
    $fuente = $_POST["fuente"];
    $start = $_POST["start"];
    $end = $_POST["end"];
    $cantidad = $_POST["cantidad"];
    
    // Obtener el nombre del archivo subido
    $archivo_nombre = $_FILES["facturacion"]["name"];

    // Insertar datos en la tabla facturacionMKT
    $insert_query = "INSERT INTO facturacionMKT (fuente, start, end, cantidad, archivo) VALUES ('$fuente', '$start', '$end', '$cantidad', '$archivo_nombre')";

    if (mysqli_query($con, $insert_query)) {
        // Obtener el ID generado para esta inserción
        $id_facturacionMKT = mysqli_insert_id($con);

        // Crear una carpeta con el nombre del ID de facturacionMKT
        $carpeta_facturacion = "../facturacionMKT/" . $id_facturacionMKT;
        if (!is_dir($carpeta_facturacion)) {
            mkdir($carpeta_facturacion, 0777, true);
        }

        // Mover el archivo subido a la carpeta
        $archivo_temporal = $_FILES["facturacion"]["tmp_name"];
        $archivo_destino = $carpeta_facturacion . "/" . $archivo_nombre;
     
        if (move_uploaded_file($archivo_temporal, $archivo_destino)) {
            // Redireccionar a reporteMKT.php
            header("Location: ../reporteMKT.php");
            exit; // Asegura que el script se detenga después de la redirección
        } else {
            echo "Error al subir el archivo.";
        }
        
    } else {
        echo "Error al insertar datos en la tabla: " . mysqli_error($con);
    }
}

// Cerrar la conexión a la base de datos (al final de tu script)
mysqli_close($con); 
?>
