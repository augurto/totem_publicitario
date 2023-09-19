<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o mostrar un mensaje de error
    header("Location: login.php");
    exit();
}
include 'includes/conexion.php'; // Incluir el archivo de conexión

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
    <link href="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />
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
                <!-- Inicio bloque 1 -->
                <div class="row">
                    <div class="col-xl-7">
                        <div class="card">
                            <div class="card-body">
                                <div class="dropdown float-end">
                                    <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        <i class="mdi mdi-dots-vertical text-muted"></i>
                                    </a>
                                    <div class="dropdown-menu dropdown-menu-end">
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Status</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                                        <!-- item-->
                                        <a href="javascript:void(0);" class="dropdown-item">Action</a>
                                    </div>
                                </div>
                                <!-- end dropdown -->
                                <h4 class="card-title mb-4">Latest Transactions</h4>
                                <div class="table-responsive">
                                    <table class="table table-centered border table-nowrap mb-0"
                                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Customer ID</th>
                                                <th>Billing Name</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th colspan="2">Action</th>
                                            </tr>
                                            <!-- end tr -->
                                        </thead>
                                        <!-- end thead -->
                                        <tbody>
                                            <tr>
                                                <td>
                                                    #DD4951
                                                    <p class="text-muted mb-0 font-size-11">24-03-2021</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <img src="assets/images/users/avatar-1.jpg"
                                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                                    class="text-dark">Julia Fox</a>
                                                            </h5>
                                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                                Grenada</p>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <h6 class="mb-1 font-size-13">$32,960</h6>
                                                    <p class="text-success text-uppercase  mb-0 font-size-11"><i
                                                            class="mdi mdi-circle-medium"></i>paid</p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">Stock</h6>
                                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546881</p>
                                                </td>
                                                <td>
                                                    <ul class="d-flex list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-heart-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                    </ul>
                                                </td>

                                                <td style="width: 134px">
                                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                                            class="mdi mdi-arrow-right ms-1"></i></div>
                                                </td>
                                            </tr>
                                            <!-- end /tr -->
                                            <tr>
                                                <td>
                                                    #DD4952
                                                    <p class="text-muted mb-0 font-size-11">25-03-2021</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <img src="assets/images/users/avatar-2.jpg"
                                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                                    class="text-dark">Max Jazz</a>
                                                            </h5>
                                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                                Vatican City</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">$30,785</h6>
                                                    <p class="text-success text-uppercase mb-0 font-size-11"><i
                                                            class="mdi mdi-circle-medium "></i>paid</p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">Out of Stock</h6>
                                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546882</p>
                                                </td>
                                                <td>
                                                    <ul class="d-flex list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-heart-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                    </ul>
                                                </td>

                                                <td>
                                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                                            class="mdi mdi-arrow-right ms-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- end /tr -->
                                            <tr>
                                                <td>
                                                    #DD4953
                                                    <p class="text-muted mb-0 font-size-11">26-03-2021</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <img src="assets/images/users/avatar-3.jpg"
                                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                                    class="text-dark">Jems Clarence</a>
                                                            </h5>
                                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                                Grenada</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">$19,191</h6>
                                                    <p class="text-warning text-uppercase  mb-0 font-size-11"><i
                                                            class="mdi mdi-circle-medium"></i>Pending</p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">Stock</h6>
                                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546883</p>
                                                </td>
                                                <td>
                                                    <ul class="d-flex list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-heart-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                                            class="mdi mdi-arrow-right ms-1"></i>
                                                    </div>
                                                </td>

                                            </tr>
                                            <!-- end /tr -->
                                            <tr>
                                                <td>
                                                    #DD4954
                                                    <p class="text-muted mb-0 font-size-11">27-03-2021</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <img src="assets/images/users/avatar-4.jpg"
                                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                                    class="text-dark">Prezy Summa</a>
                                                            </h5>
                                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                                Maldivse</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">$34,450</h6>
                                                    <p class="text-success text-uppercase mb-0 font-size-11"><i
                                                            class="mdi mdi-circle-medium "></i>paid</p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">Out of Stock</h6>
                                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546884</p>
                                                </td>
                                                <td>
                                                    <ul class="d-flex list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-heart-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                                            class="mdi mdi-arrow-right ms-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- end /tr -->
                                            <tr>
                                                <td>
                                                    #DD4955
                                                    <p class="text-muted mb-0 font-size-11">29-03-2021</p>
                                                </td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="me-3">
                                                            <img src="assets/images/users/avatar-5.jpg"
                                                                class="avatar-xs h-auto rounded-circle" alt="Error">
                                                        </div>
                                                        <div>
                                                            <h5 class="font-size-13 text-truncate mb-1"><a href="#"
                                                                    class="text-dark">Julia Fox</a>
                                                            </h5>
                                                            <p class="text-muted mb-0 font-size-11 text-uppercase">
                                                                Glory
                                                                Road</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">$24,450</h6>
                                                    <p class="text-danger text-uppercase mb-0 font-size-11"><i
                                                            class="mdi mdi-circle-medium"></i>Canceled</p>
                                                </td>
                                                <td>
                                                    <h6 class="mb-1 font-size-13">Stock</h6>
                                                    <p class="text-primary mb-0 font-size-11">ORDS- 2546885</p>
                                                </td>
                                                <td>
                                                    <ul class="d-flex list-inline mb-0">
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-trash-can-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                        <li class="list-inline-item">
                                                            <a href="#" class="btn btn-light p-0 avatar-xs d-block rounded-circle">
                                                                <span class="avatar-title bg-transparent text-body">
                                                                    <i class="mdi mdi-heart-outline"></i>
                                                                </span>
                                                            </a>
                                                        </li>
                                                        <!-- end li -->
                                                    </ul>
                                                </td>
                                                <td>
                                                    <div class="btn btn-soft-primary btn-sm">View more<i
                                                            class="mdi mdi-arrow-right ms-1"></i>
                                                    </div>
                                                </td>
                                            </tr>
                                            <!-- end /tr -->
                                        </tbody>
                                        <!-- end tbody -->
                                    </table>
                                    <!-- end table -->
                                </div>
                                <!-- end tableresponsive -->
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-5">
                        <div class="card">
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-5 col-9">
                                        <h5 class="font-size-15 mb-3">Top Selling Product</h5>
                                    </div>
                                    <!-- end col -->
                                    <div class="col-md-7 col-3">
                                        <ul class="list-inline user-chat-nav text-end mb-2">
                                            <li class="list-inline-item">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-magnify text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-md p-0">
                                                        <form class="p-2">
                                                            <div class="search-box">
                                                                <div class="position-relative">
                                                                    <input type="text" class="form-control rounded bg-light border-0"
                                                                        placeholder="Search...">
                                                                    <i class="mdi mdi-magnify search-icon"></i>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- end li -->
                                            <li class="list-inline-item d-none d-sm-inline-block">
                                                <div class="dropdown">
                                                    <a href="#" class="dropdown-toggle card-drop" data-bs-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                        <i class="mdi mdi-cog text-muted"></i>
                                                    </a>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item" href="#">View Profile</a>
                                                        <a class="dropdown-item" href="#">Add Product</a>
                                                        <a class="dropdown-item" href="#">Remove Product</a>
                                                    </div>
                                                </div>
                                            </li>
                                            <!-- end li -->
                                        </ul>
                                        <!-- end ul -->
                                    </div>
                                    <!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="table-responsive">
                                <div class="mb-3">
                                            <?php
                                            // Consulta SQL para obtener las filas donde idAterrizajeFuente = 0
                                            $query = "SELECT id_fuente, descripcionFuente FROM fuente WHERE idAterrizajeFuente = 0";
                                            $result = mysqli_query($con, $query);

                                            // Verificar si se encontraron resultados
                                            if ($result) {
                                                echo '<label class="form-label">Fuente</label>';
                                                echo '<select class="form-control select2" name="fuente">';
                                                echo '<option>Seleccione la fuente</option>';

                                                // Recorrer los resultados y generar las opciones del select
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $id_fuente = $row['id_fuente'];
                                                    $descripcionFuente = $row['descripcionFuente'];
                                                    echo "<option value='$id_fuente'>$descripcionFuente</option>";
                                                }

                                                echo '</select>';
                                            } else {
                                                echo "Error en la consulta: " . mysqli_error($con);
                                            }
                                            ?>
                                        </div>

                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label">Fechas </label>
                                                <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                    <input type="text" class="form-control" name="start" placeholder="Fecha Inicio" />
                                                    <input type="text" class="form-control" name="end" placeholder="Fecha Fin" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label">Inversión </label>
                                                <input type="number" class="form-control" name="cantidad" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Facturación</label>
                                            <input class="form-control" type="file" id="formFile" name="facturacion" />
                                        </div>

                                        <!-- Botón "Enviar" que enviará el formulario a guardarFacturacionMKT.php -->
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary" formaction="includes/guardarFacturacionMKT.php">Enviar</button>
                                        </div>
                                </div>
                                <!-- end table-responsive -->
                            </div>
                            <!-- end cardbody -->
                        </div>
                        <!-- end card -->
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
                <!-- FIN bloque 1 -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <form action="includes/guardarFacturacionMKT.php" method="post" enctype="multipart/form-data">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <?php
                                            // Consulta SQL para obtener las filas donde idAterrizajeFuente = 0
                                            $query = "SELECT id_fuente, descripcionFuente FROM fuente WHERE idAterrizajeFuente = 0";
                                            $result = mysqli_query($con, $query);

                                            // Verificar si se encontraron resultados
                                            if ($result) {
                                                echo '<label class="form-label">Fuente</label>';
                                                echo '<select class="form-control select2" name="fuente">';
                                                echo '<option>Seleccione la fuente</option>';

                                                // Recorrer los resultados y generar las opciones del select
                                                while ($row = mysqli_fetch_assoc($result)) {
                                                    $id_fuente = $row['id_fuente'];
                                                    $descripcionFuente = $row['descripcionFuente'];
                                                    echo "<option value='$id_fuente'>$descripcionFuente</option>";
                                                }

                                                echo '</select>';
                                            } else {
                                                echo "Error en la consulta: " . mysqli_error($con);
                                            }
                                            ?>
                                        </div>

                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label">Fechas </label>
                                                <div class="input-daterange input-group" id="datepicker6" data-date-format="yyyy-mm-dd" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                                    <input type="text" class="form-control" name="start" placeholder="Fecha Inicio" />
                                                    <input type="text" class="form-control" name="end" placeholder="Fecha Fin" />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <div>
                                                <label class="form-label">Inversión </label>
                                                <input type="number" class="form-control" name="cantidad" />
                                            </div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">Facturación</label>
                                            <input class="form-control" type="file" id="formFile" name="facturacion" />
                                        </div>

                                        <!-- Botón "Enviar" que enviará el formulario a guardarFacturacionMKT.php -->
                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary" formaction="includes/guardarFacturacionMKT.php">Enviar</button>
                                        </div>
                                    </div>
                                </form>
                                <div class="col-lg-8">
                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>Fuente</th>
                                            <th>Fecha Inicio</th>
                                            <th>Fecha Fin</th>
                                            <th>Inversión</th>
                                            <th>Archivo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // Consulta SQL para obtener los datos de facturacionMKT
                                        $query = "SELECT fuente, start, end, cantidad, archivo FROM facturacionMKT";
                                        $result = mysqli_query($con, $query);

                                        // Verificar si se encontraron resultados
                                        if ($result) {
                                            while ($row = mysqli_fetch_assoc($result)) {
                                                // Obtener los valores de la fila
                                                $fuente = $row['fuente'];
                                                $start = $row['start'];
                                                $end = $row['end'];
                                                $cantidad = $row['cantidad'];
                                                $archivo = $row['archivo'];

                                                // Imprimir una fila de la tabla con los datos recuperados
                                                echo "<tr>";
                                                echo "<td>$fuente</td>";
                                                echo "<td>$start</td>";
                                                echo "<td>$end</td>";
                                                echo "<td>$cantidad</td>";
                                                echo "<td>$archivo</td>";
                                                echo "</tr>";
                                            }
                                        } else {
                                            echo "Error en la consulta: " . mysqli_error($con);
                                        }
                                        ?>
                                    </tbody>
                                </table>

                            </div>
                            </div>
                            <!-- end col -->
                            
                        </div>
                        <!-- end row -->

                        <div class="row">
                            <?php

                            // Realizar la consulta para obtener los datos de la tabla "venta"
                            $query = "SELECT idVenta, idProducto, nombreProducto, precioProducto, cantidadProducto, montoAdicional, montoTotal, id_web_formularios, rutaArchivo, fechaVenta, estadoVenta, idUser, nombreArchivo, observacionVenta, empresaUser,tipoMoneda 
                        FROM ventas WHERE empresaUser =$empresaUser2";
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
                                    $empresaUser = $row['empresaUser'];
                                    $estadoVenta = $row['estadoVenta'];
                                    $tipoMoneda = $row['tipoMoneda'];
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
                                                        <span class="avatar-title bg-soft-primary text-primary font-size-16 rounded-circle">
                                                            <?php
                                                            if ($empresaUser == 1) {
                                                                echo "E";
                                                            } elseif ($empresaUser == 2) {
                                                                echo "G";
                                                            }
                                                            ?>
                                                        </span>
                                                        <!-- <img src="assets/images/companies/img-2.png" alt="img-2"
                                            class="avatar-sm mt-2 mb-4"> -->
                                                    </div>
                                                    <div class="flex-1 align-self-center">
                                                        <div class="pb-1">
                                                            <h5 class="text-truncate font-size-16 mb-1">
                                                                <a href="<?php echo $rutaArchivoNuevo; ?>" download class="text-dark" style="font-size:15px;">

                                                                    <?php
                                                                    $nombreCorto = strlen($nombreArchivo) > 25 ? substr($nombreArchivo, 0, 25) . '...' : $nombreArchivo;
                                                                    echo $nombreCorto;
                                                                    ?>
                                                                    <i class="ri-download-line"></i> <!-- Icono de descarga -->
                                                                </a>
                                                            </h5>
                                                            <p class="text-muted mb-0" style="font-size: 12px;">
                                                                <i class="mdi mdi-account me-1"></i>
                                                                <?php

                                                                // Obtener el nombre del usuario correspondiente al $idUser
                                                                $queryUser = "SELECT nombre_user FROM user WHERE id_user = $idUser";
                                                                $customResult = mysqli_query($con, $queryUser);
                                                                if ($customResult && mysqli_num_rows($customResult) > 0) {
                                                                    $customRow = mysqli_fetch_assoc($customResult);
                                                                    $customNombreUser = $customRow['nombre_user'];
                                                                    // Convertir el nombre del usuario a minúsculas
                                                                    $customNombreUser = strtolower($customNombreUser);
                                                                    // Convertir solo las iniciales a mayúsculas
                                                                    $customNombreUser = ucwords($customNombreUser);
                                                                    // Imprimir el nombre del usuario con las iniciales en mayúsculas
                                                                    echo $customNombreUser;
                                                                } else {
                                                                    echo "No se encontró el usuario";
                                                                }
                                                                ?>
                                                            </p>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-6">
                                                                <div class="mt-3 border-end">
                                                                    <p class="text-muted mb-2">
                                                                        <?php

                                                                        // Obtener el nombre del usuario correspondiente al $idUser
                                                                        $queryProducto = "SELECT nombreProducto FROM producto WHERE idProducto = $idProducto";
                                                                        $customProducto = mysqli_query($con, $queryProducto);
                                                                        if ($customProducto && mysqli_num_rows($customProducto) > 0) {
                                                                            $productoRow = mysqli_fetch_assoc($customProducto);
                                                                            $ProductoNombre = $productoRow['nombreProducto'];
                                                                            // Imprimir el nombre del usuario con las iniciales en mayúsculas
                                                                            echo $ProductoNombre;
                                                                        } else {
                                                                            echo "No se encontró el Producto";
                                                                        }
                                                                        ?>
                                                                    </p>
                                                                    <h5 class="font-size-16 mb-0"><?php echo 'Cant: ' . $cantidadProducto; ?></h5>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                            <div class="col-6">
                                                                <div class="mt-3">
                                                                    <p class="text-muted mb-2">Total</p>
                                                                    <h5 class="font-size-12 mb-0"><?php
                                                                                                    $tipoMonedaF = ($tipoMoneda == 2) ? '$' : 'S/';
                                                                                                    echo $tipoMonedaF . $montoTotal;
                                                                                                    ?></h5>
                                                                </div>
                                                            </div>
                                                            <!-- end col -->
                                                        </div>
                                                        <div class="row">
                                                            <h5 class="font-size-12 mb-0"><?php echo $nuevaFecha; ?></h5>
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

                        </div>
                        <!-- end row -->

                    </div>
                    <!-- container-fluid -->
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
        <script src="assets/libs/select2/js/select2.min.js"></script>
        <script src="assets/libs/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
        <script src="assets/libs/spectrum-colorpicker2/spectrum.min.js"></script>
        <script src="assets/libs/bootstrap-touchspin/jquery.bootstrap-touchspin.min.js"></script>
        <script src="assets/libs/admin-resources/bootstrap-filestyle/bootstrap-filestyle.min.js"></script>
        <script src="assets/libs/bootstrap-maxlength/bootstrap-maxlength.min.js"></script>
        <script src="assets/js/pages/form-advanced.init.js"></script>
        <script src="assets/js/app.js"></script>

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