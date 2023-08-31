<?php
include 'conexion.php';  

// Obtener atributos seleccionados del parámetro GET
$atributosIds = isset($_GET['atributos']) ? $_GET['atributos'] : '';
$atributosArray = explode(', ', $atributosIds);

// Construir la consulta SQL
$consulta = "SELECT idAtributoProducto FROM atributosProducto WHERE ";
foreach ($atributosArray as $atributo) {
    $consulta .= "$atributo = 1 AND ";
}
$consulta = rtrim($consulta, " AND ");  // Quitar el último " AND "

$resultado = mysqli_query($con, $consulta);

// Mostrar resultados
if ($resultado && mysqli_num_rows($resultado) > 0) {
    echo "Los siguientes idAtributoProducto coinciden con los atributos seleccionados:<br>";
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo $row['idAtributoProducto'] . "<br>";
    }
} else {
    echo "No se encontraron productos con los atributos seleccionados.";
}

mysqli_close($con);
?>
