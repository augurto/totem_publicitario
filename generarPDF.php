<?php

require('fpdf/fpdf.php');

// Función para generar el código QR y guardarlo como imagen
function generateQRCode($text, $filename) {
    include 'qrcode.js'; // Incluye la biblioteca qrcode.js (asegúrate de que la ruta sea correcta)
    
    // Crea una instancia de QRCode
    var qrcode = new QRCode(-1, QRCode.ErrorCorrectLevel.H);
    qrcode.addData(text);
    qrcode.make();
    
    // Convierte el código QR en una imagen PNG
    var imgData = qrcode.createDataURL();
    
    // Guarda la imagen como un archivo PNG
    file_put_contents($filename, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', imgData)));
}

class PDF extends FPDF {
    // Cabecera de página
    function Header() {
        $this->SetFont('Arial', '', 12);
        $this->SetXY(0, 10);
        $this->Cell(210, 10, utf8_decode('Año de la unidad, la paz y el desarrollo'), 0, 1, 'C');
    }

    // Resto del contenido del PDF
    function Content() {
        // Contenido del PDF
        // ...
        
        // Generar y mostrar el código QR
        $this->Image('qrcode.png', 80, 100, 50, 50);
    }
}

// Generar el código QR y guardarlo como una imagen
generateQRCode("https://www.ejemplo.com", "qrcode.png");

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
