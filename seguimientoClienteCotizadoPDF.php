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

// Consultar los datos de los productos
$query = "SELECT nombreProducto, moneda, precioPrincipal, precioSecundario, cantidad, descuentoMonto, descuentoMaximo, subtotal
          FROM tabla_productos
          WHERE id_form_web = $id";
$result = mysqli_query($con, $query);

// Verificar si se obtuvieron resultados
if ($result && mysqli_num_rows($result) > 0) {
    $pdf->Ln(10);

    // Encabezados de la tabla
    $pdf->Cell(35, 10, 'Nombre Producto', 1);
    $pdf->Cell(35, 10, 'Moneda', 1);
    $pdf->Cell(35, 10, 'Precio Principal', 1);
    $pdf->Cell(35, 10, 'Precio Secundario', 1);
    $pdf->Cell(35, 10, 'Cantidad', 1);
    $pdf->Cell(35, 10, 'Descuento Monto', 1);
    $pdf->Cell(35, 10, 'Descuento Máximo', 1);
    $pdf->Cell(35, 10, 'Subtotal', 1);
    $pdf->Ln();

    // Datos de productos
    while ($row = mysqli_fetch_assoc($result)) {
        $pdf->Cell(35, 10, $row['nombreProducto'], 1);
        $pdf->Cell(35, 10, $row['moneda'], 1);
        $pdf->Cell(35, 10, $row['precioPrincipal'], 1);
        $pdf->Cell(35, 10, $row['precioSecundario'], 1);
        $pdf->Cell(35, 10, $row['cantidad'], 1);
        $pdf->Cell(35, 10, $row['descuentoMonto'], 1);
        $pdf->Cell(35, 10, $row['descuentoMaximo'], 1);
        $pdf->Cell(35, 10, $row['subtotal'], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Ln(10);
    $pdf->Cell(0, 10, 'No se encontraron productos para este ID.', 0, 1);
}

// Nombre del archivo PDF de salida
$pdfFileName = "productos.pdf";

// Generar el PDF y mostrarlo en el navegador
$pdf->Output($pdfFileName, 'I');
?>
