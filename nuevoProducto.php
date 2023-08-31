<?php
session_start();
include 'includes/conexion.php'; // Incluir el archivo de conexión

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}


$usuario = $_SESSION['usuario'];
$dni = $_SESSION['dni'];
$tipoUsuario = $_SESSION['tipoUsuario'];

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

</head>
<style>
    @media print {
        body {
            display: none;
        }
    }
</style>

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
                            <h4 class="mb-sm-0">Registrar Cliente </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Home</a></li>
                                    <li class="breadcrumb-item active">Cliente</li>
                                </ol>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- end page title -->


                <div class="row">
                <div class="col-lg-8">
                        

                        <div class="card">
                            <div class="card-body">

                        
                                <br>

                                <form action="procesarNuevoProducto.php" method="POST">
                                    <div class="row mb-6">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre del Producto:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="nombre" name="nombre" required>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripción del Producto:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label for="precio" class="col-sm-2 col-form-label">Precio del Producto:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="number" id="precio" name="precio" step="0.01" required>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label for="atributosSelect" class="col-sm-2 col-form-label">Atributos del Producto (selecciona varios):</label>
                                        <div class="col-sm-10">
                                            <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Selecciona atributos del Producto" id="atributosSelect" name="atributos[]">
                                                <?php
                                                require 'conexion.php';

                                                $query = "SELECT ID, Atributo FROM atributos";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $atributoID = $row['ID'];
                                                    $atributoNombre = $row['Atributo'];
                                                    echo "<option value='$atributoID'>$atributoNombre</option>";
                                                }

                                                mysqli_free_result($result);
                                                mysqli_close($con);
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <input type="submit" value="Agregar Producto" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>

                                <!-- end form -->
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                               
                                <!-- end form -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->

                    <div class="col-lg-6" style="display: none;">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Seguimiento de Lead</h4>
                                
                                <form action="procesarNuevoProducto.php" method="POST">
                                    <div class="row mb-6">
                                        <label for="nombre" class="col-sm-2 col-form-label">Nombre del Producto:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" id="nombre" name="nombre" required>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label for="descripcion" class="col-sm-2 col-form-label">Descripción del Producto:</label>
                                        <div class="col-sm-10">
                                            <textarea class="form-control" id="descripcion" name="descripcion" required></textarea>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label for="precio" class="col-sm-2 col-form-label">Precio del Producto:</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="number" id="precio" name="precio" step="0.01" required>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <label for="atributosSelect" class="col-sm-2 col-form-label">Atributos del Producto (selecciona varios):</label>
                                        <div class="col-sm-10">
                                            <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Selecciona atributos del Producto" id="atributosSelect" name="atributos[]">
                                                <?php
                                                require 'conexion.php';

                                                $query = "SELECT ID, Atributo FROM atributos";
                                                $result = mysqli_query($con, $query);

                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $atributoID = $row['ID'];
                                                    $atributoNombre = $row['Atributo'];
                                                    echo "<option value='$atributoID'>$atributoNombre</option>";
                                                }

                                                mysqli_free_result($result);
                                                mysqli_close($con);
                                                ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-6">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10">
                                            <input type="submit" value="Agregar Producto" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                                                            
                                </div>

                                
                                <!-- end form -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                       

                    </div>
                    <!-- end col -->

                    
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

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>

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