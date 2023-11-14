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

/
// ...

// Nombre del archivo PDF de salida
$pdfFileName = "cliente_informacion.pdf";

// Salida del PDF al navegador
$pdf->Output($pdfFileName, 'I');
?>
