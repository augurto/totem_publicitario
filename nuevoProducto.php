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
    $formActualizado=$selectRow['formActualizado'];
    $url= $selectRow['URL'];
    $nombreFormulario= $selectRow['nombre_formulario'];
    $ipFormulario= $selectRow['ip_formulario'];
    $prospecto= $selectRow['prospecto'];
    $tipoCliente= $selectRow['tipoCliente'];
    $mensajeOriginal= $selectRow['mensajeOriginal'];
    $idOriginal= $selectRow['idOriginal'];
    $fuenteDato= $selectRow['fuente_dato'];

   
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

                                <h4 class="card-title">Datos del  Cliente</h4>
                                <br>

                              <!--   <form id="myForm" action="includes/guardar_user.php" method="post"> -->
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
                                    <label for="atributosSelect" class="col-sm-2 col-form-label">Atributos del Producto (selecciona múltiples):</label>
                                    <div class="col-sm-10">
                                        <select class="select2 form-control select2-multiple" multiple="multiple" data-placeholder="Selecciona atributos del Producto" id="atributosSelect" name="atributos[]">
                                            <?php
                                            require 'includes/conexion.php';

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

                    <!-- inicio linea del tiempo -->
                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body bg-transparent">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
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
                                <h4 class="card-title mb-4">Eventos</h4>

                                <div class="pe-lg-3" data-simplebar style="max-height: 350px;">
                                    <ul class="list-unstyled activity-wid">
                                        <?php
                                        // Incluye el archivo con la conexión
                                        include 'includes/conexion.php';  // Asegúrate de cambiar el nombre del archivo

                                        // Consulta a la base de datos
                                        $sql = "SELECT * FROM web_formularios WHERE idOriginal = '$idOriginal' or  id_form_web = '$idOriginal'";  // Modifica la consulta según tus necesidades
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

                                        $tipoClienteLinea=$row["tipoCliente"];
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

                                                    $descrpCliente=$clienteData["descripcionTipoCliente"];
                                                    $colorCliente=$clienteData["colorTipoCliente"];
                                                    
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