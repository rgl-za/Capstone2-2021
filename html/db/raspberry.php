<?php
    session_start();
    header("Content-Type:application/json");
    include 'dbcon.php';

    $sql = "select * from plant_data";
    if($result = mysqli_query($connect,$sql, MYSQLI_USE_RESULT)){
        $a = array();
        while($row = mysqli_fetch_object($result)){
            $t = new stdClass();
            $plant = urlencode($row->plant); //한글 깨짐 방지
            $t->budding_temp = urlencode($row->budding_temp);
            $t->good_temp = urlencode($row->good_temp);
            $t->etc_temp = urlencode($row->etc_temp);
            $t->humedity = urlencode($row->humedity);
            $t->water = urlencode($row->water);
            $t->upgrade = urlencode($row->upgrade);
            $t->harvest = urlencode($row->harvest);
            $a[$plant] = $t;
            unset($t);
        }
    }
    else {
        $a = array( 0 => 'empty');
    }
    echo urldecode(json_encode($a));
?>
