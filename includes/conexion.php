<?php
   define('DB_SERVER', "localhost");
   define('DB_USERNAME', "u291982824_prueba");
   define('DB_PASSWORD', '21.17.Prueba');
   define('DB_DATABASE', 'u291982824_prueba');
   
   $con = mysqli_connect('localhost', 'u291982824_prueba', '21.17.Prueba', 'u291982824_prueba');
   mysqli_set_charset($con, "utf8");

   // Probar la conexión
   if (mysqli_connect_errno()) {
       echo "Error al conectar a la base de datos: " . mysqli_connect_error();
   } 
?>
