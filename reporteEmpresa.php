
<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}

include 'includes/conexion.php'; // Incluir el archivo de conexión

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
$tipoUsuario = $_SESSION['tipoUsuario'];   
?>



<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Reporte de Ventas</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">
    <!-- jquery.vectormap css -->
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet"
        type="text/css" />
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet"
        type="text/css" />

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
                            <?php
                                if ($tipoUsuario == 3) {
                                    echo '<a href="inicio.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio3</span>
                                        </a>';
                                } elseif ($tipoUsuario == 2) {
                                    echo '<a href="administrador.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio2</span>
                                        </a>';
                                } elseif ($tipoUsuario == 1) {
                                    echo '<a href="vendedor.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio1</span>
                                        </a>';
                                } else {
                                    echo '<a href="login.php" class="waves-effect">
                                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                                            <span>Inicio0</span>
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
                            <h4 class="mb-sm-0">Reporte de Ventas </h4>

                            <div class="page-title-right">
                                <ol class="breadcrumb m-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Inicio</a></li>
                                    <li class="breadcrumb-item active">Reporte de ventas</li>
                                </ol>
                            </div>

                        </div>  
                    </div>
                </div>
                <!-- end page title -->
                <div class="row">
                    <?php
                        

                        // Realizar la consulta para obtener los datos de la tabla "venta"
                        $query = "SELECT idVenta, idProducto, nombreProducto, precioProducto, cantidadProducto, montoAdicional, montoTotal, id_web_formularios, rutaArchivo, fechaVenta, estadoVenta, idUser, nombreArchivo, observacionVenta FROM ventas";
                        $result = mysqli_query($con, $query);

                        // Verificar si se obtuvieron resultados
                        if (mysqli_num_rows($result) > 0) {
                            while ($row = mysqli_fetch_assoc($result)) {
                                $idVenta = $row['idVenta'];
                                $idProducto = $row['idProducto'];
                                $nombreProducto = $row['nombreProducto'];
                                $precioProducto = $row['precioProducto'];
                                $cantidadProducto = $row['cantidadProducto'];
                                $montoAdicional = $row['montoAdicional'];
                                $montoTotal = $row['montoTotal'];
                                $id_web_formularios = $row['id_web_formularios'];
                                $rutaArchivo = $row['rutaArchivo'];
                                $fechaVenta = $row['fechaVenta'];
                                $nuevaFecha = date('Y-m-d H:i:s', strtotime($fechaVenta . ' -5 hours'));

                                $estadoVenta = $row['estadoVenta'];
                                $idUser = $row['idUser'];
                                $nombreArchivo = $row['nombreArchivo'];
                                $observacionVenta = $row['observacionVenta'];
                                $rutaArchivoNuevo = str_replace("../", "", $rutaArchivo);

                    ?>
                    <div class="col-xl-3 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start">
                                    <div class="avatar-sm me-4">
                                        <span
                                            class="avatar-title bg-soft-primary text-primary font-size-16 rounded-circle">
                                            <?php
                                            if ($_SESSION['empresaUser'] == 1) {
                                                echo "E";
                                            } elseif ($_SESSION['empresaUser'] == 2) {
                                                echo "G";
                                            }
                                            ?>

                                        </span>
                                        <!-- <img src="assets/images/companies/img-2.png" alt="img-2"
                                            class="avatar-sm mt-2 mb-4"> -->
                                    </div>
                                    <div class="flex-1 align-self-center">
                                        <div class="pb-1">
                                            <h5 class="text-truncate font-size-16 mb-1"><a href="<?php echo $rutaArchivoNuevo; ?>" download 
                                                    class="text-dark"><?php
                                            $nombreCorto = strlen($nombreArchivo) > 25 ? substr($nombreArchivo, 0, 25) . '...' : $nombreArchivo;
                                            echo $nombreCorto;
                                            ?>
                                            </a>
                                                    </h5>
                                            <p class="text-muted mb-0">
                                                <i class="mdi mdi-account me-1"></i> <?php echo $idUser; ?>
                                            </p>
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="mt-3 border-end">
                                                    <p class="text-muted mb-2"><?php echo $idProducto; ?></p>
                                                    <h5 class="font-size-16 mb-0"><?php echo $cantidadProducto; ?></h5>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                            <div class="col-6">
                                                <div class="mt-3">
                                                    <p class="text-muted mb-2">Total</p>
                                                    <h5 class="font-size-16 mb-0"><?php echo $montoTotal; ?></h5>
                                                </div>
                                            </div>
                                            <!-- end col -->
                                        </div>
                                        <div class="row">

                                        <h5 class="font-size-16 mb-0"><?php echo $nuevaFecha; ?></h5>
                                        </div>
                                        <!-- end row -->
                                    </div>
                                </div>
                                <!-- end  -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                                
                    <?php
                            }
                        } else {
                            echo "No se encontraron resultados.";
                        }

                        // Cerrar la conexión a la base de datos
                        mysqli_close($con);
                    ?>
                        <div class="card">
                            <div class="card-body">
                                <div>
                                    <h4 class="card-title mb-4">Grafica </h4>
                                </div>
                                <div class="tab-content" id="pills-tabContent">
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                                        aria-labelledby="pills-home-tab">
                                        <div>
                                            <div id="spline_area_month" class="column-charts" dir="ltr">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab -->
                                    <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                        <div>
                                            <div id="spline_area_year" class="column-charts" dir="ltr">
                                            </div>
                                        </div>
                                    </div>
                                    <!-- end tab -->
                                    </div>
                                    <script>
                                        var optionsSpark3 = {
                                            series: [
                                                { name: "series1.3", data: [20, 60, 29, 96, 25, 62, 17] },
                                                { name: "series20", data: [50, 22, 82, 20, 86, 36, 71] }
                                            ],
                                            chart: {
                                                type: "area",
                                                height: 50,
                                                sparkline: { enabled: true }
                                            },
                                            stroke: { show: false, curve: "smooth" },
                                            colors: ["#5867c3", "#34c38f"],
                                            xaxis: { crosshairs: { width: 1 } },
                                            yaxis: { min: 0 },
                                            subtitle: { offsetX: 0, style: { fontSize: "14px" } }
                                        };

                                        var chartSpark3 = new ApexCharts(document.querySelector("#spline_area_month"), optionsSpark3);
                                        chartSpark3.render();

                                        var optionsSparkYear = {
                                            series: [
                                                { name: "series1", data: [70, 40, 75, 38, 88, 50, 90] },
                                                { name: "series21", data: [42, 60, 38, 66, 44, 69, 45] }
                                            ],
                                            chart: {
                                                type: "year",
                                                height: 368,
                                                toolbar: { show: false }
                                            },
                                            dataLabels: { enabled: false },
                                            stroke: { curve: "smooth", width: 3 },
                                            colors: ["#5867c3", "#34c38f"],
                                            xaxis: { type: "year", categories: ["2015", "2016", "2017", "2018", "2019", "2020", "2021"] },
                                            grid: { borderColor: "#f1f1f1" },
                                            tooltip: { x: { format: "dd/MM/yy HH:mm" } }
                                        };

                                        var chartSparkYear = new ApexCharts(document.querySelector("#spline_area_year"), optionsSparkYear);
                                        chartSparkYear.render();
                                    </script>
                                    </div>
                                    </div>
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

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- jquery.vectormap map -->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<!-- <script src="assets/js/pages/dashboard.init.js"></script> -->


</body>

</html>