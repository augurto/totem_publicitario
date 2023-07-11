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
$selectQuery = "SELECT datos_form, email, telefono,documentoCliente, mensaje, fecha, id_user FROM web_formularios WHERE id_form_web = $idUrl";
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

// Cerrar la conexión a la base de datos
mysqli_close($con);                    

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

            
            <header id="page-topbar">
                <div class="navbar-header">
                    <div class="d-flex">
                        <!-- LOGO -->
                        <div class="navbar-brand-box">
                            <a href="index.html" class="logo logo-dark">
                                <span class="logo-sm">
                                    <img src="assets/images/adfusion.png" alt="logo-sm-dark" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/adfusion.png" alt="logo-dark" height="22">
                                </span>
                            </a>

                            <a href="index.html" class="logo logo-light">
                                <span class="logo-sm">
                                    <img src="assets/images/adfusion.png" alt="logo-sm-light" height="22">
                                </span>
                                <span class="logo-lg">
                                    <img src="assets/images/adfusion.png" alt="logo-light" height="22">
                                </span>
                            </a>
                        </div>

                        <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                            <i class="ri-menu-2-line align-middle"></i>
                        </button>

                        <!-- App Search-->
                        <form class="app-search d-none d-lg-block">
                            <div class="input-group">
                                <button class="btn btn-rounded dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">Projects <i class="mdi mdi-chevron-down ms-2"></i></button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="#">Jobs</a></li>
                                    <li><a class="dropdown-item" href="#">Users</a></li>
                                    <li><a class="dropdown-item" href="#">Projects</a></li>
                                </ul>
                                <input type="text" class="form-control bg-transparent" placeholder="Search.."
                                    aria-label="Text input with dropdown button">
                                <span class="mdi mdi-magnify"></span>
                            </div>

                        </form>

                        <div class="dropdown dropdown-mega d-none d-xl-block ms-2">
                            <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown"
                                aria-haspopup="false" aria-expanded="false">
                                Mega Menu
                                <i class="mdi mdi-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu dropdown-megamenu">
                                <div class="row">
                                    <div class="col-sm-8">

                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5 class="font-size-14 mt-0">UI Components</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">Lightbox</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Range Slider</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Sweet Alert</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Rating</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Forms</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Tables</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Charts</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-md-4">
                                                <h5 class="font-size-14 mt-0">Applications</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">Ecommerce</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Calendar</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Email</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Projects</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Tasks</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Contacts</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-md-4">
                                                <h5 class="font-size-14 mt-0">Extra Pages</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">Light Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Compact Sidebar</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Horizontal layout</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Maintenance</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Coming Soon</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Timeline</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">FAQs</a>
                                                    </li>

                                                </ul>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- end col -->

                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h5 class="font-size-14 mt-0">UI Components</h5>
                                                <ul class="list-unstyled megamenu-list">
                                                    <li>
                                                        <a href="javascript:void(0);">Lightbox</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Range Slider</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Sweet Alert</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Rating</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Forms</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Tables</a>
                                                    </li>
                                                    <li>
                                                        <a href="javascript:void(0);">Charts</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-sm-5">
                                                <div>
                                                    <img src="assets/images/megamenu-img.png" alt="megamenu-img"
                                                        class="img-fluid mx-auto d-block">
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <!-- end row -->
                                    </div>
                                    <!-- end col -->
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="dropdown d-inline-block d-lg-none">
                            <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="top-icon">
                                    <i class="ri-search-line"></i>
                                </div>

                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-search-dropdown">
                                <form class="p-3">
                                    <div class="m-0">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Search ...">
                                            <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- end -->


                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="top-icon">
                                    <i class="mdi mdi-apps"></i>
                                </div>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                                <div class="px-lg-2">
                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/github.png" alt="Github">
                                                <span>GitHub</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/bitbucket.png" alt="bitbucket">
                                                <span>Bitbucket</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/dribbble.png" alt="dribbble">
                                                <span>Dribbble</span>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="row g-0">
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/dropbox.png" alt="dropbox">
                                                <span>Dropbox</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/mail_chimp.png" alt="mail_chimp">
                                                <span>Mail Chimp</span>
                                            </a>
                                        </div>
                                        <div class="col">
                                            <a class="dropdown-icon-item" href="#">
                                                <img src="assets/images/brands/slack.png" alt="slack">
                                                <span>Slack</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end -->

                        <div class="dropdown d-none d-lg-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                                <div class="top-icon">
                                    <i class="mdi mdi-fullscreen"></i>
                                </div>
                            </button>
                        </div>
                        <!-- end  -->

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon waves-effect"
                                id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <div class="top-icon">
                                    <i class="mdi mdi-bell"></i>
                                </div>
                                <span class="badge bg-danger rounded-pill">3</span>
                            </button>
                            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                                aria-labelledby="page-header-notifications-dropdown">
                                <div class="p-3">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="m-0"> Notifications </h6>
                                        </div>
                                        <div class="col-auto">
                                            <a href="#!" class="small"> View All</a>
                                        </div>
                                    </div>
                                </div>
                                <div data-simplebar style="max-height: 230px;">
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-primary rounded-circle font-size-16">
                                                    <i class="ri-shopping-cart-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">Your order is placed</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-3.jpg" class="me-3 rounded-circle avatar-xs"
                                                alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">James Lemire</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">It will seem like simplified English.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <div class="avatar-xs me-3">
                                                <span class="avatar-title bg-success rounded-circle font-size-16">
                                                    <i class="ri-checkbox-circle-line"></i>
                                                </span>
                                            </div>
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">If several languages coalesce the grammar</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>

                                    <a href="" class="text-reset notification-item">
                                        <div class="d-flex">
                                            <img src="assets/images/users/avatar-4.jpg" class="me-3 rounded-circle avatar-xs"
                                                alt="user-pic">
                                            <div class="flex-1">
                                                <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                                <div class="font-size-12 text-muted">
                                                    <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                                    <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="p-2 border-top">
                                    <div class="d-grid">
                                        <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                            <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end notification -->

                        <div class="dropdown d-inline-block user-dropdown">
                            <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <!-- <img class="rounded-circle header-profile-user" src="assets/images/users/avatar-7.jpg"
                                    alt="Header Avatar"> -->
                                    <span class="d-none d-xl-inline-block ms-1"><?php echo $_SESSION['usuario'] ; ?></span>
                                <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-end">
                                <!-- item-->
                                <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                                <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                                <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i
                                        class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                                <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock
                                    screen</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="./cerrar.php"><i
                                        class="ri-shut-down-line align-middle me-1 text-danger"></i> Cerrar Sesion</a>
                            </div>
                        </div>
                        <!-- end user -->

                        <div class="dropdown d-inline-block">
                            <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                                <div class="top-icon">
                                    <i class="mdi mdi-cog-outline mdi-spin"></i>
                                </div>
                            </button>
                        </div>
                        <!-- end setting -->
                    </div>
                </div>
            </header>

            <!-- ========== Left Sidebar Start ========== -->
            <div class="vertical-menu">

                <div data-simplebar class="h-100">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu list-unstyled" id="side-menu">
                            <li class="menu-title">Menu</li>

                            <li>
                                <a href="inicio.php" class="waves-effect">
                                    <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">69</span>
                                    <span>Inicio</span>
                                </a>
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

                                <form id="myForm" action="includes/guardar_user.php" method="post">
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
                                            <div class="row mb-6">
                                                <label for="example-number-input" class="col-sm-2 col-form-label">Documento..</label>
                                                <div class="col-sm-10">
                                                    
                                                <input class="form-control" type="number" value="<?php echo $documento; ?>" id="example-number-input" name="documento" maxlength="9" <?php if ($documento !== null) { echo "readonly"; } ?>>

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
                                                <a href="https://api.whatsapp.com/send?phone=<?php echo $telefono; ?>" target="_blank"><?php echo $telefono; ?></a>

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
                                            <div class="mt-6">
                                                <label class="mb-1">Comentario</label>
                                                
                                                <textarea  id="textarea" class="form-control" maxlength="225" rows="3" name="comentario" readonly><?php echo $mensaje; ?></textarea>

                                            </div>
                                            <br>
                                            <?php 
                                            
                                            // Restar 5 horas a la fecha
                                            $nuevaFecha = date('Y-m-d H:i:s', strtotime($fecha . ' -5 hours'));
                                            echo "Atendido por : ".ucwords($nombreUserEdicion)."\nFecha : ".$nuevaFecha ; ?>
                                            <input type="hidden" class="form-control" id="id-input" name="idweb" readonly>

                                            <script>
                                                // Obtener el valor de la variable "id" de la URL
                                                const urlParams = new URLSearchParams(window.location.search);
                                                const id = urlParams.get('id');

                                                // Establecer el valor en el input
                                                document.getElementById('id-input').value = id;
                                            </script>
                                            <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?php echo $_SESSION['idUser'] ; ?>" readonly>

                                            <input type="text" id="pr" name="pr" class="form-control" value="<?php echo $_GET['pr'] ; ?>" readonly>
                                            <br>
                                           <?php if ($documento === null): ?>
                                                <center>
                                                    <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Actualizar Datos</button>
                                                </center>
                                            <?php endif; ?>

                                                    
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

                    <div class="col-lg-6">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Seguimiento de Cliente</h4>
                                
                                <form  action="includes/guardar_webform.php" method="post" >
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div class="mb-12">
                                                <label class="form-label">Buscar Cliente</label>
                                                
                                                <select class="form-control select2" id="idcliente" name="idcliente">
                                                <?php
                                                 include 'includes/conexion.php'; 
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $queryc = "SELECT * FROM web_formularios WHERE id_form_web=$idUrl ";
                                                $resultc = mysqli_query($con, $queryc);

                                                // Verificar si se encontraron resultados
                                                if (mysqli_num_rows($resultc) > 0) {
                                                    // Generar las opciones dentro del select
                                                    while ($rowc= mysqli_fetch_assoc($resultc)) {
                                                    $valuec = $rowc['documentoCliente'];
                                                    $textc = $rowc['datos_form'];
                                                    $telefonoc = $rowc['telefono'];
                                                    echo "<option value='" . $valuec . "'>" .$valuec."-". $textc."-".$telefonoc. "</option>";
                                                    
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
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
                                                    echo "<option value='" . $value . "'>" . $text . "</option>";
                                                    }
                                                }

                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                ?>
                                                </select>

                                            </div>
                                            <div class="mb-12">
                                                <label class="form-label">Tipo de Cliente</label>
                                                                                                
                                                <select class="form-control select2" id="tipoCliente2" name="tipoCliente2">
                                                <?php
                                                 include 'includes/conexion.php'; 
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $query = "SELECT * FROM tipoClienteCliente";
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
                                            <?php 
                                            $prospectoExistente = $_GET['pr'];
                                            /* Google ADS
                                            Meta ADS */

                                            if ($prospectoExistente == "Meta ADS") {
                                                echo '<input type="text" id="prospecto" name="prospecto" class="form-control" value="2" readonly>';
                                            } elseif ($prospectoExistente == "Google ADS") {
                                                echo '<input type="text" id="prospecto" name="prospecto" class="form-control" value="3" readonly>';
                                            }elseif ($prospectoExistente == "Organico") {
                                                echo '<input type="text" id="prospecto" name="prospecto" class="form-control" value="1" readonly>';
                                            } else {
                                                echo '
                                                <div class="mb-12">
                                                    <label class="form-label">Fuente</label>
                                                    <select class="form-control select2" id="prospecto" name="prospecto">';
                                                    
                                                include 'includes/conexion.php';
                                                // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                                $query2 = "SELECT * FROM fuente where idAterrizajeFuente = 1";
                                                $result2 = mysqli_query($conn, $query2);
                                                
                                                // Verificar si se encontraron resultados
                                                if (mysqli_num_rows($result2) > 0) {
                                                    // Generar las opciones dentro del select
                                                    while ($row2 = mysqli_fetch_assoc($result2)) {
                                                        $value2 = $row2["tipoFuente"];
                                                        $text2 = $row2["descripcionFuente"];
                                                        echo "<option value='" . $value2 . "'>" . $text2 . "</option>";
                                                    }
                                                }
                                                
                                                // Cerrar la conexión a la base de datos
                                                mysqli_close($con);
                                                
                                                echo '
                                                    </select>
                                                </div>';
                                            }
                                            ?>


                                            <div class="mt-12">
                                                <label class="mb-1">Observacion</label>
                                                
                                                <textarea id="observacion" name="observacion" class="form-control" maxlength="225" rows="3"
                                                    placeholder="Observacion al Cliente"></textarea>
                                            </div>
                                            <input type="hidden" id="idid" name="idid" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>


                                            <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?php echo $_SESSION['idUser'] ; ?>" readonly>
                                            <input type="text" id="prospectoExistente" name="empresaUser" class="form-control" value="<?php echo $prospectoExistente ; ?>" readonly>
                                            <br>
                                            <center>
                                                <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Registrar Cliente</button>
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

                       <!--  agregando otra columna -->
                       <div class="checkbox-container">
                            <input type="checkbox" id="switch1" switch="none" onchange="toggleElement()" />
                            <label for="switch1" data-on-label="CON " data-off-label="SIN "></label>
                            <p>FACTURACIÓN</p>
                        </div>
                        <style>
                            .checkbox-container {
                                display: flex;
                                align-items: center;
                            }

                            .checkbox-container input[type="checkbox"] {
                                margin-right: 10px;
                            }

                            .checkbox-container p {
                                margin: 0;
                            }

                        </style>

                        <script>
                            function toggleElement() {
                                var checkbox = document.getElementById("switch1");
                                var elemento = document.getElementById("elemento");

                                if (checkbox.checked) {
                                    elemento.style.display = "block";
                                } else {
                                    elemento.style.display = "none";
                                }
                            }
                        </script>
                    <div id="elemento" class="col-lg-12" style="display: none;">
                    <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Seguimiento de Cliente</h4>
                                
                                
                                    <div class="row">
                                        <div class="col-lg-12">
                                        <div class="mb-12">
                                        <label class="form-label">Buscar Producto</label>
                                        <select class="form-control select2" id="idproducto" name="idproducto">
                                        <?php
                                        include 'includes/conexion.php'; 
                                        
                                        // Realizar la consulta a la base de datos para obtener los datos de la tabla
                                        $queryp = "SELECT * FROM producto";
                                        $resultp = mysqli_query($con, $queryp);

                                        // Verificar si se encontraron resultados
                                        if (mysqli_num_rows($resultp) > 0) {
                                            // Generar las opciones dentro del select
                                            while ($rowp = mysqli_fetch_assoc($resultp)) {
                                                $valuep = $rowp['idProducto'];
                                                $textp = $rowp['nombreProducto'];
                                                $preciop = $rowp['precioProducto'];
                                                echo "<option value='" . $valuep . "'>" . $textp . " - Precio: " . $preciop . "</option>";
                                            }
                                        }

                                        // Cerrar la conexión a la base de datos
                                        mysqli_close($con);
                                        ?>
                                        </select>
                                        <button onclick="buscar()"  class="form-control" >Buscar</button>
                                    </div>
                                    
                                    <form action="includes/ventasProducto.php" method="post" enctype="multipart/form-data">
                                    <input type="text" id="idProductoInput" name="idProductoInput" class="form-control" readonly>
                                    <label class="form-label">Nombre Producto</label>
                                    <input type="text" id="nombreInput" class="form-control" name="nombreInput" readonly>
                                    <label class="form-label">Precio del Producto</label>
                                    <input type="text" id="precioInput" name="precioInput" class="form-control" readonly>
                                    <label class="form-label">Cantidad Producto</label>
                                    <input type="text" id="cantidad" name="cantidad" class="form-control" oninput="calcularMontoTotal()">
                                    <label class="form-label">Monto adicional</label>
                                    <input type="text" id="montoAdicional" name="montoAdicional" class="form-control" oninput="calcularMontoTotal()">
                                    <label class="form-label">Monto Total</label>
                                    <input type="text" id="montoTotal" name="montoTotal" class="form-control" readonly>
                                    <div class="mb-3">
                                        <label for="formFile" class="form-label">Adjuntar archivo</label>
                                        
                                        <input class="form-control" type="file" id="archivo" name="archivo">

                                    </div>

                                    <script>
                                        function buscar() {
                                            var select = document.getElementById("idproducto");
                                            var idProductoInput = document.getElementById("idProductoInput");
                                            var nombreInput = document.getElementById("nombreInput");
                                            var precioInput = document.getElementById("precioInput");
                                            var selectedOption = select.options[select.selectedIndex];
                                            var valueSeleccionado = selectedOption.value;
                                            var textoSeleccionado = selectedOption.text;
                                            var partes = textoSeleccionado.split(" - Precio: ");
                                            idProductoInput.value = valueSeleccionado;
                                            nombreInput.value = partes[0];
                                            precioInput.value = partes[1];
                                        }
                                        function calcularMontoTotal() {
                                            var cantidadInput = document.getElementById("cantidad");
                                            var precioInput = document.getElementById("precioInput");
                                            var montoAdicionalInput = document.getElementById("montoAdicional");
                                            var montoTotalInput = document.getElementById("montoTotal");

                                            var cantidad = parseInt(cantidadInput.value) || 0;
                                            var precio = parseFloat(precioInput.value) || 0;
                                            var montoAdicional = parseFloat(montoAdicionalInput.value) || 0;

                                            var montoTotal = (cantidad * precio) + montoAdicional;
                                            montoTotalInput.value = montoTotal.toFixed(2);
                                        }
                                    </script>

                                            
                                            <div class="mt-12">
                                                <label class="mb-1">Observacion</label>
                                                
                                                <textarea id="observacion" name="observacion" class="form-control" maxlength="225" rows="3"
                                                    placeholder="Observacion al Cliente"></textarea>
                                            </div>
                                            <input type="hidden" id="idid" name="idid" class="form-control" value="<?php echo $_GET['id']; ?>" readonly>


                                            <input type="hidden" id="iduser" name="iduser" class="form-control" value="<?php echo $_SESSION['idUser'] ; ?>" readonly>
                                            <br>
                                            <center>
                                                <button type="submit" id="submitBtn" class="btn btn-outline-success btn-rounded waves-effect waves-light">Guardar</button>
                                            </center>

                                            </form>
                                            
                                        </div>
                                        <!-- end col -->
                                        
                                        <!-- end col -->
                                    </div>
                                    <!-- end row -->
                                
                               
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

        <footer class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <script>document.write(new Date().getFullYear())</script> © Upbond.
                    </div>
                    <div class="col-sm-6">
                        <div class="text-sm-end d-none d-sm-block">
                            Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign
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