<?php
  session_start();
  header('Content-type:text/html; charset=utf-8');
  include "dbcon.php";

    $sql_mode=$_GET['sql_mode'];

    $id = $_SESSION['userid'];
    $num = $_GET['num'];
    $comment = $_POST['comment'];
    $date = date("Y-m-d H:i:s");



    // $sql="delete from comment where count=$num and id='$id'";

    // $result=mysqli_query($connect, $sql);
    // echo $sql;
    // exit;

    $title=$_POST['title'];
    // $file=$_POST['file']['name'];
    $file = $_FILES['file']['name'];
    $content=$_POST['editor'];

    if($sql_mode=="delete")
    {
        $sql="delete from comment where count=$num and id='$id'";

        $result=mysqli_query($connect, $sql);

        if(!$result){
            echo("
                <script>
                    window.alert('댓글 삭제 실패하였습니다. 재시도 해주세요.')
                    history.go(-2)
                </script>    
            ");
            exit;
        }
        
        mysqli_close($connect);


        echo("
                <script>
                    window.alert('댓글이 삭제되었습니다!')
                    history.go(-1)
                </script>
            ");
        
    }
    
    if($sql_mode=="drop")
    {
        $sql="delete from community where num=$num and id='$id'";

        // echo $sql;
        // exit;

        $result=mysqli_query($connect, $sql);

        if(!$result){
            echo("
                <script>
                    window.alert('글 삭제 실패하였습니다. 재시도 해주세요.')
                    history.go(-1)
                </script>    
            ");
            exit;
        }

        mysqli_close($connect);


        echo("
                <script>
                    window.alert('글이 삭제되었습니다!')
                    history.go(-2)
                </script>
            ");
    }

    if($sql_mode=="modify")
    {
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
        $sql="update community set subject='$title', hash='$file_hash', memo='$content' where num=$num";

        // echo $sql;
        // exit;

        $result=mysqli_query($connect, $sql);

        if(!$result){
            echo("
                <script>
                    window.alert('글 수정 실패하였습니다. 재시도 해주세요.')
                    history.go(-1)
                </script>    
            ");
            exit;
        }

        mysqli_close($connect);

        echo("
                <script>
                    window.alert('글이 수정되었습니다!')
                    history.go(-2)
                </script>
            ");
    }

?>