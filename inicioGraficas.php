<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}

// El usuario ha iniciado sesión, puedes acceder a los datos de sesión
$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];
$empresaUser =$_SESSION['empresaUser'] ;
   // Realiza la consulta SQL
   $sql = "SELECT DATE_FORMAT(wf.fecha, '%b %Y') AS mes_anio, tc.descripcionTipoCliente, COUNT(wf.tipoCliente) AS conteo
           FROM web_formularios wf
           INNER JOIN tipoCliente tc ON wf.tipoCliente = tc.idTipoCliente
           GROUP BY mes_anio, tc.descripcionTipoCliente
           ORDER BY mes_anio, tc.descripcionTipoCliente";

   $result = mysqli_query($con, $sql);

   // Prepara los datos para la gráfica en formato JSON
   $data = array();
   $categorias = array();

   while ($row = mysqli_fetch_assoc($result)) {
       $mes_anio = $row['mes_anio'];
       $descripcionTipoCliente = $row['descripcionTipoCliente'];
       $conteo = (int)$row['conteo'];

       if (!in_array($descripcionTipoCliente, $categorias)) {
           $categorias[] = $descripcionTipoCliente;
       }

       if (!isset($data[$mes_anio])) {
           $data[$mes_anio] = array();
       }

       $data[$mes_anio][$descripcionTipoCliente] = $conteo;
   }

   // Cierra la conexión a la base de datos
   

?>

<!doctype html>
<html lang="es">

    <head>
        
        <meta charset="utf-8" />
        <title>Geo <?php echo "<3"; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     

        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <style>
            .btn {
                line-height:0.3 !important;
            }
        </style>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script type="text/javascript">
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var jsonData = <?php echo json_encode($data); ?>;
            var categorias = <?php echo json_encode($categorias); ?>;

            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Mes y Año');
            
            for (var i = 0; i < categorias.length; i++) {
            data.addColumn('number', categorias[i]);
            }

            for (var mes_anio in jsonData) {
            var row = [mes_anio];
            for (var i = 0; i < categorias.length; i++) {
                row.push(jsonData[mes_anio][categorias[i]] || 0);
            }
            data.addRow(row);
            }

            var options = {
            title: 'Conteo de Categorías por Mes y Año',
            hAxis: {title: 'Mes y Año'},
            vAxis: {title: 'Conteo'},
            seriesType: 'bars',
            series: {5: {type: 'line'}} // Opcional: para mostrar una línea
            };

            var chart = new google.visualization.ComboChart(document.getElementById('columnchart_material'));
            chart.draw(data, options);
        }
        </script>

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
                        <!-- INICIO DATOS -->
                        <div class="row">
                        <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Spline Area</h4>

                                        <div id="spline_area" class="apex-charts" dir="ltr"></div>                      
                                    </div>
                                </div><!--end card-->
                            </div>
                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Spline Area</h4>

                                        <div id="spline_area" class="apex-charts" dir="ltr"></div>                      
                                    </div>
                                </div><!--end card-->
                            </div>

                            <div class="col-lg-4">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Column Charts</h4>
                                        
                                        <div id="column_chart" class="apex-charts" dir="ltr"></div>                                      
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
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
                        <!-- end row -->
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
                        <!-- FIN DATOS -->
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <?php include './parts/footer.php';?>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <?php include './parts/sidebar.php';?>

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

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
        <!-- apexcharts init -->
        <script src="assets/js/pages/apexcharts.init.js"></script>

    </body>
</html>
