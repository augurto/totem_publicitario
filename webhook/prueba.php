
<?php
// Incluir tu archivo de conexión
include './includes/conexion.php';

// Recibir datos del webhook
$data = file_get_contents("php://input");

// Parsear la cadena de consulta
parse_str($data, $formData);

// Preparar la consulta SQL para insertar datos en la tabla
$query = "INSERT INTO formulario_prueba (id_formulario, nombres, email, telefono, mensaje, documento, id_form, nombre_form) 
          VALUES (NULL, 'Juan Pérez', 'juan@example.com', '987654321', 'Este es un mensaje de prueba', '123456789', '6cf42fa', 'Prueba')";


// Ejecutar la consulta
$result = mysqli_query($con, $query);

// Verificar si la consulta fue exitosa
if ($result) {
    echo "Datos insertados correctamente en la base de datos.";
} else {
    echo "Error al insertar datos: " . mysqli_error($con);
}

// Cerrar la conexión
mysqli_close($con);
?>
