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
                            <span>Inicio</span>
                        </a>';
                } elseif ($tipoUsuario == 2) {
                    echo '<a href="administrador.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                            <span>Inicio</span>
                        </a>';
                } elseif ($tipoUsuario == 1) {
                    echo '<a href="vendedor.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                            <span>Inicio</span>
                        </a>';
                } else {
                    echo '<a href="login.php" class="waves-effect">
                            <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end">'.$noAtendidos.'</span>
                            <span>Inicio</span>
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
