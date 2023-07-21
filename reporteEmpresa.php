
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
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

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
                <div class="row">
                    <?php
                        

                        // Realizar la consulta para obtener los datos de la tabla "venta"
                        $query = "SELECT idVenta, idProducto, nombreProducto, precioProducto, cantidadProducto, montoAdicional, montoTotal, id_web_formularios, rutaArchivo, fechaVenta, estadoVenta, idUser, nombreArchivo, observacionVenta, empresaUser,tipoMoneda FROM ventas";
                        $result = mysqli_query($con, $query);

                        // Verificar si se obtuvieron resultados
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $idVenta = $row['idVenta'];
                                $idProducto = $row['idProducto'];
                                $nombreProducto = $row['nombreProducto'];
                                $precioProducto = $row['precioProducto'];
                                $cantidadProducto = $row['cantidadProducto'];
                                $montoAdicional = $row['montoAdicional'];
                                $montoTotal = $row['montoTotal'];
                                $id_web_formularios = $row['id_web_formularios'];
                                $rutaArchivo = $row['rutaArchivo'];
                                $fechaVenta = $row['fechaVenta'];
                                $nuevaFecha = date('Y-m-d H:i:s', strtotime($fechaVenta . ' -5 hours'));
                                $empresaUser = $row['empresaUser'];
                                $estadoVenta = $row['estadoVenta'];
                                $tipoMoneda = $row['tipoMoneda'];
                                $idUser = $row['idUser'];
                                $nombreArchivo = $row['nombreArchivo'];
                                $observacionVenta = $row['observacionVenta'];
                                $rutaArchivoNuevo = str_replace("../", "", $rutaArchivo);

                    ?>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="avatar-sm me-4">
                                        <span
                                            class="avatar-title bg-soft-primary text-primary font-size-16 rounded-circle">
                                            <?php
                                            if ($empresaUser == 1) {
                                                echo "E";
                                            } elseif ($empresaUser == 2) {
                                                echo "G";
                                            }
                                            ?>

                                        </span>
                                        <!-- <img src="assets/images/companies/img-2.png" alt="img-2"
                                            class="avatar-sm mt-2 mb-4"> -->
                                    </div>
                                    <div class="flex-1 align-self-center">
                                        <div class="pb-1">
                                        <h5 class="text-truncate font-size-16 mb-1">
                                            <a href="<?php echo $rutaArchivoNuevo; ?>" download class="text-dark"  style="font-size:15px;">
                                               
                                                <?php
                                                $nombreCorto = strlen($nombreArchivo) > 25 ? substr($nombreArchivo, 0, 25) . '...' : $nombreArchivo;
                                                echo $nombreCorto;
                                                ?>
                                                 <i class="ri-download-line"></i> <!-- Icono de descarga -->
                                            </a>
                                        </h5>

                                            <p class="text-muted mb-0" style="font-size: 12px;">
                                                <i class="mdi mdi-account me-1"></i> 
                                                <?php
                                              
                                                 // Obtener el nombre del usuario correspondiente al $idUser
                                                $queryUser = "SELECT nombre_user FROM user WHERE id_user = $idUser";
                                                $customResult = mysqli_query($con, $queryUser);

                                                if ($customResult && mysqli_num_rows($customResult) > 0) {
                                                    $customRow = mysqli_fetch_assoc($customResult);
                                                    $customNombreUser = $customRow['nombre_user'];

                                                     // Convertir el nombre del usuario a minúsculas
                                                    $customNombreUser = strtolower($customNombreUser);

                                                    // Convertir solo las iniciales a mayúsculas
                                                    $customNombreUser = ucwords($customNombreUser);

                                                    // Imprimir el nombre del usuario con las iniciales en mayúsculas
                                                    echo $customNombreUser;
                                                } else {
                                                    echo "No se encontró el usuario";
                                                }
                                                 ?>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mt-3 border-end">
                                                    <p class="text-muted mb-2">
                                                    <?php
                                                    
                                                    // Obtener el nombre del usuario correspondiente al $idUser
                                                    $queryProducto = "SELECT nombreProducto FROM producto WHERE idProducto = $idProducto";
                                                    $customProducto = mysqli_query($con, $queryProducto);

                                                    if ($customProducto && mysqli_num_rows($customProducto) > 0) {
                                                        $productoRow = mysqli_fetch_assoc($customProducto);
                                                        $ProductoNombre = $productoRow['nombreProducto'];
                                                        // Imprimir el nombre del usuario con las iniciales en mayúsculas
                                                        echo $ProductoNombre;
                                                    } else {
                                                        echo "No se encontró el Producto";
                                                    }
                                                    ?>
                                                        </p>
                                                    <h5 class="font-size-16 mb-0"><?php echo 'Cant: '.$cantidadProducto; ?></h5>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-6">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2">Total</p>
                                                    <h5 class="font-size-12 mb-0"><?php
                                                     $tipoMonedaF = ($tipoMoneda == 2) ? '$' : 'S/';
                                                     echo $tipoMonedaF . $montoTotal;
                                                     ?></h5>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <div class="row">

                                        <h5 class="font-size-12 mb-0"><?php echo $nuevaFecha; ?></h5>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <!-- end  -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                                
                    <?php
                            }
                        } else {
                            echo "No se encontraron resultados.";
                        }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($con);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h4 class="card-title mb-4">Grafica </h4>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div>
                                            <div id="spline_area_month" class="column-charts" dir="ltr">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab -->
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div>
                                            <div id="spline_area_year" class="column-charts" dir="ltr">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab -->
                                    </div>
                                    <script>
                                        var optionsSpark3 = {
                                            series: [
                                                { name: "series1.3", data: [20, 60, 29, 96, 25, 62, 17] },
                                                { name: "series20", data: [50, 22, 82, 20, 86, 36, 71] }
                                            ],
                                            chart: {
                                                type: "area",
                                                height: 50,
                                                sparkline: { enabled: true }
                                            },
                                            stroke: { show: false, curve: "smooth" },
                                            colors: ["#5867c3", "#34c38f"],
                                            xaxis: { crosshairs: { width: 1 } },
                                            yaxis: { min: 0 },
                                            subtitle: { offsetX: 0, style: { fontSize: "14px" } }
                                        };

                                        var chartSpark3 = new ApexCharts(document.querySelector("#spline_area_month"), optionsSpark3);
                                        chartSpark3.render();

                                        var optionsSparkYear = {
                                            series: [
                                                { name: "series1", data: [70, 40, 75, 38, 88, 50, 90] },
                                                { name: "series21", data: [42, 60, 38, 66, 44, 69, 45] }
                                            ],
                                            chart: {
                                                type: "year",
                                                height: 368,
                                                toolbar: { show: false }
                                            },
                                            dataLabels: { enabled: false },
                                            stroke: { curve: "smooth", width: 3 },
                                            colors: ["#5867c3", "#34c38f"],
                                            xaxis: { type: "year", categories: ["2015", "2016", "2017", "2018", "2019", "2020", "2021"] },
                                            grid: { borderColor: "#f1f1f1" },
                                            tooltip: { x: { format: "dd/MM/yy HH:mm" } }
                                        };

                                        var chartSparkYear = new ApexCharts(document.querySelector("#spline_area_year"), optionsSparkYear);
                                        chartSparkYear.render();
                                    </script>
                                    </div>
                                    </div>
                </div>
                <!-- end row -->
                

            </div>
            <!-- container-fluid -->

        </div>
        <!-- End Page-content -->

        <?php include './parts/footer.php';?>
    </div>
    <!-- end main content-->
</div>
<!-- END layout-wrapper -->
<?php include './parts/sidebar.php';?>


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

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- jquery.vectormap map -->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- <script src="assets/js/pages/dashboard.init.js"></script> -->


</body>

</html>