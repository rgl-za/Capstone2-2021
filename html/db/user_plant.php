<?php
    session_start();
    include 'dbcon.php';

    $userid = $_SESSION['userid']; 

    $mode = $_GET['mode'];

    $date = date("Y-m-d H:i:s");

    if($mode == "insert"){
        $plant1 = $_POST['select1'];
        $plant2 = $_POST['select2'];
        $plant3 = $_POST['select3'];

        $sql_user = "update user set plant1 = '$plant1', plant2 = '$plant2', plant3 = '$plant3' where id='$userid'";
        mysqli_query($connect, $sql_user);

        $sql = "insert into user_plant (id, plant1, plant2, plant3, start) ";
        $sql.= "values ('$userid', '$plant1','$plant2', '$plant3', '$date')";
    }
    else if($mode == "end_insert"){
        $num = $_GET['num'];
        $sql = "update user_plant set end = '$date' where num = $num";
    }

    $result=mysqli_query($connect, $sql);


    mysqli_close($connect);

    echo ("
        <script>          
            location.href='/index.php'
        </script>
    ");
?>
