<?php
	session_start();
	$user_id = $_SESSION['userid'];
    header('Content-type:text/html; charset=utf-8');

    if(!$user_id){
        echo("
        <script>
            window.alert('로그인 후 이용하세요.')
            history.go(-1)
        </script>    
    ");
        exit;
    }

	include "dbcon.php";


    //$id=$_POST['userid'];
    $subject = $_POST['title'];
    $memo = $_POST['editor'];
    $file = $_FILES['file']['name'];
    $date = date("YmdHis", time());

    if(!$subject){
        echo("
        <script>
            window.alert('제목을 입력하세요.')
            history.go(-1)
        </script>    
    ");
        exit;
    }

    else if(!$memo){
        echo("
        <script>
            window.alert('내용을 입력하세요.')
            history.go(-1)
        </script>    
    ");
        exit;
    }

    if($file!=''){
        $dir = "../files/";
        $file_hash = $date.$_FILES['file']['name'];
        $file_hash = md5($file_hash);
        $upfile = $dir.$file_hash;
        
        if(is_uploaded_file($_FILES['file']['tmp_name']))
        {
                if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
                {
                    echo("
                    <script>
                        location.href='/editor.php'
                        window.alert('파일 업로드 실패하였습니다. 재시도 해주세요.')
                    </script>    
                ");
                }
        }
    }
    $sql = "insert into community (name, id, subject, memo, hash, time)";     
    $sql = $sql."values('$file','$user_id','$subject','$memo','$file_hash','$date')"; 
  
    	//echo $sql;
		//exit;
	//mysqli_query($connect,$sql);

    $result=mysqli_query($connect, $sql);

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
				window.alert('글이 저장되었습니다!')
                history.go(-2)
			</script>
		");
?>
