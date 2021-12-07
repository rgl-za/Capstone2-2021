<?php
	session_start();
	header('Content-type:text/html; charset=utf-8');

	$user_id=$_POST['userid'];//다른 페이지에서 변수 전달
	$user_password=$_POST['password'];

	if(!$user_id)
	{
		echo("
			<script>
				window.alert('아이디를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	if(!$user_password)
	{
		echo("
			<script>
				window.alert('비밀번호를 입력하세요.')
				history.go(-1)
			</script>
		");
		exit;
	}

	include "dbcon.php";
	
    if($user_id == "admin"){
        $db_pass = "1234";
        if($user_password != $db_pass){
            echo("
                <script>
                    window.alert('비밀번호가 틀립니다.')
                    history.go(-1)
                </script>
            ");
            exit;
        }
        else{
            $_SESSION['userid']=$user_id;
            // $_SESSION['username']=$username;

            echo("
                <script>
                    history.go(-2);
                </script>
            "); //로그인하기 전 페이지로 돌아감.
        }
    }else{
        $sql="select * from user where id ='{$user_id}'";
        $result=mysqli_query($connect,$sql);
        $num_match = mysqli_num_rows($result); //데이터 레코드의 개수 
        
        if(!$num_match)
        {
            echo("
                <script>
                    window.alert('등록되지 않은 아이디입니다.')
                    history.go(-1)
                </script>
            ");
            exit;
        }

        else
        {
            $row=mysqli_fetch_array($result);
            $db_pass=$row['password'];
            // echo $db_pass;
            // exit;

            if($user_password != $db_pass)
            {
                echo("
                    <script>
                        window.alert('비밀번호가 틀립니다.')
                        history.go(-1)
                    </script>
                ");
                exit;
            }

            else
            {
                $userid=$row['id'];
                // $username=$row['username'];

                $_SESSION['userid']=$userid;
                // $_SESSION['username']=$username;

                echo("
                    <script>
                        history.go(-2);
                    </script>
                "); //로그인하기 전 페이지로 돌아감.
            }
        }
    }
	
?>
