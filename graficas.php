<?php
include 'includes/conexion.php';
$query = "SELECT tipoCliente, prospecto, fecha FROM web_formularios";
$result = mysqli_query($con, $query);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
    $data[] = $row;
}

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

    <script>
        google.charts.load('current', {
            'packages': ['bar']
        });
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
            var data = new google.visualization.DataTable();
            data.addColumn('string', 'Tipo Cliente');
            data.addColumn('number', 'Prospecto');
            
            <?php
            foreach ($data as $row) {
                echo "data.addRow(['" . $row['tipoCliente'] . "', " . $row['prospecto'] . "]);";
            }
            ?>

            var options = {
                chart: {
                    title: 'Company Performance',
                    subtitle: 'Sales, Expenses, and Profit: 2014-2017',
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

            var btns = document.getElementById('btn-group');

            btns.onclick = function(e) {

                if (e.target.tagName === 'BUTTON') {
                    options.vAxis.format = e.target.id === 'none' ? '' : e.target.id;
                    chart.draw(data, google.charts.Bar.convertOptions(options));
                }
            }
        }

    </script>
</body>

</html>