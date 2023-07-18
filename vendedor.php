<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión
$queryNoAtendidos = "SELECT COUNT(*) AS countNoAtendidos FROM web_formularios WHERE estado_web = 0";
$resultNoAtendidos = mysqli_query($con, $queryNoAtendidos);

if ($resultNoAtendidos) {
    $rowNoAtendidos = mysqli_fetch_assoc($resultNoAtendidos);
    $noAtendidos = $rowNoAtendidos['countNoAtendidos'];
} else {
    $noAtendidos = 0; // Si hay un error en la consulta, establecemos el valor en 0
}

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}

// El usuario ha iniciado sesión, puedes acceder a los datos de sesión
$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];



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

    </head>

    <body data-topbar="dark">

        <!-- <body data-layout="horizontal" data-topbar="dark"> -->

        <!-- Begin page -->
        <div id="layout-wrapper">

            
        <?php
        include './parts/nav.php';
        ?>
        
        

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                            <?php
                                if ($tipoUsuario == 3) {
                                    echo '<a href="inicio.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio</span>
                                        </a>';
                                } elseif ($tipoUsuario == 2) {
                                    echo '<a href="administrador.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio</span>
                                        </a>';
                                } elseif ($tipoUsuario == 1) {
                                    echo '<a href="vendedor.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio</span>
                                        </a>';
                                } else {
                                    echo '<a href="login.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio</span>
                                        </a>';
                                }
                                ?>
                            </li>
                            <!-- end li -->
                            
                            
                           
                         
                           
                            <!-- end li -->
                        </ul>
                        <!-- end ul -->
                    </div>
                    <!-- Sidebar -->
                </div>
            </div>
            <!-- Left Sidebar End -->

            

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
                                    <h4 class="mb-sm-0">Data Tables</h4>
                                    <div class="page-title-center">
                                    <button type="button" class="btn btn-primary waves-effect waves-light" style="height: 35px !important;" onclick="window.location.href = 'nuevoCliente.php';">
                                        Nuevo Cliente <i class="mdi mdi-emoticon-excited-outline font-size-16 align-middle ms-2"></i>
                                    </button>

                                    </div>
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tables</a></li>
                                            <li class="breadcrumb-item active">Data Tables</li>
                                        </ol>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                               
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <h4 class="card-title">Data Clientes</h4>
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Accion</th>
                                                    <th>Nombres</th>
                                                    <th>Fuente</th>
                                                    <th>Email</th>
                                                    <th>Teléfono</th>
                                                    <th>Estado</th>
                                                    <th>Mensaje</th>
                                                    <th>Fecha </th>
                                                    <th>URL</th>
                                                    <th>Nombre Formulario</th>
                                                    <th>IP</th>
                                                    <th>Aterrizaje</th>
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Establecer la conexión con la base de datos
                                                $servername = "localhost";
                                                $username = "u291982824_bd_geo";
                                                $password = "21.17.BDgeo";
                                                $dbname = "u291982824_bd_geo";

                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                // Verificar la conexión
                                                if ($conn->connect_error) {
                                                    die("Error en la conexión: " . $conn->connect_error);
                                                }

                                                // Consulta SQL para obtener los datos de la tabla "formulario_totem"
                                                $sql = "SELECT 
                                                id_form_web,date_create,datos_form,email,telefono,mensaje,fecha,URL,nombre_formulario,ip_formulario,
                                                time,estado_web,estado_web,fuente_dato,id_user,idEmpresa,documentoCliente,tipoCliente,prospecto,
                                                observacionCliente,idid,estadoCliente
                                                 FROM web_formularios where estado_web != 99 ORDER BY fecha DESC";
                                                
                                                $result = $conn->query($sql);
                                                

                                                // Verificar si se obtuvieron resultados
                                                if ($result->num_rows > 0) {
                                                    $id = 1; // Variable para el ID inicial

                                                    // Mostrar los datos en filas de la tabla
                                                    while ($row = $result->fetch_assoc()) {
                                                        $prospecto=$row["prospecto"];
                                                        echo "<tr>";
                                                        echo "<td>" . $id . "</td>";
                                                        /* echo "<td>" . $row["datos_form"] . "</td>"; */
                                                        $url_dato = $row["URL"];
                                                        // Obtener los parámetros de la URL
                                                        $params = parse_url($url_dato, PHP_URL_QUERY);

                                                        // Convertir los parámetros en un arreglo asociativo
                                                        parse_str($params, $query);

                                                        // Obtener los valores de las variables específicas
                                                        $a = $query['utm_source'];
                                                        $b = $query['utm_medium'];
                                                        $c = $query['utm_campaign'];

                                                        // Imprimir los valores
                                                                                                           
                                                        $documentoCliente=$row["documentoCliente"];
                                                        $fuente_dato = $row["fuente_dato"];

                                                       
                                                            // Obtener el valor de $row["estado_web"]
                                                            $estado_web = $row["estado_web"];

                                                            if ($estado_web == 0 && !empty($a)) {
                                                                echo "<td>
                                                                
                                                                <a href='seguimientoCliente.php?id=" . $row['id_form_web'] . "&pr=" . $a . "&f=" . $tipoFuente . "'  class='btn btn-danger waves-effect waves-light'>
                                                                    Atender
                                                                </a>

                                                            
                                                                        " . "
                                                                    </td>";
                                                                echo "<td>" . $row['datos_form'] . "
                                                                </td>";
                                                            } elseif ($estado_web == 1) {
                                                                echo "<td>
                                                                        
                                                                            <a href='seguimientoCliente.php?id=" . $row['id_form_web'] . "&pr=" . $a . "&f=" . $tipoFuente . "'  class='btn btn-primary waves-effect waves-light'>
                                                                            Atendido
                                                                            </a>

                                                                            " . "
                                                                        </td>";
                                                                    echo "<td>" . $row['datos_form'] . "
                                                                    </td>";
                                                            } elseif (empty($a) && $estado_web == 0  ) {
                                                                echo "<td>
                                                                    <a href='seguimientoCliente.php?id=" . $row['id_form_web'] . "&pr=" . $a . "&f=" . $tipoFuente . "'  class='btn btn-danger waves-effect waves-light'>
                                                                        Atender
                                                                    </a>
                                                                </td>";
                                                                echo "<td>" . $row['datos_form'] . "</td>";
                                                            }
                                                            
                                                        
                                                            if (empty($row["id_user"])) {
                                                                if ($a == "Google ADS") {
                                                                    $fuenteOriginal = 2;
                                                                } elseif ($a == "Meta ADS") {
                                                                    $fuenteOriginal = 3;
                                                                } else {
                                                                    $fuenteOriginal = 1;
                                                                }
                                                            } else {
                                                                $fuenteOriginal = $row["prospecto"];
                                                            }
                                                            
                                                        /* condicional para mostrar si es de facebook, google, organico o presencial */
                                                      

                                                                $queryFuente = "SELECT colorFuente,descripcionFuente FROM fuente WHERE tipoFuente = '$fuenteOriginal'";
                                                                $resultFuente = mysqli_query($conn, $queryFuente);

                                                                $rowFuente = mysqli_fetch_assoc($resultFuente);
                                                                $descripcionFuente = $rowFuente['descripcionFuente'];
                                                                $colorFuente = $rowFuente['colorFuente'];
                                                                $tipoFuente = $rowFuente['tipoFuente'];                                            
                                                                        

                                                                echo '<td><span class="badge rounded-pill" style="background-color: ' . $colorFuente . ';color:white;">' . $descripcionFuente . '</span></td>';



                                                          

                                                        echo "<td>" . $row["email"] . "</td>";
                                                       
                                                        $telefonooo = $row["telefono"];
                                                        echo "<td><a href='https://wa.me/51$telefonooo' target='_blank'>$telefonooo</a></td>";
                                                     
                                                        
                                                        $estadoCliente = $row["tipoCliente"];
                                                        
                                                        // Realizar la consulta a la base de datos para obtener la descripción del tipo de cliente
                                                        $queryTipoCliente = "SELECT * FROM tipoCliente WHERE valorTipoCliente = $estadoCliente";
                                                        $resultTipoCliente = mysqli_query($conn, $queryTipoCliente);

                                                        if ($resultTipoCliente && mysqli_num_rows($resultTipoCliente) > 0) {
                                                            $rowTipoCliente = mysqli_fetch_assoc($resultTipoCliente);
                                                            $descripcionTipoCliente = $rowTipoCliente["descripcionTipoCliente"];
                                                            $colorTipoCliente = $rowTipoCliente["colorTipoCliente"];

                                                            echo "<td><span class=\"badge rounded-pill\" style=\"background-color: $colorTipoCliente;\">$descripcionTipoCliente</span></td>";
                                                        } else {
                                                            
                                                            echo '<td><span class="badge rounded-pill" style="background-color: black; color: white;">Prospecto Venta</span></td>';

                                                        }


                                                        echo "<td>" . $row["mensaje"] . "</td>";
                                                        echo "<td>" . date('Y-m-d H:i:s', strtotime($row["fecha"] . '-5 hours')) . "</td>";
                                                        echo "<td>" . $row["URL"] . "</td>";
                                                        echo "<td>" . $row["nombre_formulario"] . "</td>";
                                                        echo "<td>" . $row["ip_formulario"] . "</td>";
                                                        echo "<td>" . $c . "</td>";
                                                                                               
                                                        echo "</tr>";
                                        
                                                        $id++; // Incrementar el ID

                                                        
                                                    }
                                                } else {
                                                    echo "<tr><td colspan='9'>No se encontraron resultados.</td></tr>";
                                                }

                                                // Cerrar la conexión
                                                $conn->close();
                                                ?>
                                            </tbody>
                                        </table>


                                    </div>
                                </div>
                            </div> <!-- end col -->
                        </div> <!-- end row -->

                        <!-- MODAL -->
                        
                        <script>
                            $(document).ready(function() {
                                $('.bs-example-modal-center').on('show.bs.modal', function(event) {
                                    var button = $(event.relatedTarget); // Botón que activó el modal
                                    var idFormWeb = button.data('id'); // Obtener el valor de 'data-id'
                                    var datosForm = button.data('datos'); // Obtener el valor de 'data-datos'

                                    // Mostrar los valores en los campos de entrada
                                    $(this).find('input[name="id_form_web"]').val(idFormWeb);
                                    $(this).find('input[name="datos_form"]').val(datosForm);

                                    // Realizar la solicitud AJAX para obtener el valor de la consulta
                                    $.ajax({
                                        url: 'includes/consulta.php',
                                        type: 'POST',
                                        data: { idFormWeb: idFormWeb },
                                        success: function(response) {
                                            // Asignar el valor al campo de entrada
                                            $('.modal-body').find('#valor').val(response);
                                        },
                                        error: function(xhr, status, error) {
                                            console.log(error);
                                        }
                                    });
                                });
                            });
                        </script>

                       
                        <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog"
                                            aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title mt-0">Agregar comentario </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                    <form action="includes/guardar_datos_atender.php" method="POST">
                                                    <input type="text" name="id_form_web" id="id_form_web" readonly>
                                                    <input type="text" name="id_usuario" id="id_usuario" value="2" readonly>
                                                    <input type="text" class="form-control" name="datos_form" id="datos_form" readonly>
                                                    <br>
                                                    <label for="">Estado</label>
                                                        <select class="form-control select2">
                                                            <option value="0" selected>Pendiente</option>
                                                            <option value="1">Observado</option>
                                                            <option value="2">Atendido</option>
                                                        </select>
                                                        <br>
                                                        <label for="">Usario Asignado</label>
                                                        <select class="form-control select2">
                                                            <option value="0" selected>Usuario1</option>
                                                            <option value="1">Usuario 2 </option>
                                                            <option value="2">Usuario 3</option>
                                                        </select>
                                                        <br>
                                                        <label for="">Comentario</label>
                                                        <textarea class="form-control"></textarea>
                                                        <br>
                                                        <input type="text" class="form-control" name="valor" id="valor">
                                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                                    </form>

                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->
                        <!-- FIN MODAL -->
                        
                    </div> <!-- container-fluid -->
                </div>
                <!-- End Page-content -->

                
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-6">
                                <script>document.write(new Date().getFullYear())</script> © GEO.
                            </div>
                            <div class="col-sm-6">
                                <div class="text-sm-end d-none d-sm-block">
                                    Creado con  <i class="mdi mdi-heart text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
            <!-- end main content-->

        </div>
        <!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <div class="right-bar">
            <div data-simplebar class="h-100">
                <div class="rightbar-title d-flex align-items-center px-3 py-4">

                    <h5 class="m-0 me-2">Settings</h5>

                    <a href="javascript:void(0);" class="right-bar-toggle ms-auto">
                        <i class="mdi mdi-close noti-icon"></i>
                    </a>
                </div>

                <!-- Settings -->
                <hr class="mt-0" />
                <h6 class="text-center mb-0">Choose Layouts</h6>

                <div class="p-4">
                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-1.jpg" class="img-fluid img-thumbnail" alt="layout-1">
                    </div>

                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="light-mode-switch" checked>
                        <label class="form-check-label" for="light-mode-switch">Light Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-2.jpg" class="img-fluid img-thumbnail" alt="layout-2">
                    </div>
                    <div class="form-check form-switch mb-3">
                        <input class="form-check-input theme-choice" type="checkbox" id="dark-mode-switch"
                            data-bsStyle="assets/css/bootstrap-dark.min.css" data-appStyle="assets/css/app-dark.min.css">
                        <label class="form-check-label" for="dark-mode-switch">Dark Mode</label>
                    </div>

                    <div class="mb-2">
                        <img src="assets/images/layouts/layout-3.jpg" class="img-fluid img-thumbnail" alt="layout-3">
                    </div>
                    <div class="form-check form-switch mb-5">
                        <input class="form-check-input theme-choice" type="checkbox" id="rtl-mode-switch"
                            data-appStyle="assets/css/app-rtl.min.css">
                        <label class="form-check-label" for="rtl-mode-switch">RTL Mode</label>
                    </div>


                </div>

            </div> <!-- end slimscroll-menu-->
        </div>
        <!-- /Right-bar -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

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

    </body>
</html>
