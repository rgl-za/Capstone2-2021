<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');
	include "dbcon.php";

    $sql_mode=$_GET['sql_mode'];
	
	$title = $_POST['title'];
    $editor = $_POST['editor'];


	if($sql_mode == "insert"){
        $sql="insert into notice(title,content)";
        $sql.="values('$title','$editor')";
    }
    else if($sql_mode == "update"){
        $num = $_GET['num'];
        $sql="update notice set ";
        $sql.="title = '$title', content = '$editor' ";
        $sql.="where num = $num";
    }
    else if($sql_mode == "delete"){
        $num = $_GET['num'];
        $sql = "delete from notice where num = $num";
    }
		
	mysqli_query($connect,$sql);

	mysqli_close($connect);
	echo ("
		<script>
			location.href='/notice.php';
		</script>
	");
?>
