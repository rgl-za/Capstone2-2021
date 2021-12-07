<?php
	session_start();
    header('Content-type:text/html; charset=utf-8');
	include "dbcon.php";

    $sql_mode = $_GET['sql_mode'];
    
    $plant1 = $_POST['plant1'];
    $plant2 = $_POST['plant2'];
    $plant3 = $_POST['plant3'];
    $title = $_POST['title'];
    $content = $_POST['editor'];
    $date = date("Y-m-d H:i:s");
    $file = $_FILES['file']['name'];

    if($file != ''){ //이미지가 없을 경우 파일 생성 안함.
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
                        window.alert('파일 얿로드 실패하였습니다. 재시도 해주세요.')
                    </script>    
                ");
                }
        }
    }
    
    if($sql_mode == "insert"){    
        $sql = "insert into information (plant1, plant2, plant3, title, content, image, date)";     
        $sql.= "values('$plant1','$plant2','$plant3','$title','$content','$file_hash','$date')"; 
    
        $result=mysqli_query($connect, $sql);

        if(!$result)
        {
            echo("
                <script>
                    location.href='/editor.php?mode=browse_write'
                    window.alert('작성 실패하였습니다. 다시 입력해주세요.')
                </script>    
            ");
            exit;
        }
        
        mysqli_close($connect);


        echo("
                <script>
                    window.alert('글이 저장되었습니다!')
                    history.go(-2);
                </script>
            ");
    }
    else if($sql_mode == "update"){
        $del_file = $_POST['del_file'];
        $num = $_GET['num'];

        if($file_hash != ''){ //이미지 선택을 했을 때
            $sql_img= "select * from information where num=$num";
            $result_sql_img = mysqli_query($connect,$sql_img);
            $row = mysqli_fetch_array($result_sql_img);
            $file_org_hash = $row['image'];

            $delete_path = "../files/".$file_org_hash;

            unlink($delete_path); //기존 이미지 파일 삭제


            $sql = "update information set ";     
            $sql.= "plant1='$plant1', plant2='$plant2', plant3='$plant3', title='$title', content='$content', image='$file_hash', date='$date'";
            $sql.= "where num = $num";
        }
        else{ //이미지를 선택 안했을 때
            $sql_img= "select * from information where num=$num";
            $result_sql_img = mysqli_query($connect,$sql_img);
            $row = mysqli_fetch_array($result_sql_img);
            $file_org_hash = $row['image'];

            if($del_file == "y"){ //이미지를 삭제할 때
                $delete_path = "../files/".$file_org_hash;

                unlink($delete_path); //파일 삭제
                
                
            }else{ //원래 저장되어 있는 이미지를 유지할 때
                $file_hash = $file_org_hash;
            }

            $sql = "update information set ";     
            $sql.= "plant1='$plant1', plant2='$plant2', plant3='$plant3', title='$title', content='$content', image='$file_hash', date='$date'";
            $sql.= "where num = $num";
        }

        

        $result=mysqli_query($connect, $sql);

        if(!$result)
        {
            echo("
                <script>
                    location.href='/editor.php?mode=browse_write'
                    window.alert('작성 실패하였습니다. 다시 입력해주세요.')
                </script>    
            ");
            exit;
        }
        
        mysqli_close($connect);


        echo("
                <script>
                    window.alert('글이 수정되었습니다!')
                    history.go(-2);
                </script>
            ");
    }
    else if($sql_mode == "delete"){
        
        $num = $_GET['num'];

        $sql_img= "select * from information where num=$num";
        $result_sql_img = mysqli_query($connect,$sql_img);
        $row = mysqli_fetch_array($result_sql_img);
        $file_org_hash = $row['image'];

        if($file_org_hash != ''){
            $delete_path = "../files/".$file_org_hash;

            unlink($delete_path); //파일 삭제
        }

        $sql = "delete from information where num = $num";

        $result=mysqli_query($connect, $sql);

        if(!$result)
        {
            echo("
                <script>
                    location.href='/editor.php?mode=browse_write'
                    window.alert('삭제를 실패하였습니다. 다시 시도해주세요.')
                </script>    
            ");
            exit;
        }
        
        mysqli_close($connect);


        echo("
                <script>
                    window.alert('글이 삭제되었습니다!')
                    history.go(-2);
                </script>
            ");
    }
    
    
?>
