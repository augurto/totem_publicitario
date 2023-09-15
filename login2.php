<!doctype html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>Login GEO</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesdesign" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <!-- Bootstrap Css -->
    <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

</head>

<body class="auth-body-bg">
    <div class="home-btn d-none d-sm-block">
        <a href="index.html"></a>
    </div>
    <div class="account-pages my-5 pt-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-6 col-xl-5">
                    <div class="card">
                        <div class="card-body">
                            <div class="text-center mt-4">
                                <div class="mb-3">
                                    <a href="index.html" class="">
                                        <img src="assets/images/adNuevo.png" alt="" height="22" class="auth-logo logo-dark mx-auto" >
                                        <img src="assets/images/adNuevo.png" alt="" height="22" class="auth-logo logo-light mx-auto" >
                                    </a>
                                </div>
                            </div>
                            <div class="p-3">
                                <h4 class="font-size-18 text-muted mt-2 text-center">¡Bienvenido!</h4>
                                <p class="text-muted text-center mb-4">Iniciar Sesion</p>

                                <form class="form-horizontal" action="includes/conBD.php" method="POST">

                                    <div class="mb-3">
                                        <label class="form-label" for="username">DNI o Usuario</label>
                                        <input type="text" class="form-control" id="username" name="dni" placeholder="Documento o Usuario">
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="userpassword">Contraseña</label>
                                        <input type="password" class="form-control" id="userpassword" name="password" placeholder="Ingrese su constraseña">
                                    </div>

                                    <div class="mb-3 row mt-4">
                                        <div class="col-sm-6">
                                            <div class="form-checkbox">
                                                <input type="checkbox" class="form-check-input me-1" id="customControlInline">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 text-end">
                                            <!-- Enlace de recuperación de contraseña -->
                                        </div>
                                    </div>

                                    <div class="row mb-4">
                                        <div class="col-12 text-center">
                                            <button class="btn btn-primary w-100 waves-effect waves-light" type="submit">Iniciar Sesion</button>
                                        </div>
                                    </div>

                                </form>

                                <!-- end form -->
                            </div>
                        </div>
                        <!-- end cardbody -->
                    </div>
                    <!-- end card -->
                    <div class="mt-5 text-center">
                        <!-- <p>No tienes una cuenta ?<a href="auth-register.html" class="fw-bold text-primary"> Registrate ahora                              Now </a></p>
 -->                        <p>©
                            <script>document.write(new Date().getFullYear())</script> Adfusion <i
                                class="mdi mdi-heart text-danger"></i> 
                        </p>
                    </div>

                </div>
                <!-- end col -->
            </div>
            <!-- end row -->
        </div>
    </div>




    <!-- JAVASCRIPT -->
    <script src="assets/libs/jquery/jquery.min.js"></script>
    <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/metismenu/metisMenu.min.js"></script>
    <script src="assets/libs/simplebar/simplebar.min.js"></script>
    <script src="assets/libs/node-waves/waves.min.js"></script>

    <script src="assets/js/app.js"></script>

</body>

</html>