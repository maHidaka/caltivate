<?php
$today  = date("Ymd");
$csv_dir  = '/home/pi/caltivation/log/';
$ctrl_dir = '/home/pi/caltivation/ctrl/';
$airSetTempNow = '';
$waterSetTempNow = '';
?>

<html>
 <head>
    <title> 栽培槽コントロールページ </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 </head>

 <body>
 <form name="control" action = "control.php" method="POST">

 <?php
    //ブラウザから送信された設定でctrlフォルダをオーバーライド
    if(""!=($_POST['valairtemp'])){
        $valairtemp = $_POST['valairtemp'];
        $handle = fopen($ctrl_dir.'airHeater_temp', "w");
        if(fwrite($handle, $valairtemp) === false){
            echo "Cannot write to file ($ctrl_dir)";
        }
        fclose($handle);
    }
    echo '<br>';
    if(""!=($_POST['valwattemp'])){
        $valwattemp = $_POST['valwattemp'];
        $handle = fopen($ctrl_dir.'waterHeater_temp', "w");
        if(fwrite($handle, $valwattemp) === false){
            echo "Cannot write to file ($ctrl_dir.'waterHeater_temp')";
        }
        fclose($handle);
    }
    //
    //現在の設定温度をctrlフォルダから取得
    if (($handle = fopen($ctrl_dir.'airHeater_temp', "r")) !== false) {
        while (($line = fgets($handle)) !== false) {
            $airSetTempNow .= rtrim($line).PHP_EOL;
        }
        fclose($handle);
    }else{
        echo 'no data';
    }
    if (($handle = fopen($ctrl_dir.'waterHeater_temp', "r")) !== false) {
        while (($line = fgets($handle)) !== false) {
            $waterSetTempNow .= rtrim($line).PHP_EOL;
        }
        fclose($handle);
    }else{
        echo 'no data';
    }
 ?>

    <fieldset>
    <h1>温度設定</h1>
    <h2>気温:
    <input type="number" name="valairtemp" min="0" max="40">
    0～40℃</h2>
    <h3>現在の設定温度:<?php echo $airSetTempNow;?></h3>
    <br>
    <h2>水温:
    <input type="number" name="valwattemp" min="0" max="35">
    0～35℃</h2>
    <h3>現在の設定温度:<?php echo $waterSetTempNow;?></h3>
    <br>
    <button type="submit">設定する</button>
    <br>
 </form>
 </fieldset>
 <fieldset>
<h1>照明</h1>
 <form name="lightcontrol" action = "ctrl.php" method="POST">
 <?php
    if($_POST['on']){
        echo "on";
        echo '<br>';
        $handle = fopen($ctrl_dir.'light_ctrl', "w");
        if(fwrite($handle, '1') === false){
            echo "Cannot write to file ($ctrl_dir)";
        }
    }
    if($_POST['off']){
        echo "off";
        echo '<br>';
        $handle = fopen($ctrl_dir.'light_ctrl', "w");
        if(fwrite($handle, '0') === false){
            echo "Cannot write to file ($ctrl_dir)";
        }
    }

 ?>
    <button type="submit" name="on" value="1">点灯</button>
    <button type="submit" name="off" value="1">消灯</button>
 </form>
</fieldset>
<fieldset>
<h1>プログラム</h1>
 <form name="progcontrol" action = "ctrl.php" method="POST">
 <?php
    if($_POST['run']){
        echo "実行中";
        echo '<br>';
        $handle = fopen($ctrl_dir.'temp_ctrl', "w");
        if(fwrite($handle, '1') === false){
            echo "Cannot write to file ($ctrl_dir)";
        }
        exec("python3 /home/pi/caltivation/prog/temp_ctrl.py > /dev/null 2>&1 </dev/null &");
        //exec("python /home/pi/caltivation/prog/call.py");
    }
    if($_POST['stop']){
        echo "停止中";
        echo '<br>';
        $handle = fopen($ctrl_dir.'temp_ctrl', "w");
        if(fwrite($handle, '0') === false){
            echo "Cannot write to file ($ctrl_dir)";
        }
    }

 ?>
    <button type="submit" name="run" value="1">実行</button>
    <button type="submit" name="stop" value="1">停止</button>
 </form>
</fieldset>

 </body>
</html>