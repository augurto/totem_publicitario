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
   $sql = "SELECT DATE_FORMAT(wf.fecha, '%b %Y') AS mes_anio, tc.descripcionTipoCliente, COUNT(wf.tipoCliente) AS conteo
           FROM web_formularios wf
           INNER JOIN tipoCliente tc ON wf.tipoCliente = tc.idTipoCliente
           GROUP BY mes_anio, tc.descripcionTipoCliente
           ORDER BY mes_anio, tc.descripcionTipoCliente";

   $result = mysqli_query($con, $sql);

   // Prepara los datos para la gráfica en formato JSON
   $data = array();
   $categorias = array();

   while ($row = mysqli_fetch_assoc($result)) {
       $mes_anio = $row['mes_anio'];
       $descripcionTipoCliente = $row['descripcionTipoCliente'];
       $conteo = (int)$row['conteo'];

       if (!in_array($descripcionTipoCliente, $categorias)) {
           $categorias[] = $descripcionTipoCliente;
       }

       if (!isset($data[$mes_anio])) {
           $data[$mes_anio] = array();
       }

       $data[$mes_anio][$descripcionTipoCliente] = $conteo;
   }

   // Cierra la conexión a la base de datos
   mysqli_close($con);
?>

<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var jsonData = <?php echo json_encode($data); ?>;
        var categorias = <?php echo json_encode($categorias); ?>;

        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mes y Año');
        
        for (var i = 0; i < categorias.length; i++) {
          data.addColumn('number', categorias[i]);
        }

        for (var mes_anio in jsonData) {
          var row = [mes_anio];
          for (var i = 0; i < categorias.length; i++) {
            row.push(jsonData[mes_anio][categorias[i]] || 0);
          }
          data.addRow(row);
        }

        var options = {
          title: 'Conteo de Categorías por Mes y Año',
          hAxis: {title: 'Mes y Año'},
          vAxis: {title: 'Conteo'},
          seriesType: 'bars',
          series: {5: {type: 'line'}} // Opcional: para mostrar una línea
        };

        var chart = new google.visualization.ComboChart(document.getElementById('columnchart_material'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="columnchart_material" style="width: 800px; height: 500px;"></div>
  </body>
</html>
