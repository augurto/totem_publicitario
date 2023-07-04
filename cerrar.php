<?php
session_start(); // Iniciar la sesión

// Eliminar todas las variables de sesión
$_SESSION = array();

// Destruir la sesión

session_destroy();

// Redireccionar a la página de inicio de sesión o a otra página deseada
header("Location: login.php");
exit();
?>
