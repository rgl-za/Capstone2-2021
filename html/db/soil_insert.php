<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include 'dbcon.php';

    // $farm_id = $_POST['farm_id'];
    $date=date("Y-m-d h:i:s");
	$moisture = $_POST['moisture'];
    // $id = "1";
    // $moisture = "123";
var_dump($moisture);
    $sql="insert into soil(date, moisture)";
	$sql.="values('$date','$moisture')";

    mysqli_query($connect,$sql);
    mysqli_close($connect);
?>
