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


// Definir las características de la tabla
$tbl = '<table border="2" cellpadding="2" cellspacing="0" style="border-color: #009ecd; border-radius: 10px; border-width: 2px;">';

// Primera columna con una imagen
$tbl .= '<tr>';
$tbl .= '<td rowspan="3"><img src="imagen.jpg" width="100" height="100"></td>'; // Cambia "imagen.jpg" por la ruta de tu imagen
$tbl .= '<td>Texto 1</td>';
$tbl .= '</tr>';

// Segunda columna dividida en 3 filas
$tbl .= '<tr>';
$tbl .= '<td>Texto 2</td>';
$tbl .= '</tr>';

$tbl .= '<tr>';
$tbl .= '<td>Texto 3</td>';
$tbl .= '</tr>';

// Tercera columna dividida en 2 filas
$tbl .= '<tr>';
$tbl .= '<td rowspan="2">Texto 4</td>';
$tbl .= '</tr>';

$tbl .= '<tr>';
$tbl .= '<td>Texto 5</td>';
$tbl .= '</tr>';

$tbl .= '</table>';

// Agregar la tabla al PDF
$pdf->writeHTML($tbl, true, false, false, false, '');

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
