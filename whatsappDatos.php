

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
                                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <!-- <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;"> -->
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Usuario</th>
                                                    <th>Mensaje</th>
                                                    <th>Fecha</th>
                                                 
                                                    
                                                    
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Establecer la conexión con la base de datos
                                                $servername = "127.0.0.1:3306";
                                                $username = "u291982824_bot";
                                                $password = "Bot*#6969";
                                                $dbname = "u291982824_bot";

                                                $conn = new mysqli($servername, $username, $password, $dbname);

                                                // Verificar la conexión
                                                if ($conn->connect_error) {
                                                    die("Error en la conexión: " . $conn->connect_error);
                                                }

                                                // Consulta SQL para obtener los datos de la tabla "formulario_totem"
                                                $sql = "SELECT * FROM mensajes";
                                                
                                                $result = $conn->query($sql);
                                                

                                                // Verificar si se obtuvieron resultados
                                                if ($result->num_rows > 0) {
                                                    $id = 1; // Variable para el ID inicial

                                                    // Mostrar los datos en filas de la tabla
                                                    while ($row = $result->fetch_assoc()) {
                                                        $prospecto=$row["prospecto"];
                                                        echo "<tr>";
                                                        echo "<td>" . $id . "</td>";
                                                        echo "<td>" . $row["sender"] . "</td>";
                                                        echo "<td>" . $row["message"] . "</td>";
                                                        echo "<td>" . date('Y-m-d H:i:s', strtotime($row["fechaCreacionMensaje"] . '-5 hours')) . "</td>";
                                                        
                                                     
                                                                                               
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

    </body>
</html>
