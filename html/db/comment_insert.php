<?php
	session_start();
    header('Content-type:text/html; charset=utf-8');

	include "dbcon.php";

    //$sql_mode = $_GET['sql_mode'];

    $id = $_SESSION['userid'];
    
    $num = $_GET['num'];
    $comment = $_POST['comment'];
    $content = $_POST['editor'];
    $date = date("Y-m-d H:i:s");


    if(!$id){
        echo("
        <script>
            window.alert('로그인 후 이용하세요.')
            history.go(-1)
        </script>    
    ");
        exit;
    }

    if(!$comment){
        echo("
        <script>
            window.alert('댓글을 입력하세요.')
            history.go(-1)
        </script>    
    ");
        exit;
    }

    $sql = "insert into comment (num, id, comment, date) ";     
    $sql.= "values('$num','$id','$comment','$date')"; 
    //$sql.= "where num = $num";
    
            // echo $sql;
            // exit;
        // mysqli_query($connect,$sql);
    
    
    $result=mysqli_query($connect, $sql);
    // echo $result;
    // exit;

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
                window.alert('댓글이 저장되었습니다!')
                history.go(-2);
            </script>
        ");
    
?>
