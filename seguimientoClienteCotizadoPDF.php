<?php
require('./fpdf/fpdf.php');
require('includes/conexion.php');

// Obtener el ID de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID no proporcionado en la URL");
}

class PDF extends FPDF
{
    // Función para encabezado
    function Header()
    {
        // Puedes personalizar el encabezado aquí
        $this->Cell(0, 10, 'Encabezado del PDF', 0, 1, 'C');
    }

    // Función para pie de página
    function Footer()
    {
        // Puedes personalizar el pie de página aquí
        $this->Cell(0, 10, 'Pie de página del PDF', 0, 1, 'C');
    }
}

// Crear una instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

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

    // Agregar información del cliente al PDF
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, "Información del Cliente", 0, 1, 'C');
    $pdf->Ln(10);
    $pdf->MultiCell(0, 10, $nombresApellidosCliente, 0, 'C');
} else {
    die("No se encontró información del cliente para este ID.");
}

// ...

// Nombre del archivo PDF de salida
$pdfFileName = "cliente_informacion.pdf";

// Salida del PDF al navegador
$pdf->Output($pdfFileName, 'I');
?>
