<?php
 $dato= $_GET['dato'];

require('fpdf/fpdf.php');
class PDF extends FPDF
{
    function Header()
    {
        // Logo en la esquina derecha de la cabecera
        $this->Image('assets/images/geoSinFondo.png', $this->GetPageWidth() - 40, 10, 30);

        // Lugar en la esquina izquierda de la cabecera
        $parametro = 'Parametro 1';  // Cambia el valor del lugar aquí
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, $parametro, 0, 1, 'L');  // Cambio en el parámetro aquí

        // Espacio después de la cabecera 
        $this->Ln(10);
    }

    function Footer()
    {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo(), 0, 0, 'C');

        // Agregar la fecha actual en el pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 0, 'L');
    }
}

// Crear una instancia de PDF personalizada
$pdf = new PDF();
$pdf->AddPage();

// Configurar la fuente y el tamaño
$pdf->SetFont('Arial', '', 12);

$pdf->SetXY(10, 20);
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(0, 10, 'Cotizacion', 0, 1, 'C');  // Cambio en el parámetro aquí
$pdf->SetFont('Arial', '', 12);
$pdf->Cell(0, 10, utf8_decode('CODIGO : ') . date('d/m/Y'), 0, 1, 'L');
$pdf->Cell(0, 10, 'Otro Dato', 0, 1, 'L');
$pdf->Cell(0, 10, 'Cliente: ', 0, 1, 'L');
$pdf->Cell(0, 10, 'Atendido por', 0, 1, 'L');




// Agregar la tabla de datos
$pdf->Ln(10);  // Espacio antes de la tabla
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(15, 10, 'DOCUMENTO', 1);
$pdf->Cell(83, 10, 'CLIENTE', 1);
$pdf->Cell(17, 10, 'FECHA', 1);

$pdf->Ln();

$pdf->SetFont('Arial', '', 8);

// Realizar la conexión a la base de datos usando el archivo de conexión
require('includes/conexion.php');


$query = "SELECT * FROM web_formularios";
$result = mysqli_query($con, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $especificaciones = htmlspecialchars($row['especificaciones'], ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $pdf->Cell(15, 10, $row['documentoCliente'], 1);
    $pdf->Cell(83, 10, utf8_decode($row['datos_form']), 1);
    $pdf->SetFont('Arial', 'B', 8);
    $pdf->Cell(17, 10, $row['fecha'], 1);
    $pdf->SetFont('Arial', '', 8);

    $pdf->Ln();
}

mysqli_close($con);
// Variables para el sigueinte bloque


$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(155, 10, $dato, 0, 0, 'R');
// Salida del PDF
$pdf->Output();
?>
