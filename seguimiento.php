<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}
include 'includes/conexion.php'; // Incluir el archivo de conexión


// Obtener el valor de $idUrl desde la URL
$idUrl = $_GET['id'];
$Original = $_GET['or'];

// Realizar la consulta SQL para obtener los valores de email, telefono, mensaje, fecha e id_user
$selectQuery = "SELECT * FROM web_formularios WHERE id_form_web = $idUrl";
$selectResult = mysqli_query($con, $selectQuery);

// Verificar si se obtuvieron resultados
if (mysqli_num_rows($selectResult) > 0) {
    // Obtener el primer resultado de la consulta
    $selectRow = mysqli_fetch_assoc($selectResult);

    // Obtener los valores y almacenarlos en variables
    $datosForm = $selectRow['datos_form'];
    $email = $selectRow['email'];
    $telefono = $selectRow['telefono'];
    $mensaje = $selectRow['mensaje'];
    $fecha = $selectRow['fecha'];
    $id_user = $selectRow['id_user'];
    $documento = $selectRow['documentoCliente'];
    $formActualizado = $selectRow['formActualizado'];
    $url = $selectRow['URL'];
    $nombreFormulario = $selectRow['nombre_formulario'];
    $ipFormulario = $selectRow['ip_formulario'];
    $prospecto = $selectRow['prospecto'];
    $tipoCliente = $selectRow['tipoCliente'];
    $mensajeOriginal = $selectRow['mensajeOriginal'];
    $idOriginal = $selectRow['idOriginal'];
    $fuenteDato = $selectRow['fuente_dato'];


    $aterrizajeURL = '';

    $parts = parse_url($url);
    if (isset($parts['query'])) {
        parse_str($parts['query'], $query);
        if (isset($query['utm_campaign'])) {
            $aterrizajeURL = $query['utm_campaign'];
        }
    }
} else {
    // Si no se encontraron resultados, asignar valores predeterminados a las variables
    $datosForm = "";
    $email = "";
    $telefono = "";
    $mensaje = "";
    $fecha = "";
    $id_user = "";
}
// Realizar la consulta a la base de datos
$queryUser = "SELECT nombre_user FROM user WHERE id_user = '$id_user'";
$resultUser = mysqli_query($con, $queryUser);
$rowUser = mysqli_fetch_assoc($resultUser);
$nombreUserEdicion = $rowUser['nombre_user'];



$queryNoAtendidos = "SELECT COUNT(*) AS countNoAtendidos FROM web_formularios WHERE estado_web = 0";
$resultNoAtendidos = mysqli_query($con, $queryNoAtendidos);

if ($resultNoAtendidos) {
    $rowNoAtendidos = mysqli_fetch_assoc($resultNoAtendidos);
    $noAtendidos = $rowNoAtendidos['countNoAtendidos'];
} else {
    $noAtendidos = 0; // Si hay un error en la consulta, establecemos el valor en 0
}

$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];

// Cerrar la conexión a la base de datos



?>

<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Atencion Cliente</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="assets/libs/select2/css/select2.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">
    <link href="assets/libs/spectrum-colorpicker2/spectrum.min.css" rel="stylesheet" type="text/css">
    <link href="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.css" rel="stylesheet">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        .atributo-no-coincide {
            background-color: #ffcccc;
            /* Cambia el fondo a rojo claro */
            font-weight: bold;
            /* Hace que el texto sea negrita */
            color: red;
            /* Cambia el color del texto a rojo */
        }
    </style>

</head>

<body data-topbar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

    <!-- Begin page -->
    <div id="layout-wrapper">

        <?php
        include './parts/nav.php';
        include './parts/menuVertical.php'
        ?>

        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">

            <div class="page-content">
                <div class="container-fluid">

                    <!-- start page title -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                                <h4 class="mb-sm-0">Atencion de Cliente </h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Forms</a></li>
                                        <li class="breadcrumb-item active">Form Advanced</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->


                    <div class="row">
                        <div class="col-lg-6">


                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Datos del Cliente </h4>
                                    <br>
                                    <!-- datos de api -->

                                    <!-- fin de datos api -->

                                    <!--   <form id="myForm" action="includes/guardar_user.php" method="post"> -->
                                    <form id="myForm" action="includes/guardar_webformActualizado.php" method="post">
                                        <div class="row">
                                            <div class="col-lg-12">


                                                <br>
                                                <!-- inicio -->
                                                <div class="mb-12">

                                                    <label for="fuenteDato" class="form-label">Tipo de Documento</label>

                                                    <select class="form-control select2" id="fuenteDato" name="fuenteDato">
                                                        <option value="">Seleccione un tipo de documento</option>
                                                        <option value="DNI">DNI</option>
                                                        <option value="RUC">RUC</option>
                                                        <option value="Carnet de Extranjería">Carnet de Extranjería</option>
                                                        <option value="Pasaporte">Pasaporte</option>
                                                    </select>

                                                </div>


                                                <br>
                                                <!-- end row -->
                                                <div class="row mb-6">
                                                    <label for="example-tel-input" class="col-sm-2 col-form-label">Telefono</label>
                                                    <div class="col-sm-10">
                                                        <a href="https://api.whatsapp.com/send?phone=<?php echo "51" . $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
                                                        <input type="hidden" class="form-control" name="telefono" value="<?php echo $telefono ?>" readonly>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                                <br>
                                                <div class="row mb-3">
                                                    <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="email" value="<?php echo $email; ?>" id="example-email-input" name="email" readonly>
                                                    </div>
                                                </div>
                                                <!-- end row -->
                                                <div class="mb-12">
                                                    <label class="form-label">Tipo de Cliente</label>

                                                    <select class="form-control select2" id="fuenteDato" name="fuenteDato">
                                                        <?php
                                                        include 'includes/conexion.php';
                                                        // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                        $query = "SELECT * FROM tipoClienteCliente WHERE empresaEstado = $empresaUser2";
                                                        $result = mysqli_query($con, $query);

                                                        // Verificar si se encontraron resultados
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Generar las opciones dentro del select
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $value = $row['valorTipoCliente'];
                                                                $text = $row['descripcionTipoCliente'];

                                                                // Verificar si el valor coincide con $fuenteDato
                                                                $selected = ($fuenteDato == $value) ? 'selected' : '';

                                                                echo "<option value='" . $value . "' " . $selected . ">" . $text . "</option>";
                                                            }
                                                        }

                                                        // Cerrar la conexión a la base de datos
                                                        mysqli_close($con);
                                                        ?>
                                                    </select>



                                                </div>
                                                <div class="mt-6">
                                                    <br>
                                                    <label class="mb-1">Fuente : </label>


                                                    <?php
                                                    include 'includes/conexion.php';
                                                    if (empty($id_user)) {
                                                        if ($_GET['pr'] == "Google ADS") {
                                                            $fuenteOriginal = 2;
                                                        } elseif ($_GET['pr'] == "Meta ADS") {
                                                            $fuenteOriginal = 3;
                                                        } else {
                                                            $fuenteOriginal = 1;
                                                        }
                                                    } else {
                                                        $fuenteOriginal = $prospecto;
                                                    }
                                                    $query = "SELECT descripcionFuente, colorFuente FROM fuente WHERE tipoFuente = '$fuenteOriginal'";
                                                    $result = mysqli_query($con, $query);

                                                    if ($result && mysqli_num_rows($result) > 0) {
                                                        $row = mysqli_fetch_assoc($result);
                                                        $descripcionFuente = $row['descripcionFuente'];
                                                        $colorFuente = $row['colorFuente'];

                                                        echo '<span class="badge rounded-pill" style="background-color: ' . $colorFuente . ';">' . $descripcionFuente . '</span>';
                                                        echo '<input class="form-control" type="hidden" id="example-text-input" name="fuente" value="' . $fuenteOriginal . '" readonly>';
                                                    } else {
                                                        echo '<span class="badge rounded-pill">SIN FUENTE</span>';
                                                    }

                                                    mysqli_close($con);
                                                    ?>

                                                </div>
                                                <br>
                                                <div class="mb-12">
                                                    <label class="form-label">Estado</label>
                                                    <select class="form-control select2" id="tipoCliente" name="tipoCliente">
                                                        <?php
                                                        include 'includes/conexion.php';
                                                        // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                        $query = "SELECT * FROM tipoCliente";
                                                        $result = mysqli_query($con, $query);

                                                        // Verificar si se encontraron resultados
                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Generar las opciones dentro del select
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $value = $row['valorTipoCliente'];
                                                                $text = $row['descripcionTipoCliente'];

                                                                // Verificar si el valor actual coincide con $tipoCliente
                                                                if ($value == $tipoCliente) {
                                                                    echo "<option value='" . $value . "' selected>" . $text . "</option>";
                                                                } else {
                                                                    echo "<option value='" . $value . "'>" . $text . "</option>";
                                                                }
                                                            }
                                                        }

                                                        // Cerrar la conexión a la base de datos
                                                        mysqli_close($con);
                                                        ?>
                                                    </select>
                                                </div>

                                                <br>

                                                <!-- Campo de selección múltiple para atributos -->
                                                <!-- <div id="cotizar" style="display: none;"> -->
                                                <div id="cotizar" style="display: none;">
                                                    <div class="mb-12">
                                                        <!-- Radio buttons para elegir moneda -->
                                                        <div class="row mb-3">
                                                            <label class="col-sm-2 col-form-label">Moneda</label>
                                                            <div class="col-sm-10">
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="moneda" id="monedaSoles" value="0" checked>
                                                                    <label class="form-check-label" for="monedaSoles">Soles</label>
                                                                </div>
                                                                <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio" name="moneda" id="monedaDolares" value="1">
                                                                    <label class="form-check-label" for="monedaDolares">Dólares</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- inicio -->
                                                        

                                                        <!-- fin -->
                                                        <label class="form-label">Atributos</label>
                                                        <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Selecciona atributos del Producto" id="atributosSelect">
                                                            <?php
                                                            require 'includes/conexion.php'; // Incluimos el archivo de conexión

                                                            $query = "SELECT ID, Atributo FROM atributos";
                                                            $result = mysqli_query($con, $query);

                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $atributoID = $row['ID'];
                                                                $atributoNombre = $row['Atributo'];
                                                                echo "<option value='$atributoID'>$atributoNombre</option>";
                                                            }

                                                            // Liberar el resultado
                                                            mysqli_free_result($result);

                                                            // Cerrar la conexión
                                                            mysqli_close($con);
                                                            ?>
                                                        </select>
                                                    </div>

                                                    <br>

                                                    <!-- Campos de información del producto -->
                                                    <div class="row mb-3">
                                                        <label for="producto" class="col-sm-2 col-form-label">Producto</label>
                                                        <div class="col-sm-4">
                                                            <input class="form-control" type="text" id="producto" name="producto" readonly>
                                                        </div>
                                                        <label for="precioPrincipal" class="col-sm-2 col-form-label">Precio Principal</label>
                                                        <div class="col-sm-2">
                                                            <input class="form-control" type="text" id="precioPrincipal" name="precioPrincipal" readonly>
                                                        </div>
                                                    </div>

                                                    <!-- Otros campos relacionados con el producto -->
                                                    <div class="row mb-3">
                                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripción</label>
                                                        <div class="col-sm-4">
                                                            <input class="form-control" type="text" id="descripcion" name="descripcion" readonly>
                                                        </div>
                                                        <label for="precioSecundario" class="col-sm-2 col-form-label">Precio Secundario</label>
                                                        <div class="col-sm-2">
                                                            <input class="form-control" type="text" id="precioSecundario" name="precioSecundario" readonly>
                                                        </div>
                                                    </div>

                                                    <div class="row mb-3">
                                                        <label for="descuentoGeneral" class="col-sm-2 col-form-label">Descuento General</label>
                                                        <div class="col-sm-4">
                                                            <input class="form-control" type="text" id="descuentoGeneral" name="descuentoGeneral" readonly>
                                                        </div>
                                                        <!-- Los demás campos aquí... -->
                                                    </div>



                                                    <!-- Botón Agregar -->
                                                    <div class="row mb-3">
                                                        <div class="col-sm-2 offset-sm-10">
                                                            <button type="button" class="btn btn-primary agregarProducto">Agregar</button>
                                                        </div>
                                                    </div>


                                                    <!-- Agregar tabla para mostrar los productos seleccionados -->
                                                    <table class="table">
                                                        <thead>
                                                            <tr>
                                                                <th>Nombre del Producto</th>
                                                                <th>Moneda</th>
                                                                <th>Precio Principal</th> <!-- Cambiar el encabezado a "Precio Principal" -->
                                                                <th>Precio Secundario</th> <!-- Nueva columna para Precio Secundario -->
                                                                <th>Cantidad</th>
                                                                <th>Descuento en Monto</th>
                                                                <th>Descuento Máximo</th> <!-- Nueva columna -->
                                                                <th>Subtotal</th>
                                                                <th>Eliminar</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="tablaProductos">
                                                            <!-- Filas de productos -->
                                                        </tbody>
                                                    </table>




                                                    <!-- Mostrar el total de la compra -->
                                                    <div>
                                                        <strong>Total: </strong><span id="total">0</span>


                                                    </div>

                                                    <!-- fin del div cotizar -->
                                                </div>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                                                <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
                                                <script>
                                                    $(document).ready(function() {
                                                        var tipoClienteSelect = $('#tipoCliente');
                                                        var cotizarDiv = $('#cotizar');

                                                        // Oculta el div al iniciar
                                                        cotizarDiv.hide();

                                                        tipoClienteSelect.on('change', function() {
                                                            var selectedValue = $(this).val();

                                                            if (selectedValue == 6) {
                                                                cotizarDiv.show();
                                                            } else {
                                                                cotizarDiv.hide();
                                                            }
                                                        });

                                                        $("input[name='moneda']").on('change', function() {
                                                            actualizarTabla(); // Llamar a actualizarTabla cuando cambia la moneda
                                                        });
                                                        $('.select2-multiple').select2();

                                                        var productosSeleccionados = []; // Almacenar los productos seleccionados

                                                        // Actualizar la tabla de productos seleccionados
                                                        function actualizarTabla() {
                                                            var total = 0;

                                                            // Limpiar la tabla antes de actualizarla
                                                            $('#tablaProductos').empty();

                                                            // Obtener el tipo de moneda seleccionada (0 para Soles y 1 para Dólares)
                                                            var tipoMonedaSeleccionada = parseInt($("input[name='moneda']:checked").val());

                                                            // Recorrer los productos seleccionados
                                                            productosSeleccionados.forEach(function(producto) {
                                                                var cantidad = parseInt(producto.cantidad) || 1;
                                                                var precioPrincipal = parseFloat(producto.PrecioPrincipal); // Precio Principal
                                                                var precioSecundario = parseFloat(producto.PrecioSecundario); // Precio Secundario
                                                                var descuentoGeneral = parseFloat(producto.DescuentoGeneral) || 0; // Descuento General

                                                                // Calcular el subtotal sin considerar el descuento
                                                                var subtotal = cantidad * precioPrincipal; // Usar el precio principal

                                                                // Aplicar el descuento al subtotal del producto
                                                                subtotal -= descuentoGeneral;

                                                                total += subtotal;

                                                                var simboloMoneda = (tipoMonedaSeleccionada === 0) ? 'S/' : '$';

                                                                var fila = '<tr>' +
                                                                    '<td><input type="text" name="nombreProducto[]" value="' + producto.Nombre + '"></td>' +
                                                                    '<td><input type="text" name="moneda[]" value="' + (tipoMonedaSeleccionada === 0 ? 'S/' : '$') + '" style="width: 40px;"></td>' + // Ancho de 40px para Moneda
                                                                    '<td><input type="text" name="precioPrincipal[]" value="' + producto.PrecioPrincipal.toFixed(2) + '" style="width: 50px;"></td>' + // Ancho de 50px para Precio Principal
                                                                    '<td><input type="text" name="precioSecundario[]" value="' + producto.PrecioSecundario.toFixed(2) + '" style="width: 50px;"></td>' + // Ancho de 50px para Precio Secundario
                                                                    '<td><input type="text" name="cantidad[]" value="' + cantidad + '" style="width: 50px;"></td>' + // Ancho de 50px para Cantidad
                                                                    '<td><input type="text" name="descuentoMonto[]" value="' + descuentoGeneral + '" style="width: 50px;"></td>' + // Ancho de 50px para Descuento Monto
                                                                    '<td><input type="text" name="descuentoMaximo[]" value="' + producto.DescuentoMaximo + '" style="width: 50px;"></td>' + // Ancho de 50px para Descuento Máximo
                                                                    '<td><input type="text" name="subtotal[]" value="' + subtotal.toFixed(2) + '" style="width: 50px;"></td>' + // Ancho de 50px para Subtotal
                                                                    '<td><button class="btn btn-danger eliminarFila">Eliminar</button></td>' +
                                                                    '</tr>';

                                                                $('#tablaProductos').append(fila);
                                                            });


                                                            // Actualizar el total
                                                            $('#total').text(total.toFixed(2));
                                                        }




                                                        $('.agregarProducto').on('click', function() {
                                                            var productoNombre = $('#producto').val();
                                                            var productoPrecio = $('#precio').val();
                                                            var descuentoMaximo = parseFloat($('#descuentoMax').val()) || 0; // Nuevo campo para el descuento máximo

                                                            if (productoNombre && productoPrecio) {
                                                                agregarProducto(productoNombre, parseFloat(productoPrecio), 0, descuentoMaximo); // Agregar el descuento máximo al llamar a agregarProducto
                                                            }
                                                        });

                                                        function updateProduct() {
                                                            var selectedAtributos = $('.select2-multiple').val();
                                                            var tipoMonedaSeleccionada = $("input[name='moneda']:checked").val();

                                                            $.ajax({
                                                                type: 'POST',
                                                                url: 'includes/buscarProducto.php',
                                                                data: {
                                                                    atributos: selectedAtributos,
                                                                    tipoMoneda: tipoMonedaSeleccionada
                                                                },
                                                                success: function(response) {
                                                                    if (response.startsWith('Ningún producto coincide con los atributos seleccionados.')) {
                                                                        var atributoID = response.split('.').pop().trim();
                                                                        $('#atributosSelect option[value="' + atributoID + '"]').css('background-color', 'red');
                                                                        $('#producto').val('Ningún producto coincide');
                                                                        $('#precioPrincipal').val(''); // Cambia el campo a 'precioPrincipal'
                                                                    } else {
                                                                        $('#atributosSelect option').css('background-color', '');
                                                                        var productoInfo = JSON.parse(response);
                                                                        $('#producto').val(productoInfo.Nombre);
                                                                        $('#precioPrincipal').val(productoInfo.PrecioPrincipal); // Cambia el campo a 'precioPrincipal'
                                                                        $('#descripcion').val(productoInfo.Descripcion);
                                                                        $('#precioSecundario').val(productoInfo.PrecioSecundario); // Agrega el campo 'precioSecundario'
                                                                        $('#descuentoGeneral').val(productoInfo.DescuentoGeneral); // Agrega el campo 'descuentoGeneral'
                                                                        console.log(productoInfo);
                                                                    }
                                                                }
                                                            });
                                                        }



                                                        function agregarProducto(nombre, precioPrincipal, precioSecundario, descuentoGeneral) {
                                                            console.log('Nombre:', nombre);
                                                            console.log('Precio Principal:', precioPrincipal);
                                                            console.log('Precio Secundario:', precioSecundario);
                                                            console.log('Descuento General:', descuentoGeneral);
                                                            var tipoMonedaSeleccionada = parseInt($("input[name='moneda']:checked").val());

                                                            productosSeleccionados.push({
                                                                Nombre: nombre,
                                                                PrecioPrincipal: parseFloat(precioPrincipal), // Usar el valor proporcionado
                                                                PrecioSecundario: parseFloat(precioSecundario), // Usar el valor proporcionado
                                                                DescuentoGeneral: parseFloat(descuentoGeneral), // Usar el valor proporcionado
                                                                cantidad: 1,
                                                                tipoMoneda: tipoMonedaSeleccionada
                                                            });

                                                            // Limpiar todos los campos relacionados con la información del producto
                                                            $('#producto').val('');
                                                            $('#precioPrincipal').val('');
                                                            $('#precioSecundario').val('');
                                                            $('#descuentoGeneral').val('');
                                                            $('#descripcion').val(''); // Limpiar también la casilla de descripción
                                                            $('.select2-multiple').val(null).trigger('change');

                                                            actualizarTabla(); // Actualizar la tabla después de agregar el producto
                                                        }





                                                        $('.select2-multiple').on('change', function() {
                                                            updateProduct();
                                                        });

                                                        $('.agregarProducto').on('click', function() {
                                                            var productoNombre = $('#producto').val();
                                                            var productoPrecioPrincipal = parseFloat($('#precioPrincipal').val());
                                                            var productoPrecioSecundario = parseFloat($('#precioSecundario').val());
                                                            var productoDescuentoGeneral = parseFloat($('#descuentoGeneral').val());

                                                            if (productoNombre) {
                                                                agregarProducto(productoNombre, productoPrecioPrincipal, productoPrecioSecundario, productoDescuentoGeneral);
                                                            }
                                                        });




                                                        // Actualizar la tabla cuando cambia la cantidad
                                                        $('#tablaProductos').on('change', '.cantidad', function() {
                                                            var index = $(this).closest('tr').index();
                                                            var nuevaCantidad = parseInt($(this).val()) || 1;
                                                            productosSeleccionados[index].cantidad = nuevaCantidad;
                                                            actualizarTabla();
                                                        });

                                                        // Eliminar un producto de la tabla
                                                        $('#tablaProductos').on('click', '.eliminar', function() {
                                                            var index = $(this).closest('tr').index();
                                                            productosSeleccionados.splice(index, 1);
                                                            actualizarTabla();
                                                        });
                                                    });
                                                </script>



                                                <div class="mt-6">
                                                    <label class="mb-1">Comentario</label>

                                                    <textarea id="textarea" class="form-control" maxlength="30" rows="3" name="comentario"></textarea>

                                                </div>
                                                <br>
                                                <?php
                                                $prospectoExistente = $_GET['pr'];
                                                // Restar 5 horas a la fecha
                                                $nuevaFecha = date('Y-m-d H:i:s', strtotime($fecha . ' -5 hours'));
                                                ?>


                                                <input type="hidden" class="form-control" id="id-input" name="idweb" readonly>

                                                <script>
                                                    // Obtener el valor de la variable "id" de la URL
                                                    const urlParams = new URLSearchParams(window.location.search);
                                                    const id = urlParams.get('id');

                                                    // Establecer el valor en el input
                                                    document.getElementById('id-input').value = id;
                                                </script>
                                                <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?php echo $_SESSION['idUser']; ?>" readonly>

                                                <input type="hidden" id="pr" name="pr" class="form-control" value="<?php echo $_GET['pr']; ?>" readonly>
                                                <input type="hidden" id="idid" name="idid" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>
                                                <input type="hidden" name="URL" class="form-control" value="<?php echo $url; ?>" readonly>
                                                <input type="hidden" name="nombreFormulario" class="form-control" value="<?php echo $nombreFormulario; ?>" readonly>
                                                <input type="hidden" name="ipFormulario" class="form-control" value="<?php echo $ipFormulario; ?>" readonly>
                                                <input type="hidden" name="aterrizaje" class="form-control" value="<?php echo $aterrizajeURL; ?>" readonly>

                                                <?php
                                                // Verificar si $formActualizado está vacío
                                                if (empty($formActualizado)) {
                                                    echo '<input type="hidden" name="formActualizado" class="form-control" value="1" readonly>';
                                                } else {
                                                    echo '<input type="hidden" name="formActualizado" class="form-control" value="' . $formActualizado . '" readonly>';
                                                }
                                                ?>



                                                <input type="hidden" id="iduser" name="empresaUser" class="form-control" value="<?php echo $_SESSION['empresaUser']; ?>" readonly>
                                                <?php if (empty($mensajeOriginal)) : ?>
                                                    <input type="hidden" id="mensajeOriginal" name="mensajeOriginal" class="form-control" value="<?php echo $mensaje; ?>" readonly>

                                                <?php else : ?>
                                                    <input type="hidden" id="mensajeOriginal" name="mensajeOriginal" class="form-control" value="<?php echo $mensajeOriginal; ?>" readonly>
                                                <?php endif; ?>

                                                <br>
                                                <?php if (empty($idOriginal)) : ?>
                                                    <input type="hidden" id="idOriginal" name="idOriginal" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>

                                                <?php else : ?>
                                                    <input type="hidden" id="idOriginal" name="idOriginal" class="form-control" value="<?php echo $idOriginal; ?>" readonly>
                                                <?php endif; ?>
                                                <br>


                                                <center>
                                                    <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Actualizar Datos</button>
                                                </center>







                                            </div>
                                            <!-- end col -->

                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                    </form>






                                    <!-- end form -->
                                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                                    <!-- end form -->
                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>

                        <!-- inicio linea del tiempo -->
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body bg-transparent">
                                    <div class="dropdown float-end">
                                        <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                            <i class="mdi mdi-dots-vertical text-muted"></i>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end">
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                            <!-- item-->
                                            <a href="javascript:void(0);" class="dropdown-item">Another action</a>
                                            <!-- item-->
                                        </div>
                                    </div>
                                    <!-- end dropdown -->
                                    <?php
                                    // Incluir el archivo de conexión
                                    include('includes/conexion.php');

                                    $sqlConsulta = "SELECT COUNT(*) AS total, MIN(fecha) AS primera_fecha, MAX(fecha) AS ultima_fecha
               FROM web_formularios 
               WHERE idOriginal = $idUrl OR id_form_web = $idUrl OR idOriginal = $Original OR id_form_web = $Original";

                                    // Ejecutar la consulta
                                    $resultadoConsulta = mysqli_query($con, $sqlConsulta);

                                    // Verificar si hay resultados
                                    if ($resultadoConsulta) {
                                        // Obtener el resultado como un array asociativo
                                        $filaConsulta = mysqli_fetch_assoc($resultadoConsulta);

                                        // Obtener la primera y última fecha
                                        $primeraFechaConsulta = $filaConsulta['primera_fecha'];
                                        $ultimaFechaConsulta = $filaConsulta['ultima_fecha'];

                                        // Calcular la diferencia entre la última y la primera fecha en segundos
                                        $diferenciaSegundosConsulta = strtotime($ultimaFechaConsulta) - strtotime($primeraFechaConsulta);

                                        // Calcular la diferencia en días, horas, minutos y segundos
                                        $diferenciaDias = floor($diferenciaSegundosConsulta / (60 * 60 * 24));
                                        $diferenciaHoras = floor(($diferenciaSegundosConsulta % (60 * 60 * 24)) / (60 * 60));
                                        $diferenciaMinutos = floor(($diferenciaSegundosConsulta % (60 * 60)) / 60);
                                        $diferenciaSegundos = $diferenciaSegundosConsulta % 60;

                                        // Mostrar la diferencia de fechas
                                        echo "Diferencia de fechas: $diferenciaDias días, $diferenciaHoras horas, $diferenciaMinutos minutos y $diferenciaSegundos segundos";

                                        // Liberar el resultado
                                        mysqli_free_result($resultadoConsulta);
                                    } else {
                                        // Manejar error en la consulta
                                        echo "Error en la consulta: " . mysqli_error($con);
                                    }
                                    // Cerrar la conexión
                                    mysqli_close($con);
                                    ?>

                                    <h4 class="card-title mb-4">Eventos</h4>

                                    <div class="pe-lg-3" data-simplebar style="max-height: 350px;">
                                        <ul class="list-unstyled activity-wid">
                                            <?php
                                            // Incluye el archivo con la conexión
                                            include 'includes/conexion.php';  // Asegúrate de cambiar el nombre del archivo

                                            // Consulta a la base de datos
                                            $sql = "SELECT * FROM web_formularios WHERE idOriginal = $idUrl OR id_form_web = $idUrl OR idOriginal = $Original OR id_form_web = $Original order by fecha desc ";

                                            $result = mysqli_query($con, $sql);

                                            // Generar elementos para cada fila de la consulta
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $fechaRestada = date("Y-m-d H:i:s", strtotime($row["fecha"]) - 5 * 3600);

                                                $fecha2 = substr($fechaRestada, 0, 10);
                                                // Consulta para obtener los detalles del usuario
                                                $userId = $row["id_user"];
                                                $userQuery = "SELECT * FROM user WHERE id_user = '$userId'";
                                                $userResult = mysqli_query($con, $userQuery);
                                                $userData = mysqli_fetch_assoc($userResult);

                                                $tipoClienteLinea = $row["tipoCliente"];
                                                $clienteQuery = "SELECT * FROM tipoCliente WHERE idTipoCliente = '$tipoClienteLinea'";
                                                $clienteResult = mysqli_query($con, $clienteQuery);
                                                $clienteData = mysqli_fetch_assoc($clienteResult);

                                            ?>
                                                <!-- start li -->
                                                <li class="activity-list border-left">
                                                    <div class="activity-icon avatar-xs">
                                                        <span class="avatar-title bg-soft-primary text-primary rounded-circle">
                                                            <i class="ri-edit-2-fill"></i>
                                                        </span>
                                                    </div>
                                                    <div>
                                                        <div class="d-flex">
                                                            <div class="flex-1">
                                                                <h5 class="font-size-13"><?php echo $fecha2; ?></h5>
                                                            </div>
                                                            <div>
                                                                <small class="text-muted"><?php echo date("h:i a", strtotime($fechaRestada)); ?></small>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <p class="text-muted mb-0"><?php echo $row["mensaje"]; ?></p>
                                                        </div>
                                                        <div>

                                                            <?php

                                                            $descrpCliente = $clienteData["descripcionTipoCliente"];
                                                            $colorCliente = $clienteData["colorTipoCliente"];

                                                            echo "<td><span class=\"badge rounded-pill\" style=\"background-color: $colorCliente;\">$descrpCliente</span></td>";
                                                            ?>
                                                        </div>
                                                        <div>
                                                            <p class="text-muted mb-0"><?php
                                                                                        $nombreUsuarioAtencion = ucwords(strtolower($userData["nombre_user"]));

                                                                                        echo $nombreUsuarioAtencion; ?></p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <!-- end li -->
                                            <?php
                                            }

                                            // Cierra la conexión
                                            mysqli_close($con);
                                            ?>
                                        </ul>
                                        <!-- end ul -->
                                    </div>
                                </div>
                                <!-- end body -->
                                <div>

                                </div>
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->



                        <!-- FIN LINEA TIEMPO -->

                    </div>
                    <!-- end col -->


                </div>
                <!-- end row -->


            </div>
            <!-- container-fluid -->
        </div>
        <!-- End Page-content -->
        <?php include './parts/footer.php'; ?>
    </div>
    <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <?php include './parts/sidebar.php'; ?>
    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/libs/select2/js/select2.min.js"></script>
    <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
    <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
    <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
    <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
    <script src="assets/js/pages/form-advanced.init.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>