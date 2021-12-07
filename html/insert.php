<? session_start(); 
    $user_id = $_SESSION['userid'];
?>

<meta charset="utf-8">

    <script>
    if(!$subject)
    {
        alert("제목을 입력하세요");
		document.editor.subject.focus();
		return;
    }
    if(!$content)
    {
        alert("내용을 입력하세요");
		document.editor.content.focus();
		return;
    }
    </script>

<?
include "db/dbcon.php";

  
$subject = $_POST['subject'];
$content = $_POST['content'];
$file = $_FILES['file']['name'];
$register = date("YmdHis", time());
$dir = "./files/";
$file_hash = $date.$_FILES['file']['name'];
$file_hash = md5($file_hash);
$upfile = $dir.$file_hash;
 
 
 
if(is_uploaded_file($_FILES['file']['tmp_name']))
    {
            if(!move_uploaded_file($_FILES['file']['tmp_name'], $upfile))
            {
                    echo "upload error";
                    exit;
            }
    }
 
 
 
//sql 수정
$sql = "insert into  community (subject, content, file, register)";     
$sql = $sql."values('$subject','$content','$file','$date')"; 

$result = mysqli_query($connect,$sql);

    
    
    if(!$result)
    {
        echo "DB upload error";
        exit;
    }
    
    
mysqli_close($mysqli);
echo("<script>location.href='index.php';</script>");
echo "<script>alert('업로드 성공');";
 
 
    
?>
