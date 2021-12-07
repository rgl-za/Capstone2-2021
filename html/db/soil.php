<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include 'dbcon.php';

    $farm_id = $_POST['farm_id'];
    $date=date("Y-m-d H:i:s");
	$moisture = $_POST['moisture'];
    $plant = $_POST['plant'];

    $sql="INSERT INTO soil(farm_id,plant_type,date,moisture)";
	$sql.="VALUES('$farm_id','$plant','$date','$moisture')";

    mysqli_query($connect,$sql);
    mysqli_close($connect);
?>
