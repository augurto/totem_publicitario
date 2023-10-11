<?php
require('fpdf/fpdf.php');
require('includes/conexion.php');

// Obtener el ID de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID no proporcionado en la URL");
}

// Crear una instancia de la clase PDF
$pdf = new FPDF();
$pdf->AddPage();

// Definir el tamaño y tipo de fuente
$pdf->SetFont('Arial', '', 12);

// Título
$pdf->Cell(0, 10, 'ID Obtenido de la URL', 0, 1, 'C');
$pdf->Ln(10);

// Mostrar el ID
$pdf->Cell(0, 10, "ID: $id", 0, 1);

// Nombre del archivo PDF de salida
$pdfFileName = "id.pdf";

// Generar el PDF y mostrarlo en el navegador
$pdf->Output($pdfFileName, 'D');
?>
