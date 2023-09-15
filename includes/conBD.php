<?php

// Datos de conexión LDAP
$ldap_servidor = "ldap://10.0.4.8:389";
$ldap_usuario = "cn=admin,dc=geosatelital,dc=org";
$ldap_contrasena = "7kw7KXHAHo";

// Intentar la conexión LDAP
$ldap_conexion = ldap_connect($ldap_servidor);

if (!$ldap_conexion) {
    // Registrar un mensaje de error en el archivo de registro de errores
    error_log("Error al conectar al servidor LDAP", 0);
    die("No se pudo conectar al servidor LDAP.");
}

// Establecer opciones LDAP
ldap_set_option($ldap_conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conexion, LDAP_OPT_REFERRALS, 0);

// Intentar la autenticación
if (ldap_bind($ldap_conexion, $ldap_usuario, $ldap_contrasena)) {
    echo "Conexión LDAP exitosa.";
} else {
    // Registrar un mensaje de error en el archivo de registro de errores
    error_log("Error de autenticación LDAP: " . ldap_error($ldap_conexion), 0);
    echo "Autenticación LDAP fallida";
}

// Cerrar la conexión LDAP
ldap_close($ldap_conexion);

?>
