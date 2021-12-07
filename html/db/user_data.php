<?php
    session_start();
    header("Content-Type:application/json");
    include 'dbcon.php';

    $sql = "select farm_id, plant3 from user";
    if($result = mysqli_query($connect,$sql, MYSQLI_USE_RESULT)){
        $a = array();
        while($row = mysqli_fetch_object($result)){
            $t = new stdClass();
            $farm_id = urlencode($row->farm_id);
            $t->plant = urlencode($row->plant3); //한글 깨짐 방지
            $a[$farm_id] = $t;
            unset($t);
        }
    }
    else {
        $a = array( 0 => 'empty');
    }
    echo urldecode(json_encode($a));
?>
