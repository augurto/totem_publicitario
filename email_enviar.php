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
$empresaUser = $_SESSION['empresaUser'];



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
                                <h4 class="mb-sm-0">Inbox</h4>

                                <div class="page-title-right">
                                    <ol class="breadcrumb m-0">
                                        <li class="breadcrumb-item"><a href="javascript: void(0);">Email</a></li>
                                        <li class="breadcrumb-item active">Inbox</li>
                                    </ol>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- end page title -->

                    <div class="row">
                        <div class="col-12">
                            <!-- Left sidebar -->
                            <div class="email-leftbar card">
                                <button type="button" class="btn btn-danger btn-block waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#composemodal">
                                    Redactar
                                </button>
                                <div class="mail-list mt-4">
                                    <a href="#"><i class="mdi mdi-email-outline me-2"></i> Inbox <span class="ms-1 float-end">(18)</span></a>
                                    <!-- <a href="#"><i class="mdi mdi-star-outline me-2"></i>Starred</a>
                                    <a href="#"><i class="mdi mdi-diamond-stone me-2"></i>Importantes</a>
                                    <a href="#"><i class="mdi mdi-file-outline me-2"></i>Draft</a> -->
                                    <a href="#" class="active"><i class="mdi mdi-email-check-outline me-2"></i>Mail Enviados</a>
                                    <a href="#"><i class="mdi mdi-trash-can-outline me-2"></i>Trash</a>
                                </div>


                            </div>
                            <!-- End Left sidebar -->


                            <!-- Right Sidebar -->
                            <div class="email-rightbar mb-3">

                                <div class="card">
                                    <div class="btn-toolbar p-3" role="toolbar">
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-inbox"></i></button>
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i class="fa fa-exclamation-circle"></i></button>
                                            <button type="button" class="btn btn-primary waves-light waves-effect"><i class="far fa-trash-alt"></i></button>
                                        </div>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-folder"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Updates</a>
                                                <a class="dropdown-item" href="#">Social</a>
                                                <a class="dropdown-item" href="#">Team Manage</a>
                                            </div>
                                        </div>
                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="fa fa-tag"></i> <i class="mdi mdi-chevron-down ms-1"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Updates</a>
                                                <a class="dropdown-item" href="#">Social</a>
                                                <a class="dropdown-item" href="#">Team Manage</a>
                                            </div>
                                        </div>

                                        <div class="btn-group me-2 mb-2 mb-sm-0">
                                            <button type="button" class="btn btn-primary waves-light waves-effect dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                More <i class="mdi mdi-dots-vertical ms-2"></i>
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="#">Mark as Unread</a>
                                                <a class="dropdown-item" href="#">Mark as Important</a>
                                                <a class="dropdown-item" href="#">Add to Tasks</a>
                                                <a class="dropdown-item" href="#">Add Star</a>
                                                <a class="dropdown-item" href="#">Mute</a>
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="message-list">
                                        <?php
                                        // Incluir el archivo de conexión
                                        include('../includes/conexion.php');

                                        // Consulta para obtener mensajes ordenados por fecha_envio (ajusta según tu estructura de base de datos)
                                        $sqlSelectMensajes = "SELECT * FROM mensajes ORDER BY fecha_envio DESC";
                                        $resultado = mysqli_query($con, $sqlSelectMensajes);

                                        // Verificar si hay resultados
                                        if ($resultado) {
                                            while ($row = mysqli_fetch_assoc($resultado)) {
                                                // Obtener datos del mensaje
                                                $idMensaje = $row['id'];
                                                $para = $row['para'];
                                                $asunto = $row['asunto'];
                                                $mensaje = $row['mensaje'];
                                                $archivoAdjunto = $row['archivo_adjunto'];
                                                $fechaEnvio = $row['fecha_envio'];
                                                // Convertir la cadena de fecha a un objeto DateTime
                                                $fechaObj = new DateTime($fechaEnvio);

                                                // Establecer el idioma a español
                                                setlocale(LC_TIME, 'es_ES');

                                                // Obtener el nombre del mes y el día en español
                                                $nombreMes = strftime('%B', $fechaObj->getTimestamp()); // '%B' devuelve el nombre completo del mes
                                                $dia = $fechaObj->format('j'); // 'j' devuelve el día del mes sin ceros iniciales


                                                // Mostrar mensaje en la lista
                                                echo '<li>';
                                                echo '<div class="col-mail col-mail-1">';
                                                echo '<div class="checkbox-wrapper-mail">';
                                                echo '<input type="checkbox" id="chk' . $idMensaje . '">';
                                                echo '<label for="chk' . $idMensaje . '" class="toggle"></label>';
                                                echo '</div>';
                                                echo '<a href="#" class="title">' . $para . '</a><span class="star-toggle far fa-star"></span>';
                                                echo '</div>';
                                                echo '<div class="col-mail col-mail-2">';
                                                echo '<a href="#" class="subject">' . $asunto . ' – <span class="teaser">' . strip_tags($mensaje) . '</span></a>';
                                                echo '<div class="date">' . $nombreMes . ' ' . $dia . '</div>';
                                                
                                                echo '</div>';
                                                echo '</li>';
                                            }

                                            // Liberar el resultado
                                            mysqli_free_result($resultado);
                                        } else {
                                            // Manejar error en la consulta
                                            echo "Error en la consulta: " . mysqli_error($con);
                                        }

                                        // Cerrar la conexión
                                        mysqli_close($con);
                                        ?>


                                    </ul>

                                </div> <!-- card -->

                                <div class="row">
                                    <div class="col-7">
                                        Showing 1 - 20 of 1,524
                                    </div>
                                    <div class="col-5">
                                        <div class="btn-group float-end">
                                            <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-left"></i></button>
                                            <button type="button" class="btn btn-sm btn-success waves-effect"><i class="fa fa-chevron-right"></i></button>
                                        </div>
                                    </div>
                                </div>

                            </div> <!-- end Col-9 -->

                        </div>

                    </div><!-- End row -->

                </div> <!-- container-fluid -->
            </div>
            <!-- End Page-content -->

            <!-- Modal -->
            <div class="modal fade" id="composemodal" tabindex="-1" role="dialog" aria-labelledby="composemodalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="composemodalTitle">Nuevo Mensaje</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div>
                                <form method="post" enctype="multipart/form-data" action="email/enviar.php">
                                    <!-- Campo Para (Destinatario) -->
                                    <div class="mb-3">
                                        <label for="para">Para</label>
                                        <input type="email" class="form-control" id="para" name="para" placeholder="Para">
                                    </div>

                                    <!-- Campo Asunto -->
                                    <div class="mb-3">
                                        <label for="asunto">Asunto</label>
                                        <input type="text" class="form-control" id="asunto" name="asunto" placeholder="Asunto">
                                    </div>

                                    <!-- Campo Área (Mensaje) -->
                                    <div class="mb-3">
                                        <label for="email-editor">Mensaje</label>
                                        <textarea id="email-editor" name="area" class="form-control"></textarea>
                                    </div>

                                    <!-- Campo Adjunto -->
                                    <div class="mb-3">
                                        <label for="adjunto">Adjuntar Archivo</label>
                                        <input type="file" class="form-control" id="adjunto" name="adjunto">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Enviar <i class="fab fa-telegram-plane ms-1"></i></button>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end modal -->

            <?php include './parts/footer.php'; ?>
        </div>
        <!-- end main content-->

    </div>
    <!-- END layout-wrapper -->

    <?php include './parts/sidebar.php'; ?>
    <!--tinymce js-->
    <script src="assets/libs/tinymce/tinymce.min.js"></script>

    <!-- email editor init -->
    <script src="assets/js/pages/email-editor.init.js"></script>

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
    <!--tinymce js-->
    <script src="assets/libs/tinymce/tinymce.min.js"></script>

    <!-- email editor init -->
    <script src="assets/js/pages/email-editor.init.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>