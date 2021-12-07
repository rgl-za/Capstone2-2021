<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    include "dbcon.php";

	$userid = $_SESSION['userid'];
	
	$username = $_POST['username'];
    $password = $_POST['password'];
	$email = $_POST['email'];
	$phone = $_POST['phone'];
	$farm_id = $_POST['farm_id'];

    $sql="update user set ";
    if($password != ""){
        $sql.="username='$username', password='$password', email='$email', phone='$phone', farm_id='$farm_id' ";
    }
    else{
        $sql.="username='$username', email='$email', phone='$phone', farm_id='$farm_id' ";
    }
    $sql.="where id='$userid'";

    // echo $sql;
    // exit;

    mysqli_query($connect,$sql);

	mysqli_close($connect);

    echo ("
		<script>
			location.href='/index.php';
		</script>
	");
            
?>
