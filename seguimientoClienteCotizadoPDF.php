<?php
require('fpdf/fpdf.php');
require('includes/conexion.php');

// Clase personalizada que extiende FPDF
class PDF extends FPDF {
    function ProductsTable($header, $data) {
        // Encabezados
        foreach ($header as $col) {
            $this->Cell(35, 10, $col, 1);
        }
        $this->Ln();
        // Datos de productos
        foreach ($data as $row) {
            foreach ($row as $col) {
                $this->Cell(35, 10, $col, 1);
            }
            $this->Ln();
        }
    }
}

// Función para consultar los datos de productos
function consultarProductos($con, $id) {
    $query = "SELECT nombreProducto, moneda, precioPrincipal, precioSecundario, cantidad, descuentoMonto, descuentoMaximo, subtotal
              FROM tabla_productos
              WHERE id_form_web = $id";

    $result = mysqli_query($con, $query);

    $productos = array();

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $productos[] = $row;
        }
    }

    return $productos;
}

// Obtener el ID de la URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];
} else {
    die("ID no proporcionado en la URL");
}

// Consultar los datos de los productos insertados
$productos = consultarProductos($con, $id);

// Crear una instancia de la clase PDF
$pdf = new PDF();
$pdf->AddPage();

// Definir encabezados y datos de productos
$header = array("Nombre Producto", "Moneda", "Precio Principal", "Precio Secundario", "Cantidad", "Descuento Monto", "Descuento Máximo", "Subtotal");

// Generar la tabla de productos
$pdf->ProductsTable($header, $productos);

// Nombre del archivo PDF de salida
$pdfFileName = "productos.pdf";

// Generar el PDF y mostrarlo en el navegador
$pdf->Output($pdfFileName, 'D');
?>
