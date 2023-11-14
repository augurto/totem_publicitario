<?php
require './dompdf/src/Dompdf.php';
require 'includes/conexion.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Obtener el ID de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID no proporcionado en la URL");
}

// Crear una instancia de la clase Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

// ...

// Consultar los datos del cliente
$queryCliente = "SELECT nombres, apellidoPaterno, apellidoMaterno FROM tabla_clientes WHERE id_cliente = $id";
$resultCliente = mysqli_query($con, $queryCliente);

// Verificar si se obtuvieron resultados
if ($resultCliente && mysqli_num_rows($resultCliente) > 0) {
    $clienteData = mysqli_fetch_assoc($resultCliente);

    // Obtener nombre y apellidos del cliente
    $nombreCliente = $clienteData['nombres'];
    $apellidoPaternoCliente = $clienteData['apellidoPaterno'];
    $apellidoMaternoCliente = $clienteData['apellidoMaterno'];

    // Concatenar nombre y apellidos
    $nombresApellidosCliente = "$nombreCliente $apellidoPaternoCliente $apellidoMaternoCliente";

    // Generar el contenido HTML con la información del cliente
    $htmlCliente = '<h1>Información del Cliente</h1>';
    $htmlCliente .= '<p>' . $nombresApellidosCliente . '</p>';

    // Cargar el contenido HTML en dompdf
    $dompdf->loadHtml($htmlCliente);

    // Establecer el tamaño del papel y la orientación
    $dompdf->setPaper('A4', 'portrait');

    // Renderizar el contenido HTML en PDF
    $dompdf->render();

    // Nombre del archivo PDF de salida
    $pdfFileName = "cliente_informacion.pdf";

    // Descargar el archivo PDF
    $dompdf->stream($pdfFileName, array('Attachment' => 0));
} else {
    die("No se encontró información del cliente para este ID.");
}
?>
