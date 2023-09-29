<?php
require('fpdf/fpdf.php');

class PDF extends FPDF {
    // Función para el encabezado
    function Header() {
        $this->SetFont('Arial', '', 12);
        $this->SetXY(0, 10);
        $this->Cell(210, 10, utf8_decode('Año de la unidad, la paz y el desarrollo'), 0, 1, 'C');
    }
    // Función para el pie de página
    function Footer() {
        // Establecer la posición a 1.5 cm desde el final de la página
        $this->SetY(-15);
        // Configurar fuente y tamaño para la fecha
        $this->SetFont('Arial', 'I', 8);
        // Imprimir la fecha actual en la parte inferior
        date_default_timezone_set('America/Lima');
        $fechaActual = date('Y-m-d H:i:s');
        $this->Cell(0, 10, 'Fecha: ' . $fechaActual, 0, 0, 'C');
    }
}

$pdf = new PDF();
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

// Calcular la posición X para centrar la imagen en el eje horizontal
$imageWidth = 50; // Ancho de la imagen en puntos
$pageWidth = $pdf->GetPageWidth(); // Ancho de la página en puntos
$imageX = ($pageWidth - $imageWidth) / 2;

$pdf->Image('assets/images/firma.png', $imageX, $pdf->GetY() + 10, $imageWidth); // Centra la imagen horizontalmente


$pdf->Output();
?>
