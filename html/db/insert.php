<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include "dbcon.php";

	
	$userid = $_POST['userid']; //아이디
    $farm_id = $_POST['farm_id']; //라즈베리파이 아이디
	$name = $_POST['username'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
    $password = $_POST['password'];
    $plant1 = $_POST['select1'];
	$plant2 = $_POST['select2'];
    $plant3 = $_POST['select3'];
	// $email1 = $_POST['email1'];
	// $email2 = $_POST['email2'];
	// $email = $email1."@".$email2;
	// $regist_day = date("Y-m-d (H:i)");

	
	$sql="insert into user(id,farm_id,username,email,phone,password,plant1,plant2,plant3)";
	$sql.="values('$userid','$farm_id','$name','$email','$phone','$password','$plant1','$plant2','$plant3')";
		//echo $sql;
		//exit;
	mysqli_query($connect,$sql);

    $date=date("Y-m-d h:i:s");

    $sql_2 ="insert into user_plant(id,plant1,plant2,plant3,start)";
    $sql.="values('$userid','$plant1','$plant2','$plant3','$date')";

	mysqli_close($connect);
	echo ("
		<script>
			location.href='/index.php';
		</script>
	");
?>
