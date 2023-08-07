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

                                <form id="myForm" action="includes/guardarNuevoCliente.php" method="post">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                            <div class="row mb-6">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Datos</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="text" placeholder="Nombres y Apellidos"
                                                        id="example-text-input" name="datos">
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row mb-6">
                                                <label for="example-number-input" class="col-sm-2 col-form-label">Documento</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="number" id="example-number-input" name="documento" maxlength="9">
                                                </div>
                                            </div>
                                            <script>
                                                document.getElementById("example-number-input").addEventListener("input", function() {
                                                    if (this.value.length > 9) {
                                                        this.value = this.value.slice(0, 9); // Limitar a 9 dígitos
                                                    }
                                                });
                                            </script>
                                            <br>
                                             <!-- end row -->
                                             <div class="row mb-6">
                                                <label for="example-tel-input" class="col-sm-2 col-form-label">Telefono</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="tel" 
                                                        id="example-tel-input" name="telefono">
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <br>
                                            <div class="row mb-3">
                                                <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email" placeholder="nombre@example.com"
                                                        id="example-email-input" name="email">
                                                </div>
                                            </div>

                                            <?php
                                            // Comprobar si $_SESSION['empresaUser'] es igual a 1
                                            if ($_SESSION['empresaUser'] == 1) {
                                                ?>
                                                <div class="row mb-3">
                                                    <label for="example-email-input" class="col-sm-2 col-form-label">Usuario Random</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="number" id="example-email-input" name="userRandom" readonly>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <?php
                                            // Realizar la conexión a la base de datos (asumiendo que ya has definido las variables de conexión)
                                            

                                            // Inicializar un array con los valores permitidos
                                            $valoresPermitidos = array(7, 9, 10);
                                            
                                            // Realizar una búsqueda en el array para verificar si el último valor es uno de los permitidos
                                            if (isset($_SESSION['ultimaValorRandom']) && in_array($_SESSION['ultimaValorRandom'], $valoresPermitidos)) {
                                                // Obtener el índice del último valor
                                                $indiceUltimoValor = array_search($_SESSION['ultimaValorRandom'], $valoresPermitidos);
                                            
                                                // Calcular el índice del siguiente valor, considerando el ciclo entre los valores permitidos
                                                $indiceSiguienteValor = ($indiceUltimoValor + 1) % count($valoresPermitidos);
                                            
                                                // Obtener el siguiente valor
                                                $siguienteValor = $valoresPermitidos[$indiceSiguienteValor];
                                            } else {
                                                // Si no hay un último valor o no es uno de los permitidos, iniciar en el primer valor (7)
                                                $siguienteValor = $valoresPermitidos[0];
                                            }
                                            
                                            // Guardar el último valor en la sesión
                                            $_SESSION['ultimaValorRandom'] = $siguienteValor;
                                            
                                            // Mostrar el valor en el input
                                            echo '<input class="form-control" type="number" id="example-email-input" name="userRandom" value="' . $siguienteValor . '" readonly>';
                                            ?>
                                            



                                            <!-- end row -->
                                            <div class="mb-12">
                                                <label class="form-label">Tipo de Cliente</label>
                                                
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
                                                    echo "<option value='" . $value . "'>" . $text . "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
                                            <div class="mb-12">
                                                <label class="form-label">Fuente</label>
                                                
                                                <select class="form-control select2" id="prospecto" name="prospecto">
                                                <?php
                                             
                                                include 'includes/conexion.php'; 
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $query2 = "SELECT * FROM fuente where idAterrizajeFuente = 1";
                                                $result2 = mysqli_query($con, $query2);

                                                // Verificar si se encontraron resultados
                                                if (mysqli_num_rows($result2) > 0) {
                                                    // Generar las opciones dentro del select
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $value2 = $row2['tipoFuente'];
                                                    $text2 = $row2['descripcionFuente'];
                                                    echo "<option value='" . $value2 . "'>" . $text2 . "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
                                            

                                            <div class="mt-6">
                                                <label class="mb-1">Comentario</label>
                                                
                                                <textarea id="textarea" class="form-control" maxlength="225" rows="3"
                                                    placeholder="Observacion al Cliente" name="comentario"></textarea>
                                            </div>
                                            <input type="hidden" class="form-control" id="id-input" name="idweb" readonly>

                                            <script>
                                                // Obtener el valor de la variable "id" de la URL
                                                const urlParams = new URLSearchParams(window.location.search);
                                                const id = urlParams.get('id');

                                                // Establecer el valor en el input
                                                document.getElementById('id-input').value = id;
                                            </script>
                                            <input type="hidden" id="empresa" name="empresa" class="form-control" value="<?php echo $_SESSION['empresaUser'] ; ?>" readonly>
                                            <input type="hidden" id="usuario" name="usuario" class="form-control" value="<?php echo $_SESSION['idUser'] ; ?>" readonly>
                                           <br>
                                            <center>
                                                <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Registrar Usuario</button>
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
                    <!-- end col -->

                    <div class="col-lg-6" style="display: none;">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Seguimiento de Lead</h4>
                                
                                <form  action="includes/guardar_webform.php" method="post" >
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div class="mb-12">
                                                <label class="form-label">Buscar Cliente</label>
                                                
                                                <select class="form-control select2" id="idcliente" name="idcliente">
                                                <?php
                                                 include 'includes/conexion.php'; 
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $queryc = "SELECT * FROM cliente order by idCliente DESC    ";
                                                $resultc = mysqli_query($con, $queryc);

                                                // Verificar si se encontraron resultados
                                                if (mysqli_num_rows($resultc) > 0) {
                                                    // Generar las opciones dentro del select
                                                    while ($rowc= mysqli_fetch_assoc($resultc)) {
                                                    $valuec = $rowc['documentoCliente'];
                                                    $textc = $rowc['datosCliente'];
                                                    $telefonoc = $rowc['telefonoCliente'];
                                                    echo "<option value='" . $valuec . "'>" . $textc."-".$valuec."-".$telefonoc. "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
                                            <div class="mb-12">
                                                <label class="form-label">Tipo de Cliente</label>
                                                
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
                                                    echo "<option value='" . $value . "'>" . $text . "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
                                            <div class="mb-12">
                                                <label class="form-label">Fuente</label>
                                                
                                                <select class="form-control select2" id="prospecto" name="prospecto">
                                                <?php
                                             
                                                include 'includes/conexion.php'; 
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $query2 = "SELECT * FROM fuente where idAterrizajeFuente = 1";
                                                $result2 = mysqli_query($con, $query2);

                                                // Verificar si se encontraron resultados
                                                if (mysqli_num_rows($result2) > 0) {
                                                    // Generar las opciones dentro del select
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                    $value2 = $row2['tipoFuente'];
                                                    $text2 = $row2['descripcionFuente'];
                                                    echo "<option value='" . $value2 . "'>" . $text2 . "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
                                            <div class="mt-12">
                                                <label class="mb-1">Observacion</label>
                                                
                                                <textarea id="observacion" name="observacion" class="form-control" maxlength="225" rows="3"
                                                    placeholder="Observacion al Cliente"></textarea>
                                            </div>
                                            <input type="hidden" id="idid" name="idid" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>


                                            <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?php echo $_SESSION['idUser'] ; ?>" readonly>
                                            <br>
                                            <center>
                                                <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Registrar Lead</button>
                                            </center>
                                            
                                        </div>
                                        <!-- end col -->
                                        
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
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