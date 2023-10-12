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
// Establecer bordes redondeados y ancho de línea
$pdf->SetLineStyle(array('width' => 0.2, 'color' => array(0, 158, 205)));

// Definir la estructura de la tabla con 3 columnas
$data = array(
    array(
        '<img src="assets/images/geoprime1.jpg" width="80" height="80" />', // Primera columna con imagen
        array('Texto 1', 'Texto 2', 'Texto 3'), // Segunda columna con 3 filas
        array('Texto 4', 'Texto 5') // Tercera columna con 2 filas
    )
);

// Establecer el tamaño de las columnas
$col_width = 60;
$col_height = 20;

// Iterar sobre los datos y agregar celdas a la tabla
foreach ($data as $row) {
    foreach ($row as $col) {
        if (is_array($col)) {
            foreach ($col as $subcol) {
                $pdf->Cell($col_width, $col_height, $subcol, 1, 0, 'C');
            }
            $pdf->Ln();
        } else {
            $pdf->Cell($col_width, $col_height, $col, 1, 0, 'C');
        }
    }
    $pdf->Ln();
}

// Definir el tamaño y tipo de fuente
$pdf->SetFont('helvetica', '', 12);

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
$pdf->Image('assets/images/geoprime1.jpg', 0, 0, 210);

// Agregar una nueva página
$pdf->AddPage();

// Insertar la imagen en la nueva página (tercera página) y ajustar el tamaño para que ocupe toda la página
$pdf->Image('assets/images/geoprime2.jpg', 0, 0, 210);

// Nombre del archivo PDF de salida
$pdfFileName = "productos.pdf";

// Generar el PDF y mostrarlo en el navegador
$pdf->Output($pdfFileName, 'I');
?>
