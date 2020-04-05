<?php
$today  = date("Ymd");
$csv_dir  = '/home/pi/caltivation/log/';

$in_temp_file = $today.'_in_t.csv';
$grapgh_in_t   = '';
$in_press_file = $today.'_in_p.csv';
$grapgh_in_p   = '';
$in_hum_file = $today.'_in_h.csv';
$grapgh_in_h   = '';
$out_temp_file = $today.'_out_t.csv';
$grapgh_out_t   = '';
$out_press_file = $today.'_out_p.csv';
$grapgh_out_p   = '';
$out_hum_file = $today.'_out_h.csv';
$grapgh_out_h   = '';
$water_temp_file = $today.'_water_t.csv';
$grapgh_water_t   = '';
$ph_val_file = $today.'_ph_val.csv';
$grapgh_water_t   = '';


if (($handle = fopen($csv_dir.$in_temp_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
    $grapgh_in_t .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$in_press_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
    $grapgh_in_p .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$in_hum_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
    $grapgh_in_h .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$out_temp_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
    $grapgh_out_t .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$out_press_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
    $grapgh_out_p .= '['.rtrim($line).'],'.PHP_EOL;
    }
    fclose($handle);
}else{
    echo 'no data';
}
if (($handle = fopen($csv_dir.$out_hum_file, "r")) !== false) {
    while (($line = fgets($handle)) !== false) {
    $grapgh_out_h .= '['.rtrim($line).'],'.PHP_EOL;
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
        data.addColumn('number', '温度[℃]');
        data.addRows([
            <?php echo $grapgh_in_t; ?>
        ]);
        var options = {
            title: '内部気温'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart1'));
        chart.draw(data,options);
    }


    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart2);
    function drawChart2() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '気圧[hPa]');
        data.addRows([
            <?php echo $grapgh_in_p; ?>
        ]);
        var options = {
            title: '内部気圧'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart2'));
        chart.draw(data,options);
    }


    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart3);
    function drawChart3() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '湿度[%]');
        data.addRows([
            <?php echo $grapgh_in_h; ?>
        ]);
        var options = {
            title: '内部湿度'
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
            <?php echo $grapgh_out_t; ?>
        ]);
        var options = {
            title: '外部気温'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart4'));
        chart.draw(data,options);
    }


    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart5);
    function drawChart5() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '気圧[hPa]');
        data.addRows([
            <?php echo $grapgh_out_p; ?>
        ]);
        var options = {
            title: '外部気圧'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart5'));
        chart.draw(data,options);
    }


    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart6);
    function drawChart6() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '湿度[%]');
        data.addRows([
            <?php echo $grapgh_out_h; ?>
        ]);
        var options = {
            title: '外部湿度'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart6'));
        chart.draw(data,options);
    }
    
    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart7);
    function drawChart7() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', '温度[℃]');
        data.addRows([
            <?php echo $grapgh_water_t; ?>
        ]);
        var options = {
            title: '水温'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart7'));
        chart.draw(data,options);
    }

    
    google.charts.load('current', {packages:['corechart', 'line']});
    google.charts.setOnLoadCallback(drawChart8);
    function drawChart8() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Time');
        data.addColumn('number', 'pH');
        data.addRows([
            <?php echo $grapgh_ph_val; ?>
        ]);
        var options = {
            title: 'pH'
        };
        var chart = new google.visualization.LineChart(document.getElementById('chart8'));
        chart.draw(data,options);
    }

</script>
</head>
<body>

<div id="chart1"></div>
<div id="chart4"></div>
<div id="chart2"></div>
<div id="chart5"></div>
<div id="chart3"></div>
<div id="chart6"></div>
<div id="chart7"></div>
<div id="chart8"></div>

</body>
</html>

