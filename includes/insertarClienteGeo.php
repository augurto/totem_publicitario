<?php
include 'conexion.php';  // Reemplaza con la ruta correcta de tu archivo de conexión

// Obtener el último número disponible
$sql = "SELECT MAX(SUBSTRING(ClienteID, 10)) AS ultimo_numero FROM Cliente";
$result = mysqli_query($con, $sql);
$ultimo_numero = 0;

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $ultimo_numero = intval($row['ultimo_numero']);
}

// Generar el siguiente número
$siguiente_numero = $ultimo_numero + 1;
$numero_formateado = str_pad($siguiente_numero, 6, '0', STR_PAD_LEFT);
$cliente_id = "CL-GEO-" . $numero_formateado;

// Obtener los datos del formulario
$DniCliente = $_POST['DniCliente'];
$Nombre = $_POST['Nombre'];
$Apellido = $_POST['Apellido'];
$FechaNacimiento = $_POST['FechaNacimiento'];
$Genero = $_POST['Genero'];

// Insertar los datos en la base de datos
$sql = "INSERT INTO ClienteGeo (ClienteID, DniCliente, Nombre, Apellido, FechaNacimiento, Genero)
        VALUES ('$cliente_id', '$DniCliente', '$Nombre', '$Apellido', '$FechaNacimiento', '$Genero')";

if (mysqli_query($con, $sql)) {
    echo "Cliente registrado exitosamente";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($con);
}

mysqli_close($con);
?>
