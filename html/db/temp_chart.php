<?php
session_start();
include 'dbcon.php';

$sql_user = "SELECT * FROM user WHERE id = '$userid' ";
$result_user = mysqli_query($connect,$sql_user);
$row = mysqli_fetch_array($result_user);

$farm_id = $row['farm_id'];
$plant3 = $row['plant3'];


$sql_user_plant_2 = "select * from user_plant ";
$sql_user_plant_2.= "where id = '$userid' and plant3 = '$plant3' order by start desc";
$result_sql_user_plant_2 = mysqli_query($connect,$sql_user_plant_2);
$row_sql_user_plant_2 = mysqli_fetch_array($result_sql_user_plant_2);

$start_day = $row_sql_user_plant_2['start'];

///////////////온습도//////////////
$sql_temp = "SELECT * FROM ( 
                SELECT DATE_FORMAT(date, '%Y-%m-%d.%H') 3h, temperature, humidity, farm_id, plant_type
                FROM temperature 
                WHERE DATE_FORMAT(date, '%H')%3=0 
                ORDER BY date desc LIMIT 9)so 
            WHERE farm_id = '$farm_id' and plant_type = '$plant3' and 3h > '$start_day'
            ORDER BY so.3h";

$result = mysqli_query($connect,$sql_temp);

$str_3h="";
$str_temperature="";
$str_humidity="";
//mysqli_fetch_assoc() 함수는 mysqli_query()를 통하여 받아온 true 형태의 결과값이 필요하기 때문에 false이거나 null일 경우 오류가 발생하게됨.
//따라서 결과 값이 false이거나 null 값이 아닐 경우에만 mysqli_fetch_assoc() 실행.
if(!empty($result) || $result == true){ 
    while($row = mysqli_fetch_assoc($result)){
        //$row['3h']."----------".$row['temperature'].$row['humidity']."<br>");
        $h = explode(".",$row['3h']);
        $str_3h.="\"".$h[1]."h\" , ";
        $str_temperature.="".$row['temperature']." , ";
        $str_humdity.="".$row['humidity']." , ";
    }
}
$str_3h=substr($str_3h,0,-2);
$str_temperature=substr($str_temperature,0,-2);
$str_humidity=substr($str_humidity,0,-2);



////////////온습도 월별 현황////////////////////
$sql_temp_month="SELECT temp.date, round(AVG(temperature),2) as avg_t, temp.farm_id, plant_type
            FROM (SELECT date_format(date,'%Y-%m') as date, temperature, farm_id, plant_type FROM temperature where date > '$start_day') temp
            WHERE farm_id = '$farm_id' and plant_type = '$plant3' 
            GROUP BY temp.date, temp.farm_id
            ORDER BY temp.date DESC
            LIMIT 12";

$result_temp_2 = mysqli_query($connect,$sql_temp_month);

$str_temp_m="";
$str_temp_m_temperature="";
//mysqli_fetch_assoc() 함수는 mysqli_query()를 통하여 받아온 true 형태의 결과값이 필요하기 때문에 false이거나 null일 경우 오류가 발생하게됨.
//따라서 결과 값이 false이거나 null 값이 아닐 경우에만 mysqli_fetch_assoc() 실행.
if(!empty($result_temp_2) || $result_temp_2 == true){ 
    while($row_temp = mysqli_fetch_assoc($result_temp_2)){
        //$row['3h']."----------".$row['temperature'].$row['humidity']."<br>");
        $str_temp_m.="\"".$row_temp['date']."h\" , ";
        $str_temp_m_temperature.="".$row_temp['avg_t']." , ";
    }
}

$str_temp_m=substr($str_temp_m,0,-2);
$str_temp_m_temperature=substr($str_temp_m_temperature,0,-2);

mysqli_close($connect);
// echo $str_3h;
// echo $str_temperature;
//echo $str_humdity;
// exit;
?>


