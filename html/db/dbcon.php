<?php
	$connect=mysqli_connect("localhost","easyfarm","easy1357!","easyfarm")or
	die("SQL sever에 연결할 수 없습니다.");

	// mysqli_select_db("easyfarm",$connect);
    mysqli_select_db($connect,"easyfarm") or die("연결 안됨");
	// mysqli_query("set names utf8",$connect);
?>
