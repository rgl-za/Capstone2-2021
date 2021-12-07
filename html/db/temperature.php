<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include 'dbcon.php';

    $farm_id = $_POST['farm_id'];
    $date=date("Y-m-d H:i:s");
	$temperature = $_POST['temperature'];
    $humidity = $_POST['humidity'];
    $plant = $_POST['plant'];

    $sql="insert into temperature(farm_id, plant_type, date, humidity, temperature)";
	$sql.="values('$farm_id','$plant','$date','$humidity','$temperature')";

    mysqli_query($connect,$sql);
    mysqli_close($connect);
?>
