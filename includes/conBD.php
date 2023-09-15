<?php
session_start();

// Datos de conexión LDAP
$ldap_servidor = "ldap://10.0.4.8:389";
$ldap_usuario = "cn=admin,dc=geosatelital,dc=org";
$ldap_contrasena = "7kw7KXHAHo";
$ldap_base_busqueda = "ou=employees,dc=geosatelital,dc=org";
$ldap_filtro = "(|(employeeType=admin)(employeeType=sistemas))";

// Obtener valores del formulario
$dni = $_POST['dni'];
$password = $_POST['password'];

// Intentar la conexión LDAP
$ldap_conexion = ldap_connect($ldap_servidor);
if (!$ldap_conexion) {
    die("No se pudo conectar al servidor LDAP.");
}

// Establecer opciones LDAP
ldap_set_option($ldap_conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conexion, LDAP_OPT_REFERRALS, 0);

// Intentar la autenticación
if (ldap_bind($ldap_conexion, $ldap_usuario, $ldap_contrasena)) {
    // Autenticación LDAP exitosa

    // Realizar una búsqueda en el LDAP
    $ldap_resultados = ldap_search($ldap_conexion, $ldap_base_busqueda, $ldap_filtro, ['uid']);
    $ldap_entradas = ldap_get_entries($ldap_conexion, $ldap_resultados);

    $usuario_encontrado = false;

    // Verificar si el usuario existe en el LDAP
    for ($i = 0; $i < $ldap_entradas['count']; $i++) {
        if ($dni == $ldap_entradas[$i]['uid'][0]) {
            $usuario_encontrado = true;
            break;
        }
    }

    if ($usuario_encontrado) {
        // Validar contraseña aquí (puedes usar otro método de autenticación o verificar contra una base de datos local)
        // Si la autenticación es exitosa, puedes redirigir al usuario a la página de inicio de sesión.
        // Por ejemplo:
        // header('Location: inicio_sesion_exitoso.php');
        echo "Usuario autenticado correctamente.";
    } else {
        echo "Usuario no encontrado en el LDAP.";
    }

    // Cerrar la conexión LDAP
    ldap_close($ldap_conexion);
} else {
    echo "Autenticación LDAP fallida";
}

?>
