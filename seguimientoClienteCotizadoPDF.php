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

// Deshabilitar la impresión de encabezado en todas las páginas
$pdf->SetPrintHeader(false);
// Ajustar el tamaño de la imagen en la primera columna
$imagePath = 'assets/images/logogeosatelital.jpg'; // Ruta de tu imagen
$imageWidth = 38; // Ancho de la imagen
$imageHeight = 11; // Alto de la imagen

// Calcular las coordenadas X e Y para centrar la imagen
$x = 10 + (80 - $imageWidth) / 2;
$y = 10 + (40 - $imageHeight) / 2;

$pdf->Image($imagePath, $x, $y, $imageWidth, $imageHeight);

// Crear una tabla con 3 columnas
$pdf->SetFont('helvetica', '', 12);
$pdf->SetDrawColor(0, 158, 205); // Color del borde de las celdas
$pdf->SetLineWidth(0.2); // Grosor del borde (0.2)

// Primera columna para la imagen
$pdf->Cell(80, 40, '', 1, 0, 'C', 0);

// Segunda columna para el texto 1 (dividido en 3 filas)
$pdf->Cell(60, 13.33, 'Texto 1', 1, 1, 'C', 0);
$pdf->Cell(60, 13.33, 'Texto 2', 1, 1, 'C', 0);
$pdf->Cell(60, 13.34, 'Texto 3', 1, 1, 'C', 0);

// Tercera columna para el texto 2
$pdf->Cell(60, 40, 'Texto 2', 1, 1, 'C', 0);


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

