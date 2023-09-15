<?php
// Conexión al servidor LDAP
$ldapconn = ldap_connect("ldap://10.0.4.8:389") or die("No se pudo conectar al servidor LDAP.");

// Autenticación en el servidor LDAP
$ldapbind = ldap_bind($ldapconn, "cn=admin,dc=geosatelital,dc=org", "7kw7KXHAHo") or die("No se pudo autenticar en el servidor LDAP.");

// Búsqueda en el servidor LDAP
$basedn = "ou=employees,dc=geosatelital,dc=org";
$filter = "(|(employeeType=admin)(employeeType=sistemas))";
$attributes = array("uid", "cn", "sn", "mail");
$search = ldap_search($ldapconn, $basedn, $filter, $attributes);
$info = ldap_get_entries($ldapconn, $search);

// Mostrar los resultados de la búsqueda
echo "<table>";
echo "<tr><th>Nombre de usuario</th><th>Nombre</th><th>Apellidos</th><th>Correo electrónico</th></tr>";
for ($i = 0; $i < $info["count"]; $i++) {
    echo "<tr>";
    echo "<td>" . $info[$i]["uid"][0] . "</td>";
    echo "<td>" . $info[$i]["cn"][0] . "</td>";
    echo "<td>" . $info[$i]["sn"][0] . "</td>";
    echo "<td>" . $info[$i]["mail"][0] . "</td>";
    echo "</tr>";
}
echo "</table>";

// Cerrar la conexión al servidor LDAP
ldap_close($ldapconn);
?>
