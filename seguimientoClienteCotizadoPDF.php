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

// Ajustar el tamaño de la imagen en la primera columna
$imagePath = 'assets/images/logogeosatelital.jpg'; // Reemplaza con la ruta de tu imagen
$pdf->Image($imagePath, $pdf->GetX(), $pdf->GetY(), 80, 40); // Establece el ancho (80) y alto (40) de la imagen
$pdf->Ln(10);

// Crear una tabla con 3 columnas
$pdf->SetFont('helvetica', '', 12);
$pdf->SetDrawColor(0, 158, 205); // Color del borde de la celda
$pdf->Cell(80, 40, '', 'T'); // Primera columna para la imagen
$pdf->Cell(60, 40, 'Texto 1', 'T'); // Segunda columna para el texto 1
$pdf->Cell(60, 40, 'Texto 2', 'T'); // Tercera columna para el texto 2
$pdf->Ln();

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
$pdf->Image('assets/images/geoprime1.jpg', 0, 0, 210, 297); // Ancho y alto establecidos para llenar la página

// Agregar una nueva página
$pdf->AddPage();

// Insertar la imagen en la nueva página (tercera página) y ajustar el tamaño para que ocupe toda la página
$pdf->Image('assets/images/geoprime2.jpg', 0, 0, 210, 297); // Ancho y alto establecidos para llenar la página

// Nombre del archivo PDF de salida
$pdfFileName = "productos.pdf";

// Generar el PDF y mostrarlo en el navegador
$pdf->Output($pdfFileName, 'I');
?>

