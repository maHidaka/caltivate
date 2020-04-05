<?php
$today  = date("Ymd");
$csv_dir  = '/home/pi/caltivation/log/';

$temp_file = $today.'_temperature.csv';
$grapgh_temp   = '';
$press_file = $today.'_pressure.csv';
$grapgh_press   = '';
$hum_file = $today.'_humidity.csv';
$grapgh_hum   = '';
$water_temp_file = $today.'_water_t.csv';
$grapgh_water_t   = '';
$ph_val_file = $today.'_ph_val.csv';
$grapgh_water_t   = '';

if (($handle = fopen($csv_dir.$temp_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
        $grapgh_temp .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}

if (($handle = fopen($csv_dir.$press_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
        $grapgh_press .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$hum_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
        $grapgh_hum .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$water_temp_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
        $grapgh_water_t .= '['.rtrim($line).'],'.PHP_EOL;
    }
    
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$ph_val_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
        $grapgh_ph_val .= '['.rtrim($line).'],'.PHP_EOL;
    }
    
    fclose($handle);
}else{
    echo 'no data';
}
?>
<html>
<head>
    

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">


    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '内部気温[℃]');
        data.addColumn('number', '外部気温[℃]');
        data.addRows([
            <?php echo $grapgh_temp; ?>
        ]);
        var options = {
            title: '気温'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart1'));
        chart.draw(data,options);
    }


    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '内部気圧[hPa]');
        data.addColumn('number', '外部気圧[hPa]');
        data.addRows([
            <?php echo $grapgh_press; ?>
        ]);
        var options = {
            title: '気圧'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart2'));
        chart.draw(data,options);
    }

    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '内部湿度[hPa]');
        data.addColumn('number', '外部湿度[hPa]');
        data.addRows([
            <?php echo $grapgh_hum; ?>
        ]);
        var options = {
            title: '湿度'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart3'));
        chart.draw(data,options);
    }
    
    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart4);
    function drawChart4() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '温度[℃]');
        data.addRows([
            <?php echo $grapgh_water_t; ?>
        ]);
        var options = {
            title: '水温'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart4'));
        chart.draw(data,options);
    }

    
    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart5);
    function drawChart5() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', 'pH');
        data.addRows([
            <?php echo $grapgh_ph_val; ?>
        ]);
        var options = {
            title: 'pH'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart5'));
        chart.draw(data,options);
    }

</script>
</head>
<body>

<div id="chart1"></div>
<div id="chart2"></div>
<div id="chart3"></div>
<div id="chart4"></div>
<div id="chart5"></div>

</body>
</html>

