<?php
session_start();
include 'dbcon.php';

$userid = $_SESSION['userid']; 

$sql_user = "SELECT * FROM user WHERE id = '$userid' ";

$result_user = mysqli_query($connect,$sql_user);

$row = mysqli_fetch_array($result_user);

$farm_id = $row['farm_id'];
$plant3 = $row['plant3'];

$sql_user_plant_3 = "select * from user_plant ";
$sql_user_plant_3.= "where id = '$userid' and plant3 = '$plant3' order by start desc";
$result_sql_user_plant_3 = mysqli_query($connect,$sql_user_plant_3);
$row_sql_user_plant_3 = mysqli_fetch_array($result_sql_user_plant_3);

$start_day_2 = $row_sql_user_plant_3['start'];

////////////토양 수분//////////////////////////
$sql_soil = "SELECT * FROM ( 
                SELECT DATE_FORMAT(date, '%Y-%m-%d.%H') 3h, moisture, farm_id, plant_type
                FROM soil 
                WHERE DATE_FORMAT(date, '%H')%3=0 
                ORDER BY date desc LIMIT 9)so 
            WHERE farm_id = '$farm_id' and plant_type = '$plant3' and 3h > '$start_day_2'
            ORDER BY so.3h";

$result = mysqli_query($connect,$sql_soil);

$str_soil_3h="";
$str_soil_humidity="";
//mysqli_fetch_assoc() 함수는 mysqli_query()를 통하여 받아온 true 형태의 결과값이 필요하기 때문에 false이거나 null일 경우 오류가 발생하게됨.
//따라서 결과 값이 false이거나 null 값이 아닐 경우에만 mysqli_fetch_assoc() 실행.
if(!empty($result) || $result == true){ 
    while($row = mysqli_fetch_assoc($result)){
        //$row['3h']."----------".$row['temperature'].$row['humidity']."<br>");
        $h = explode(".",$row['3h']);
        $str_soil_3h.="\"".$h[1]."h\" , ";
        $str_soil_humidity.="".$row['moisture']." , ";
    }
}

$str_soil_3h=substr($str_soil_3h,0,-2);
$str_soil_humidity=substr($str_soil_humidity,0,-2);




/////////////월별 현황/////////////////////////
$sql_month="SELECT so.date, round(AVG(moisture),2) as avg_m, so.farm_id, plant_type
            FROM (SELECT date_format(date,'%Y-%m') as date, moisture, farm_id, plant_type FROM soil where date > '$start_day_2') so
            WHERE farm_id = '$farm_id' and plant_type = '$plant3'
            GROUP BY so.date, so.farm_id
            ORDER BY so.date DESC
            LIMIT 12";

$result_2 = mysqli_query($connect,$sql_month);

$str_soil_m="";
$str_soil_m_humidity="";
//mysqli_fetch_assoc() 함수는 mysqli_query()를 통하여 받아온 true 형태의 결과값이 필요하기 때문에 false이거나 null일 경우 오류가 발생하게됨.
//따라서 결과 값이 false이거나 null 값이 아닐 경우에만 mysqli_fetch_assoc() 실행.
if(!empty($result_2) || $result_2 == true){ 
    while($row_2 = mysqli_fetch_assoc($result_2)){
        //$row['3h']."----------".$row['temperature'].$row['humidity']."<br>");
        $date = explode("-",$row_2['date']);
        $str_soil_m.="\"".$date[1]."월\" , ";
        $str_soil_m_humidity.="".$row_2['avg_m']." , ";
    }
}

$str_soil_m=substr($str_soil_m,0,-2);
$str_soil_m_humidity=substr($str_soil_m_humidity,0,-2);

mysqli_close($connect);
// echo $str_soil_m;
// echo $str_temperature;
// echo $str_humdity;
// exit;
?>


