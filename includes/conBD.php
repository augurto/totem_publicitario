<?php

// Datos de conexión LDAP
$ldap_servidor = "ldap://10.0.4.8:389";
$ldap_puerto = 389;
$ldap_base_busqueda = "ou=employees,dc=geosatelital,dc=org";
$ldap_usuario = "cn=admin,dc=geosatelital,dc=org";
$ldap_contrasena = "7kw7KXHAHo";

// Intentar la conexión LDAP
$ldap_conexion = ldap_connect($ldap_servidor, $ldap_puerto);

if (!$ldap_conexion) {
    die("No se pudo conectar al servidor LDAP.");
}

// Establecer opciones LDAP
ldap_set_option($ldap_conexion, LDAP_OPT_PROTOCOL_VERSION, 3);
ldap_set_option($ldap_conexion, LDAP_OPT_REFERRALS, 0);

// Intentar la autenticación
if (ldap_bind($ldap_conexion, $ldap_usuario, $ldap_contrasena)) {
    echo "Conexión LDAP exitosa.";
} else {
    echo "Error de conexión LDAP: " . ldap_error($ldap_conexion);
}

// Cerrar la conexión LDAP
ldap_close($ldap_conexion);

?>
