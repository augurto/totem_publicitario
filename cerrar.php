<?php
session_start(); // Iniciar la sesión

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['usuario'])) {
    // El usuario no ha iniciado sesión, redireccionar a la página de inicio de sesión o a otra página deseada
    header("Location: login.php");
    exit();
}

// Cerrar la sesión y eliminar todas las variables de sesión
$_SESSION = array(); // Eliminar todas las variables de sesión

// Destruir la sesión
session_destroy();

// Redireccionar a la página de inicio de sesión o a otra página deseada
header("Location: login.php");
exit();
?>
