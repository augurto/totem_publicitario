<?php

include 'includes/conexion.php'; // Incluir el archivo de conexión


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
                    <!-- INICIO DATOS -->


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title">Prueba de PDF</h4>

                                    <form id="documentoForm" action="generarPDF.php" method="POST"  target="_blank">

                                        <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label">Tipo de Documento</label>
                                            <div class="col-sm-10">
                                                <select class="form-select" name="tipoDocumento" aria-label="Selecciona el tipo de documento">
                                                    <option selected disabled>Selecciona un tipo de documento</option>
                                                    <option value="Documento 1">Documento 1</option>
                                                    <option value="Documento 2">Documento 2</option>
                                                    <option value="Documento 3">Documento 3</option>
                                                    <option value="Documento 4">Documento 4</option>
                                                    <option value="Documento 5">Documento 5</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-text-input" class="col-sm-2 col-form-label">Observaciones</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="textarea" name="observaciones" placeholder="Observaciones" id="example-text-input">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" name="email" placeholder="bootstrap@example.com" id="example-email-input">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-tel-input" class="col-sm-2 col-form-label">Telephone</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="tel" name="telephone" placeholder="1-(555)-555-5555" id="example-tel-input">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-number-input" class="col-sm-2 col-form-label">Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="number" name="number" value="42" id="example-number-input">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="example-color-input" class="col-sm-2 col-form-label">Color</label>
                                            <div class="col-sm-10">
                                                <input type="color" class="form-control form-control-color mw-100" name="color" id="example-color-input" value="#5664d2" title="Choose your color">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-10 offset-sm-2">
                                                <button type="submit" class="btn btn-primary">Generar PDF</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                                <!-- end cardbody -->
                            </div>
                            <!-- end card -->
                        </div>
                        <!-- end col -->
                    </div>
                    <!-- end row -->


                    <!-- FIN DATOS -->





                </div> <!-- container-fluid -->
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