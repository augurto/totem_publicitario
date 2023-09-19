<?php
// Verificar si se ha enviado el formulario (si se ha hecho clic en el botón "Enviar")
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos enviados desde el formulario
    $fuente = $_POST["fuente"];
    $fechaInicio = $_POST["start"];
    $fechaFin = $_POST["end"];
    $cantidad = $_POST["cantidad"];

    // Imprimir los datos para verificar
    echo "Fuente: " . $fuente . "<br>";
    echo "Fecha Inicio: " . $fechaInicio . "<br>";
    echo "Fecha Fin: " . $fechaFin . "<br>";
    echo "Inversión: " . $cantidad . "<br>";

    // Procesar los datos, guardarlos en la base de datos, etc.
    // Agrega tu lógica de procesamiento aquí

} else {
    // Si el formulario no se ha enviado, mostrar un mensaje de error o redireccionar si es necesario
    echo "El formulario no se ha enviado correctamente.";
}
?>
