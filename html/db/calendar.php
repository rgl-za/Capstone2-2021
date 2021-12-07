<?php
    session_start();
    include 'dbcon.php';

    $userid = $_SESSION['userid']; 

    // $sql_user = "SELECT * FROM user WHERE id = '$userid' ";

    // $result_user = mysqli_query($connect,$sql_user);

    // $row = mysqli_fetch_array($result_user);
    $sql_user_plant = "select * from user_plant ";
    $sql_user_plant.= "where id = '$userid' order by start";
    $result_user_plant = mysqli_query($connect,$sql_user_plant);
    $total_record = mysqli_num_rows($result_user_plant);
    // echo $sql_user_plant;
    // exit;
?>
