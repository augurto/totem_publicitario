<?php
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();

$tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '';
$observaciones = isset($_POST['Observaciones']) ? $_POST['Observaciones'] : ''; // Asegúrate de que el nombre del campo coincida con el formulario

// Agregar estilo CSS para centrar y justificar texto
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Tipo de Documento:', 0, 1, 'C'); // Utiliza 'C' para centrar
$pdf->SetFont('Arial', '', 12);
$pdf->MultiCell(0, 10, $tipoDocumento, 0, 'C'); // Utiliza 'C' para centrar

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, 'Observaciones:', 0, 1);
$pdf->MultiCell(0, 10, $observaciones);

date_default_timezone_set('America/Lima'); // Establecer la zona horaria de Perú
$fechaActual = date('Y-m-d H:i:s');

$pdf->SetY(-15); // Posicionarse en el borde inferior de la página
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, 'Fecha: ' . $fechaActual, 0, 0, 'C');

$pdf->Output();
?>
