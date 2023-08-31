<?php
include 'conexion.php'; // Incluir el archivo de conexión

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $dni = $_POST['dni'];
    $password = $_POST['password'];
    
    // Realizar la consulta a la base de datos
    $query = "SELECT * FROM user WHERE documento = '$dni' OR userName = '$dni' AND pass_user = '$password'";
    $result = mysqli_query($con, $query);
    
    // Verificar si se encontraron resultados
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $tipoUsuario = $row['tipo_user'];
        
        // Obtener los datos de inicio de sesión de la variable de sesión
        $usuario = $row['nombre_user'];
        $userName = $row['userName'];
        $dni = $row['documento'];
        $idUser = $row['id_user'];
        $empresaUsuario = $row['empresaUser'];

        // Iniciar sesión y guardar los datos en variables de sesión
        session_start();
        $_SESSION['usuario'] = $usuario;
        $_SESSION['userName'] = $userName;
        $_SESSION['idUser'] = $idUser;
        $_SESSION['dni'] = $dni;
        $_SESSION['tipoUsuario'] = $tipoUsuario;
        $_SESSION['empresaUser'] = $empresaUsuario;
        
        // Redireccionar según el tipo de usuario
        if ($tipoUsuario == 1) {
            header("Location: ../vendedor.php");
            exit();
        } elseif ($tipoUsuario == 2) {
            header("Location: ../inicio.php");
            exit();
        }
    } else {
        // Los datos no son válidos, mostrar un mensaje de error o redireccionar a una página de error
        header("Location: ../login.php");
            exit();
    }
}

// Cerrar la conexión a la base de datos
mysqli_close($con);
?>
