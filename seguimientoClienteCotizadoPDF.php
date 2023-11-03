<?php
require('tcpdf/tcpdf.php');
require('includes/conexion.php');

// Obtener el ID de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID no proporcionado en la URL");
}

// Crear una instancia de la clase PDF
$pdf = new TCPDF();
$pdf->AddPage();

// Iniciar la tabla con bordes de color #009ecd
$html = '<table style="border: 1px solid #009ecd;"><tr>';

// Primera columna con una imagen centrada horizontal y verticalmente y padding superior de 20px
$html .= '<td style="border: 1px solid #009ecd; text-align: center; vertical-align: middle; padding-top: 20px;">';

// Añadir la imagen
$imagePath = 'assets/images/logogeosatelital.jpg';
$html .= '<img src="' . $imagePath . '" width="90" height="26" />';

$html .= '</td>';

// Segunda columna con tres filas, cada una con borde de color #009ecd y color de texto #009ecd
$html .= '<td style="border: 1px solid #009ecd; text-align: center; padding-top: 20px;">';
$html .= '<div style="border-bottom: 1px solid #009ecd; color: #009ecd;">20600137094</div>';
$html .= '<div style="border-bottom: 1px solid #009ecd; color: #009ecd;">T.(01)739-0556</div>';
$html .= '<div style="color: #009ecd;">Av. Industrial 3220 - Independencia</div>';
$html .= '</td>';

// Tercera columna con dos filas, cada una con borde de color #009ecd y color de texto #009ecd
$html .= '<td style="border: 1px solid #009ecd; text-align: center; padding-top: 20px;">';
$html .= '<div style="border-bottom: 1px solid #009ecd; color: #009ecd;">Nro Cotizacion 2023 - ' . $id . '</div>';
$html .= '<div style="color: #009ecd;">www.geosatelital.com</div>';
$html .= '</td>';

// Cerrar la tabla
$html .= '</tr></table>';

// Insertar la tabla en el PDF
$pdf->writeHTML($html, true, false, true, false, '');

// Nombre del archivo PDF de salida

// Mostrar el ID
$pdf->Cell(0, 10, "ID: $id", 0, 1);

// Consultar los datos de los productos
$query = "SELECT nombreProducto, moneda, precioPrincipal, precioSecundario, cantidad, descuentoMonto, descuentoMaximo, subtotal
          FROM tabla_productos
          WHERE id_form_web = $id";
$result = mysqli_query($con, $query);

// Verificar si se obtuvieron resultados
if ($result && mysqli_num_rows($result) > 0) {
    $pdf->Ln(10);

    // Abreviaciones en la cabecera de la tabla
    $pdf->Cell(35, 10, 'Nombre Prod.', 1);
    $pdf->Cell(25, 10, 'Moneda', 1);
    $pdf->Cell(35, 10, 'Precio Principal', 1);
    $pdf->Cell(35, 10, 'Precio Sec.', 1);
    $pdf->Cell(25, 10, 'Cantidad', 1);
    $pdf->Cell(35, 10, 'Desc. Monto', 1);
    $pdf->Cell(35, 10, 'Desc. Máx.', 1);
    $pdf->Cell(35, 10, 'Subtotal', 1);
    $pdf->Ln();

    while ($row = mysqli_fetch_assoc($result)) {
        // Datos de productos
        $pdf->Cell(35, 10, $row['nombreProducto'], 1);
        $pdf->Cell(25, 10, $row['moneda'], 1);
        $pdf->Cell(35, 10, $row['precioPrincipal'], 1);
        $pdf->Cell(35, 10, $row['precioSecundario'], 1);
        $pdf->Cell(25, 10, $row['cantidad'], 1);
        $pdf->Cell(35, 10, $row['descuentoMonto'], 1);
        $pdf->Cell(35, 10, $row['descuentoMaximo'], 1);
        $pdf->Cell(35, 10, $row['subtotal'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'No se encontraron productos para este ID.', 0, 1);
}

// Agregar una nueva página
$pdf->AddPage();

// Insertar la imagen en la nueva página (segunda página) y ajustar el tamaño para que ocupe toda la página
$pdf->Image('assets/images/geoprime1.jpg', 10, 10, 190);

// Agregar una nueva página
$pdf->AddPage();

// Insertar la imagen en la nueva página (tercera página) y ajustar el tamaño para que ocupe toda la página
$pdf->Image('assets/images/geoprime2.jpg', 10, 10, 190);

// Nombre del archivo PDF de salida
$pdfFileName = "productos.pdf";

// Generar el PDF y mostrarlo en el navegador
$pdf->Output($pdfFileName, 'I');
?>
