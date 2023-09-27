<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}
include 'includes/conexion.php'; // Incluir el archivo de conexión

$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Reporte de Ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- jquery.vectormap css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
</head>

<body data-topbar="dark">
    <!-- <body data-layout="horizontal" data-topbar="dark"> -->

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
                            <h4 class="mb-sm-0">Reporte de Ventas </h4>
                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                    <li class="breadcrumb-item active">Reporte de ventas</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
                <!-- Inicio bloque 1 -->
                <!-- end row -->
                <div class="row">
                            <div class="col-lg-6">
                                <div class="card">
                                    
                                    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
                                    
                                </div><!--end card-->
                            </div>
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Pie Chart</h4>
                                        
                                        <div id="pie_chart" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div>
                            </div>
                        </div> 
                        <script type="text/javascript">
                            document.addEventListener("DOMContentLoaded", function () {
                                var jsonData = <?php echo json_encode($data); ?>;
                                var categorias = <?php echo json_encode($categorias); ?>;

                                var options = {
                                    chart: { height: 350, type: "bar", toolbar: { show: !1 } },
                                    plotOptions: {
                                        bar: { horizontal: !1, columnWidth: "45%", endingShape: "rounded" },
                                    },
                                    dataLabels: { enabled: !1 },
                                    stroke: { show: !0, width: 2, colors: ["transparent"] },
                                    colors: ["#5867c3", "#34c38f", "#f9c341"],
                                    xaxis: {
                                        categories: categorias, // Utiliza los meses y años como etiquetas
                                    },
                                    yaxis: { title: { text: "$ (thousands)" } },
                                    grid: { borderColor: "#f1f1f1", padding: { bottom: 10 } },
                                    fill: { opacity: 1 },
                                    tooltip: {
                                        y: {
                                            formatter: function (e) {
                                                return "$ " + e + " thousands";
                                            },
                                        },
                                    },
                                    legend: { offsetY: 7 },
                                    series: jsonData.map(function (item) {
                                        return {
                                            name: item.categoria,
                                            data: [item.conteo], // Utiliza el conteo correspondiente a cada categoría
                                        };
                                    }),
                                };

                                var chart = new ApexCharts(
                                    document.querySelector("#column_chart"),
                                    options
                                );
                                chart.render();
                            });
                        </script> 
                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Status</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <!-- end dropdown -->
                                <h4 class="card-title mb-4">Historial de Facturación</h4>
                                <div class="table-responsive">
                                    <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Fuente</th>
                                                <th>Fecha Inicio</th>
                                                <th>Fecha Fin</th>
                                                <th>Inversión</th>
                                                <th>Archivo</th>
                                                <th>Descargar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            // Consulta SQL para obtener los datos de facturacionMKT
                                            $query = "SELECT id_facturacionMKT, fuente, start, end, cantidad, archivo FROM facturacionMKT";
                                            $result = mysqli_query($con, $query);

                                            // Verificar si se encontraron resultados
                                            if ($result) {
                                                $correlativo = 1; // Inicializa el contador

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    // Obtener los valores de la fila
                                                    $id_facturacionMKT = $row['id_facturacionMKT'];
                                                    $fuente = $row['fuente'];
                                                    $start = $row['start'];
                                                    $end = $row['end'];
                                                    $cantidad = $row['cantidad'];
                                                    $archivo = $row['archivo'];

                                                    // Imprimir una fila de la tabla con los datos recuperados y el correlativo
                                                    echo "<tr>";
                                                    echo "<td>$correlativo</td>";
                                                    echo "<td>$fuente</td>";
                                                    echo "<td>$start</td>";
                                                    echo "<td>$end</td>";
                                                    echo "<td>$cantidad</td>";
                                                    echo "<td>$archivo</td>";
                                                    // Agregar una columna con un botón de descarga
                                                    echo "<td><a href='descargar.php?id=$id_facturacionMKT' class='btn btn-primary'>Descargar</a></td>";
                                                    echo "</tr>";

                                                    $correlativo++; // Incrementa el contador
                                                }
                                            } else {
                                                echo "Error en la consulta: " . mysqli_error($con);
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                                    <!-- end table -->
                                </div>
                                <!-- end tableresponsive -->
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-5 col-9">
                                        <h5 class="font-size-15 mb-3">Campañas Digitales</h5>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-7 col-3">
                                        <ul class="list-inline user-chat-nav text-end mb-2">
                                            <li class="list-inline-item">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-magnify text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                                                        <form class="p-2">
                                                            <div class="search-box">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control rounded bg-light border-0" placeholder="Search...">
                                                                    <i class="mdi mdi-magnify search-icon"></i>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- end li -->
                                            <li class="list-inline-item d-none d-sm-inline-block">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-cog text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">View Profile</a>
                                                        <a class="dropdown-item" href="#">Add Product</a>
                                                        <a class="dropdown-item" href="#">Remove Product</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- end li -->
                                        </ul>
                                        <!-- end ul -->
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                    <form action="includes/guardarFacturacionMKT.php" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <?php
                                            // Consulta SQL para obtener las filas donde idAterrizajeFuente = 0
                                            $query = "SELECT id_fuente, descripcionFuente FROM fuente WHERE idAterrizajeFuente = 0";
                                            $result = mysqli_query($con, $query);

                                            // Verificar si se encontraron resultados
                                            if ($result) {
                                                echo '<label class="form-label">Fuente</label>';
                                                echo '<select class="form-control select2" name="fuente">';
                                                echo '<option>Seleccione la fuente</option>';

                                                // Recorrer los resultados y generar las opciones del select
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $id_fuente = $row['id_fuente'];
                                                    $descripcionFuente = $row['descripcionFuente'];
                                                    echo "<option value='$id_fuente'>$descripcionFuente</option>";
                                                }

                                                echo '</select>';
                                            } else {
                                                echo "Error en la consulta: " . mysqli_error($con);
                                            }
                                            ?>
                                        </div>

                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label">Fechas </label>
                                                <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                    <input type="text" class="form-control" name="start" placeholder="Fecha Inicio" />
                                                    <input type="text" class="form-control" name="end" placeholder="Fecha Fin" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label">Inversión </label>
                                                <input type="number" class="form-control" name="cantidad" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Facturación</label>
                                            <input class="form-control" type="file" id="formFile" name="facturacion" />
                                        </div>

                                        <!-- Botón "Enviar" que enviará el formulario a guardarFacturacionMKT.php -->
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary" formaction="includes/guardarFacturacionMKT.php">Enviar</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <!-- FIN bloque 1 -->
               
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

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>

        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>
        <script src="assets/js/app.js"></script>

</body>

</html>