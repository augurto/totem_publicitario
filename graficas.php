<?php
// Incluye el archivo con la conexión
include 'includes/conexion.php';  // Asegúrate de cambiar el nombre del archivo

// Consulta a la base de datos para contar registros agrupados por mes
$sql = "SELECT MONTH(fecha) AS mes, COUNT(*) AS cantidad FROM web_formularios GROUP BY MONTH(fecha)";
$result = mysqli_query($con, $sql);

// Preparar un array para almacenar los datos de la gráfica
$chartData = array();
$chartData[] = ['Mes', 'Cantidad'];

while ($row = mysqli_fetch_assoc($result)) {
    $mes = $row['mes'];
    $cantidad = (int) $row['cantidad'];
    $chartData[] = ["Mes $mes", $cantidad];
}

// Convertir el array a formato JSON
$chartJson = json_encode($chartData);

// Cierra la conexión
mysqli_close($con);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <div id="chart_div"></div>
    <br />
    <div id="btn-group">
        <button class="button button-blue" id="none">No Format</button>
        <button class="button button-blue" id="scientific">Scientific Notation</button>
        <button class="button button-blue" id="decimal">Decimal</button>
        <button class="button button-blue" id="short">Short</button>
    </div>


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div id="chart_div"></div>

<script>
    google.charts.load('current', {
        'packages': ['bar']
    });
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mes');
        data.addColumn('number', 'Cantidad');
        data.addRows(<?php echo $chartJson; ?>);

        var options = {
            chart: {
                title: 'Cantidad de Registros por Mes',
                subtitle: 'Agrupados por Mes',
            },
            bars: 'vertical',
            vAxis: {
                format: 'decimal'
            },
            height: 400,
            colors: ['#1b9e77', '#d95f02', '#7570b3']
        };

        var chart = new google.charts.Bar(document.getElementById('chart_div'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
</script>
</body>

</html>