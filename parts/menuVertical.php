<?php

$empresaUser2 = $_SESSION['empresaUser'];
$idUsuarioSesion = $_SESSION['idUser'];
$tipoUsuario = $_SESSION['tipoUsuario'];
// Consulta SQL para contar los registros con prospecto igual a 4
// Verificar el valor de $tipoUsuario y ajustar la consulta en consecuencia
if ($tipoUsuario == 1) {
    // Usuario de tipo 1
    $queryContarVendidos = "SELECT COUNT(*) AS totalVendidos FROM ventas WHERE idUser = $idUsuarioSesion";
} elseif ($tipoUsuario == 2) {
    // Usuario de tipo 2
    $queryContarVendidos = "SELECT COUNT(*) AS totalVendidos FROM ventas WHERE empresaUser = $empresaUser2";
} elseif ($tipoUsuario == 3) {
    // Usuario de tipo 3
    $queryContarVendidos = "SELECT COUNT(*) AS totalVendidos FROM ventas";
} else {
    // Valor de $tipoUsuario no reconocido, se puede asignar un valor predeterminado
    $queryContarVendidos = "SELECT COUNT(*) AS totalVendidos FROM ventas";
}
/* $queryContarVendidos = "SELECT COUNT(*) AS totalVendidos FROM ventas where idUser =$idUsuarioSesion "; */
$resultContarVendidos = mysqli_query($con, $queryContarVendidos);

// Verificar si se ejecutó la consulta correctamente
if ($resultContarVendidos) {
    // Obtener el resultado como un arreglo asociativo
    $rowContarVendidos = mysqli_fetch_assoc($resultContarVendidos);

    // Extraer el valor de la columna "totalVendidos" y almacenarlo en la variable $vendidos
    $vendidos = $rowContarVendidos['totalVendidos'];
} else {
    // Si hubo un error en la consulta, asignar 0 a la variable $vendidos
    $vendidos = 0;
}


?>

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
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $noAtendidos . '</span>
                            <span>Inicio</span>
                        </a>';
                    } elseif ($tipoUsuario == 2) {
                        echo '<a href="administrador.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $noAtendidos . '</span>
                            <span>Inicio</span>
                        </a>';
                    } elseif ($tipoUsuario == 1) {
                        echo '<a href="vendedor.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $noAtendidos . '</span>
                            <span>Inicio</span>
                        </a>';
                    } else {
                        echo '<a href="login.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $noAtendidos . '</span>
                            <span>Inicio</span>
                        </a>';
                    }
                    ?>
                </li>
                <!-- end li -->
                <li>
                    <?php
                    if ($tipoUsuario == 3) {
                        echo '<a href="vendidos.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $vendidos . '</span>
                            <span>Vendidos</span>
                        </a>';
                    } elseif ($tipoUsuario == 2) {
                        echo '<a href="vendidos.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $vendidos . '</span>
                            <span>Vendidos</span>
                        </a>';
                    } elseif ($tipoUsuario == 1) {
                        echo '<a href="vendidos.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $vendidos . '</span>
                            <span>Vendidos</span>
                        </a>';
                    } else {
                        echo '<a href="vendidos.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">' . $vendidos . '</span>
                            <span>Vendidos</span>
                        </a>';
                    }
                    ?>

                </li>
                <!-- end li -->
                <li>
                    <?php
                    if ($tipoUsuario == 3) {
                        echo '<a href="reporteEmpresa.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Reportes</span>
                        </a>';
                    } elseif ($tipoUsuario == 2) {
                        echo '<a href="reporteVentasGeneral.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Reportes</span>
                        </a>';
                    } elseif ($tipoUsuario == 1) {
                        echo '<a href="reporteVentas.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Reportes</span>
                        </a>';
                    } else {
                        echo '<a href="Reportes.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i>
                            <span>Reportes</span>
                        </a>';
                    }
                    ?>

                </li>
                <!-- end li -->
            </ul>
            <!-- end ul -->
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->