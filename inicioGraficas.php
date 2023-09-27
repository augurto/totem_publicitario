<?php
   // Establece la conexión a la base de datos
   define('DB_SERVER', "localhost");
   define('DB_USERNAME', "u291982824_prueba");
   define('DB_PASSWORD', '21.17.Prueba');
   define('DB_DATABASE', 'u291982824_prueba');
   
   $con = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);
   mysqli_set_charset($con, "utf8");

   // Verifica si la conexión fue exitosa
   if (!$con) {
       die("Error al conectar a la base de datos: " . mysqli_connect_error());
   }

   // Realiza la consulta SQL
   $sql = "SELECT tc.descripcionTipoCliente, COUNT(wf.tipoCliente) AS conteo
           FROM web_formularios wf
           INNER JOIN tipoCliente tc ON wf.tipoCliente = tc.idTipoCliente
           GROUP BY tc.descripcionTipoCliente
           ORDER BY tc.descripcionTipoCliente";

   $result = mysqli_query($con, $sql);

   // Prepara los datos para la gráfica en formato JSON
   $data = array();
   while ($row = mysqli_fetch_assoc($result)) {
       $data[] = array(
           "categoria" => $row['descripcionTipoCliente'],
           "conteo" => (int)$row['conteo']
       );
   }

   // Cierra la conexión a la base de datos
   mysqli_close($con);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['bar']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var jsonData = <?php echo json_encode($data); ?>;

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Categoría');
        data.addColumn('number', 'Conteo');

        for (var i = 0; i < jsonData.length; i++) {
          data.addRow([jsonData[i].categoria, jsonData[i].conteo]);
        }

        var options = {
          chart: {
            title: 'Conteo de Categorías',
            subtitle: 'Categorías y sus conteos',
          }
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
  </body>
</html>
