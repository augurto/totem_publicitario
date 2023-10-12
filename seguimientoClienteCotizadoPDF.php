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
$pdf->Cell(0, 10, 'Tabla Personalizada', 0, 1, 'C');
$pdf->Ln(10);

// Definir las características de la tabla
$bordeColor = 128; // Color en escala de grises (0-255)
$bordeAncho = 2;  // Grosor del borde en puntos (1 punto = 1/72 pulgadas)
$radioBorde = 10; // Radio del borde en puntos
$anchoColumna = 60; // Ancho de cada columna en puntos
$altoCelda = 20; // Altura de cada celda en puntos

// Iniciar la fila de la tabla
$pdf->Cell($anchoColumna, $altoCelda, 'Columna 1', 1, 0, 'C');
$pdf->Cell($anchoColumna, $altoCelda, 'Columna 2', 1, 0, 'C');
$pdf->Cell($anchoColumna, $altoCelda, 'Columna 3', 1, 1, 'C');

// Establecer el color y grosor del borde
$pdf->SetLineWidth($bordeAncho);
$pdf->SetDrawColor($bordeColor);

// Fila 1
$pdf->Cell($anchoColumna, $altoCelda, 'Texto 1, Fila 1', 1);
$pdf->Cell($anchoColumna, $altoCelda, 'Texto 2, Fila 1', 1);
$pdf->Cell($anchoColumna, $altoCelda, 'Texto 3, Fila 1', 1, 1);

// Fila 2
$pdf->Cell($anchoColumna, $altoCelda, 'Texto 1, Fila 2', 1);
$pdf->Cell($anchoColumna, $altoCelda, 'Texto 2, Fila 2', 1);
$pdf->Cell($anchoColumna, $altoCelda, 'Texto 3, Fila 2', 1, 1);

// Restablecer el grosor del borde
$pdf->SetLineWidth(0);

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
