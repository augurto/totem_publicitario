<?php 
require('fpdf/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$tipoDocumento = isset($_POST['tipoDocumento']) ? $_POST['tipoDocumento'] : '';
$observaciones = isset($_POST['observaciones']) ? $_POST['observaciones'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : '';
$number = isset($_POST['number']) ? $_POST['number'] : '';
$color = isset($_POST['color']) ? $_POST['color'] : '';
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(40, 10, 'Tipo de Documento:');
$pdf->Cell(0, 10, $tipoDocumento, 0, 1);

$pdf->SetFont('Arial', '', 12);
$pdf->Cell(40, 10, 'Observaciones:');
$pdf->MultiCell(0, 10, $observaciones);

// Agregar los otros campos del formulario de manera similar
date_default_timezone_set('America/Lima'); // Establecer la zona horaria de Perú

$fechaActual = date('Y-m-d H:i:s');

$pdf->SetY(-15); // Posicionarse en el borde inferior de la página
$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 10, 'Fecha: ' . $fechaActual, 0, 0, 'C');
$pdf->Output();

?>