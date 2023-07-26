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
                                <form id="myForm" action="includes/guardar_webformActualizado.php" method="post">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                            <div class="row mb-6">
                                                <label for="example-text-input" class="col-sm-2 col-form-label">Datos</label>
                                                <div class="col-sm-10">
                                                <input class="form-control" type="text" placeholder="Nombres y Apellidos"
                                                id="example-text-input" name="datos" value="<?php echo $datosForm; ?>" readonly>
                                                </div>
                                            </div>
                                            <br>
                                            
                                            <?php if (empty($documento)) : ?>
                                                <div class="row mb-6">
                                                    <label for="example-number-input" class="col-sm-2 col-form-label">Documento</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="number" id="example-number-input" name="documento" maxlength="9">
                                                    </div>
                                                </div>
                                            <?php else : ?>
                                                <div class="row mb-6">
                                                    <label for="example-number-input" class="col-sm-2 col-form-label">Documento</label>
                                                    <div class="col-sm-10">
                                                        <input class="form-control" type="number" id="example-number-input" name="documento" maxlength="9" value="<?php echo $documento ?>" readonly>
                                                    </div>
                                                </div>
                                            <?php endif; ?>


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
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo "51".$telefono; ?>" target="_blank"><?php echo $telefono; ?></a>
                                                <input type="hidden" class="form-control" name="telefono" value="<?php echo $telefono ?>" readonly>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <br>
                                            <div class="row mb-3">
                                                <label for="example-email-input" class="col-sm-2 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input class="form-control" type="email"  value="<?php echo $email  ; ?>" 
                                                        id="example-email-input" name="email" readonly>
                                                </div>
                                            </div>
                                            <!-- end row -->
                                            <div class="mb-12">
                                                <label class="form-label">Tipo de Cliente</label>
                                                                                                
                                                <select class="form-control select2" id="fuenteDato" name="fuenteDato">
                                                    <?php
                                                    include 'includes/conexion.php'; 
                                                    // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                    $query = "SELECT * FROM tipoClienteCliente WHERE empresaEstado = $empresaUser2";
                                                    $result = mysqli_query($con, $query);

                                                    // Verificar si se encontraron resultados
                                                    if (mysqli_num_rows($result) > 0) {
                                                        // Generar las opciones dentro del select
                                                        while ($row = mysqli_fetch_assoc($result)) {
                                                            $value = $row['valorTipoCliente'];
                                                            $text = $row['descripcionTipoCliente'];

                                                            // Verificar si el valor coincide con $fuenteDato
                                                            $selected = ($fuenteDato == $value) ? 'selected' : '';

                                                            echo "<option value='" . $value . "' " . $selected . ">" . $text . "</option>";
                                                        }
                                                    }

                                                    // Cerrar la conexión a la base de datos
                                                    mysqli_close($con);
                                                    ?>
                                                </select>



                                            </div>
                                            <div class="mt-6">
                                                <br>
                                                <label class="mb-1">Fuente : </label>
                                                
                                                                                               
                                                <?php
                                                include 'includes/conexion.php';
                                                if (empty($id_user)) {
                                                    if ($_GET['pr'] == "Google ADS") {
                                                        $fuenteOriginal = 2;
                                                    } elseif ($_GET['pr'] == "Meta ADS") {
                                                        $fuenteOriginal = 3;
                                                    } else {
                                                        $fuenteOriginal = 1;
                                                    }
                                                } else {
                                                    $fuenteOriginal = $prospecto;
                                                }
                                                $query = "SELECT descripcionFuente, colorFuente FROM fuente WHERE tipoFuente = '$fuenteOriginal'";
                                                $result = mysqli_query($con, $query);

                                                if ($result && mysqli_num_rows($result) > 0) {
                                                    $row = mysqli_fetch_assoc($result);
                                                    $descripcionFuente = $row['descripcionFuente'];
                                                    $colorFuente = $row['colorFuente'];
                                                
                                                    echo '<span class="badge rounded-pill" style="background-color: ' . $colorFuente . ';">' . $descripcionFuente . '</span>';
                                                    echo '<input class="form-control" type="hidden" id="example-text-input" name="fuente" value="' . $fuenteOriginal . '" readonly>';
                                                }
                                                 else {
                                                    echo '<span class="badge rounded-pill">SIN FUENTE</span>';
                                                }

                                                mysqli_close($con);
                                                ?>

                                            </div>
                                            <br>
                                            <div class="mb-12">
                                                <label class="form-label">Estado</label>
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

                                                            // Verificar si el valor actual coincide con $tipoCliente
                                                            if ($value == $tipoCliente) {
                                                                echo "<option value='" . $value . "' selected>" . $text . "</option>";
                                                            } else {
                                                                echo "<option value='" . $value . "'>" . $text . "</option>";
                                                            }
                                                        }
                                                    }

                                                    // Cerrar la conexión a la base de datos
                                                    mysqli_close($con);
                                                    ?>
                                                </select>
                                            </div>

                                            
                                           
                                            <div class="mt-6">
                                                <label class="mb-1">Mensaje </label>
                                                
                                                <textarea  class="form-control" maxlength="225" rows="3"  readonly><?php echo $mensaje; ?></textarea>

                                            </div>
                                            <div class="mt-6">
                                                <label class="mb-1">Comentario</label>
                                                
                                                <textarea  id="textarea" class="form-control" maxlength="225" rows="3" name="comentario" ></textarea>

                                            </div>
                                            <br>
                                            <?php 
                                                $prospectoExistente = $_GET['pr'];
                                                
                                                if (empty($mensajeOriginal)) {
                                                    echo "Mensaje Original : ".$mensaje . "<br>";
                                                } else {
                                                    echo "Mensaje Original : ".$mensajeOriginal . "<br>";
                                                }
                                                
                                                // Restar 5 horas a la fecha
                                                $nuevaFecha = date('Y-m-d H:i:s', strtotime($fecha . ' -5 hours'));
                                                echo "Atendido por: " . ucwords($nombreUserEdicion) . "<br>Fecha: " . $nuevaFecha;
                                            ?>


                                            <input type="hidden" class="form-control" id="id-input" name="idweb" readonly>

                                            <script>
                                                // Obtener el valor de la variable "id" de la URL
                                                const urlParams = new URLSearchParams(window.location.search);
                                                const id = urlParams.get('id');

                                                // Establecer el valor en el input
                                                document.getElementById('id-input').value = id;
                                            </script>
                                            <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?php echo $_SESSION['idUser'] ; ?>" readonly>

                                            <input type="hidden" id="pr" name="pr" class="form-control" value="<?php echo $_GET['pr'] ; ?>" readonly>
                                            <input type="hidden" id="idid" name="idid" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>
                                            <input type="hidden"  name="URL" class="form-control" value="<?php echo $url; ?>" readonly>
                                            <input type="hidden"  name="nombreFormulario" class="form-control" value="<?php echo $nombreFormulario; ?>" readonly>
                                            <input type="hidden"  name="ipFormulario" class="form-control" value="<?php echo $ipFormulario; ?>" readonly>
                                            <input type="hidden" name="aterrizaje" class="form-control" value="<?php echo $aterrizajeURL; ?>" readonly>
                                            
                                            <?php
                                            // Verificar si $formActualizado está vacío
                                            if (empty($formActualizado)) {
                                                echo '<input type="hidden" name="formActualizado" class="form-control" value="1" readonly>';
                                            } else {
                                                echo '<input type="hidden" name="formActualizado" class="form-control" value="' . $formActualizado . '" readonly>';
                                            }
                                            ?>



                                            <input type="hidden" id="iduser" name="empresaUser" class="form-control" value="<?php echo $_SESSION['empresaUser'] ; ?>" readonly>
                                            <?php if (empty($mensajeOriginal)) : ?>
                                                <input type="hidden" id="mensajeOriginal" name="mensajeOriginal" class="form-control" value="<?php echo $mensaje; ?>" readonly>
                                                
                                            <?php else : ?>
                                                <input type="hidden" id="mensajeOriginal" name="mensajeOriginal" class="form-control" value="<?php echo $mensajeOriginal; ?>" readonly>
                                            <?php endif; ?>

                                            <br>
                                            <?php if (empty($idOriginal)) : ?>
                                                <input type="hidden" id="idOriginal" name="idOriginal" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>
                                                
                                            <?php else : ?>
                                                <input type="hidden" id="idOriginal" name="idOriginal" class="form-control" value="<?php echo $idOriginal; ?>" readonly>
                                            <?php endif; ?>
                                            <br>
                                          
                                            
                                                <center>
                                                <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Actualizar Datos</button>
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