<?php
	session_start();
    header('Content-type:text/html; charset=utf-8');

	include "dbcon.php";



    $id = $_SESSION['userid'];
    

    if(!$id){
        echo("
        <script>
            window.alert('로그인 후 이용하세요.')
            history.go(-1)
        </script>    
    ");
        exit;
    }

    // $num = $_GET['num'];

    $date = date("Y-m-d H:i:s");

    $farm_id = $_POST['farm_id']; //라즈베리파이 아이디
	
	$email = $_POST['email'];
	$phone = $_POST['phone'];
    $question = $_POST['question'];
    $plant1 = $_POST['select1'];
	$plant2 = $_POST['select2'];
    $plant3 = $_POST['select3'];

	$sql="insert into qna(id,farm_id,email,phone,question,plant1,plant2,plant3,date)";
	$sql.="values('$id','$farm_id','$email','$phone','$question','$plant1','$plant2','$plant3','$date')";
		//echo $sql;
		//exit;
	$result = mysqli_query($connect,$sql);
    

    if(!$result)
    {
        echo("
            <script>
                window.alert('작성 실패하였습니다. 다시 입력해주세요.')
                history.go(-1)
            </script>    
        ");
        exit;
    }
    
    mysqli_close($connect);


    echo("
            <script>
                window.alert('질문이 전송 되었습니다!')
                history.go(-2);
            </script>
        ");
    
?>
