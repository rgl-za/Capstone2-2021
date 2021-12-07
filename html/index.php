<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');
    $userid = $_SESSION['userid']; 

?>
<!--주석수정-->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>우리집 앞마당 모니터링</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<meta name="apple-mobile-web-app-capable" content="yes">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600"
        rel="stylesheet">
<link href="css/font-awesome.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/pages/dashboard.css" rel="stylesheet">
<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<script>
function check_input(){ //폼 유효성 검사
	if(!document.plantSelect.select1.value)
	{
		alert("1차 분류를 선택해주세요.");
		document.plantSelect.select1.focus();
		return false;
	}
	if(!document.plantSelect.select2.value || document.plantSelect.select2.value == "---2차분류---")
	{
		alert("2차 분류를 선택해주세요.");
		document.plantSelect.select2.focus();
		return false;
	}
	if(!document.plantSelect.select3.value || document.plantSelect.select3.value == "---3차분류---")
	{
		alert("3차 분류를 선택해주세요.");
		document.plantSelect.select3.focus();
		return false;
	}
	document.plantSelect.submit();
}
</script>
</head>
<style>
.value_title{
    margin-top:20px;
    margin-bottom:20px;
    font-size:15px;
}
.value{
    font-size:35px !important;
    margin-top:54px;
    margin-bottom:50px;
}
/* The Modal (background) */
.searchModal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 10; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}
/* Modal Content/Box */
.search-modal-content {
    background-color: #fefefe;
    margin: 15% auto; /* 15% from the top and centered */
    padding: 20px;
    border: 1px solid #888;
    width: 50%; /* Could be more or less, depending on screen size */
}
.field{
  margin-top:50px;
  text-align:center;
  margin-bottom:100px;
}
.btn-container{
  display: inline-block;
}
.btn-navbar, .btn-navbar:hover, .btn-navbar:active{
  background-color: #00ba8b !important;
  color:#00ba8b !important;
}
</style>
<body>
  <!--header-->
<?php include 'header.php';?>
<?php include 'db/temp_chart.php';?>
<!--?php include 'temp_chart.php'?-->
<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
        <!-- /span6 -->
        <div class="span6">
          <!--차트-->
          <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> 토양 수분 </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="area-chart" class="chart-holder" height="250" width="538"> </canvas>
              <!-- /area-chart -->
            </div>
            <!-- /widget-content -->
          </div>
          <!--/widget--->

          <div class="widget">
            <div class="widget-header">
              <i class="icon-bar-chart"></i>
              <h3>월별 현황</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="bar-chart" class="chart-holder" width="538" height="250">
              </canvas>
              <!-- /bar-chart -->
            </div>
            <!-- /widget-content -->
          </div>
          <!--/widget--->
        </div>
        <!-- /span6 -->
        <div class="span6">
          <div class="widget">
            <div class="widget-header"> <i class="icon-signal"></i>
              <h3> 온습도 </h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <canvas id="area-chart2" class="chart-holder" height="250" width="538"> </canvas>
              <!-- /area-chart -->
            </div>
            <!-- /widget-content -->
          </div>
          <!--/widget--->
          <div class="widget widget-nopad">
            <div class="widget-header"> <i class="icon-list-alt"></i>
              <h3> 현재 상태</h3>
            </div>
            <!-- /widget-header -->
            <div class="widget-content">
              <div class="widget big-stats-container">
                <div class="widget-content">
                  <h6 class="bigstats">아이콘을 통해 현재 농작물의 상태를 한눈에 확인하세요.</h6>
                  <div id="big_stats" class="cf">
                    <?php 
                        include "db/dbcon.php";

                        //날짜
                        $sql_date = "select start from user_plant ";
                        $sql_date.= "where id = '$userid' and plant3 = '$plant3' ORDER BY start DESC";
                        $result_sql_date = mysqli_query($connect,$sql_date);
                        $row_sql_date = mysqli_fetch_array($result_sql_date);

                        if($row_sql_date['start'] != ''){
                            $today = strtotime(date("Y-m-d"));
                            $start = explode(" ", $row_sql_date['start']);
                            $start_date = strtotime($start[0]);
                            $ing = date("d",$today - $start_date);
                        }
                        else{
                            $ing = 0;
                        }

                        //토양 수분
                        $sql_state_soil = "select moisture from soil ";
                        $sql_state_soil.="where farm_id = '$farm_id' and plant_type = '$plant3' ORDER BY date DESC";//현재 키우는 품종에서 최근 데이터 가져오기
                        $result_sql_state_soil = mysqli_query($connect,$sql_state_soil);
                        $row_sql_state_soil = mysqli_fetch_array($result_sql_state_soil);

                        //온습도
                        $sql_state_temp = "select temperature, humidity from temperature ";
                        $sql_state_temp.= "where farm_id = '$farm_id' and plant_type = '$plant3' ORDER BY date DESC";
                        $result_sql_state_temp = mysqli_query($connect,$sql_state_temp);
                        $row_sql_state_temp = mysqli_fetch_array($result_sql_state_temp);
                    ?>
                    <div class="stat">
                    <div class="value_title">생장 기간</div> <div class="value">D+<?=$ing?></div>
                    </div>
                    <!-- .stat -->

                    <div class="stat"> <div class="value_title">토양 수분</div> <!--<i class="icon-thumbs-up-alt"></i>--> <div class="value"><?=$row_sql_state_soil['moisture']?>%</div> </div>
                    <!-- .stat -->

                    <div class="stat"><div class="value_title">대기 온도</div> <!--<i class="icon-twitter-sign"></i>--> <div class="value"><?=$row_sql_state_temp['temperature']?>℃</div> </div>
                    <!-- .stat -->

                    <div class="stat"> <div class="value_title">대기 습도</div><!--<i class="icon-bullhorn"></i>--> <div class="value"><?=$row_sql_state_temp['humidity']?>%</div> </div>
                    <!-- .stat -->
                    <?php 
                    
                    ?>
                  </div>
                </div>
                <!-- /widget-content -->
              </div>
            </div>
          </div>
          <!-- /widget -->
        </div>
        <!-- /span6 -->
        <div class="widget widget-nopad">
          <div class="widget-header"> <i class="icon-list-alt"></i>
            <h3> 이번달 계획</h3>
            <!-- <button>작물 추가</button> -->
          </div>
          <!-- /widget-header -->
          <div class="widget-content">
            <div id='calendar'>
            </div>
          </div>
          <!-- /widget-content -->
        </div>
      </div>
      <!-- /row -->
    </div>
    <!-- /container -->
  </div>
  <!-- /main-inner -->
</div>
<!-- /main -->
<!--모달창-->
<div id="modal" class="searchModal">
    <div class="search-modal-content">
        <div class="page-header">
            <h1>새로 키우는 작물 추가하기!</h1>
        </div>
        <div class="row12">
            <div class="col-sm-12">
                <div class="row12">
                    <div class="col-sm-12">
                      <?php 
                      $sql_end_date = "select end, num from user_plant where id = '$userid' order by start desc";
                      $result_sql_end_date= mysqli_query($connect,$sql_end_date);
                      $row_sql_end_date= mysqli_fetch_array($result_sql_end_date);
                      $end = $row_sql_end_date['end'];
                      $num = $row_sql_end_date['num'];

                      if($end != ''){
                      ?>
                      <h3>키우시려는 작물을 선택하세요.</h3>
                      <form action="db/user_plant.php?mode=insert" method="post" name="plantSelect" >
                        <div class="field">
                          <select name="select1" id="select1" onchange="itemChange()">
                          <option value="">---1차분류---</option>
                          <option value="잎채소">잎채소</option>
                          <option value="열매채소">열매채소</option>
                          <option value="뿌리채소">뿌리채소</option>
                          <option value="식량작물">식량작물</option>
                          <option value="허브">허브</option>
                          </select>
                          
                          <select name="select2" id="select2" onchange="itemChange2()">
                              <option value="">---2차분류---</option>
                          </select>

                          <select name="select3" id="select3">
                              <option value="">---3차분류---</option>
                          </select>
                        </div> <!-- /field -->
                      </from>
                      <?php } else {?>
                      <h3>현재 키우고 있는 작물이 있습니다.</h3>
                      <h4 style="margin-top:30px; margin-bottom:30px;">다 자라서 수확을 하셨다면 아래 수확 완료 버튼을 눌러주세요!</h4>
                      <?php }?>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="btn-container">
          <div style="cursor:pointer;background-color:#DDDDDD;text-align: center;padding-bottom: 10px;padding-top: 10px;
               width:300px; float:left; margin-left:70px;"
              onClick="closeModal();">
              <span class="pop_bt modalCloseBtn" style="font-size: 13pt;">
              닫기
              </span>
          </div>
          <?php if($end != ''){ ?>
          <div style="cursor:pointer;background-color:#DDDDDD;text-align: center;padding-bottom: 10px;padding-top: 10px;
              width:300px; float:left; margin-left:10px;"
              onClick="check_input()">
              <span class="pop_bt modalSaveBtn" style="font-size: 13pt;">
              저장
              </span>
          </div>
          <?php } else {?>
            <div style="cursor:pointer;background-color:#DDDDDD;text-align: center;padding-bottom: 10px;padding-top: 10px;
              width:300px; float:left; margin-left:10px;"
              onclick="location.href='db/user_plant.php?mode=end_insert&&num=<?=$num?>'">
              <span class="pop_bt modalSaveBtn" style="font-size: 13pt;">
              수확 완료
              </span>
          </div>
          <?php }?>
        </div>
    </div>
</div>
<!--/모달창-->
<?php include 'footer.php';?>
<!-- /footer --> 
<!-- Le javascript
================================================== --> 
<!-- Placed at the end of the document so the pages load faster --> 
<script src="js/jquery-1.7.2.min.js"></script> 
<script src="js/excanvas.min.js"></script> 
<script src="js/chart.min.js" type="text/javascript"></script> 
<script src="js/bootstrap.js"></script>
<script language="javascript" type="text/javascript" src="js/full-calendar/fullcalendar.min.js"></script>
 
<script src="js/base.js"></script> 
<script>     
<?php include 'db/soil_chart.php';?>
<?php include 'db/calendar.php';?>
    var lineChartData = { //토양수분
      labels: [<?php echo $str_soil_3h;?>],
      datasets: [
        // {
        //     fillColor: "rgba(220,220,220,0.5)",
        //     strokeColor: "rgba(220,220,220,1)",
        //     pointColor: "rgba(220,220,220,1)",
        //     pointStrokeColor: "#fff",
        //     data: [65, 59, 90, 81, 56, 55, 40]
        // },
        {
          fillColor: "rgba(151,187,205,0.5)",
          strokeColor: "rgba(151,187,205,1)",
          pointColor: "rgba(151,187,205,1)",
          pointStrokeColor: "#fff",
          data: [<?php echo $str_soil_humidity;?>]
        }
      ]

    }

    var options = {
        scaleOverride : true, //scaleSteps를 사용하기 위해 true로 변경
        scaleSteps : 10, //y축 눈금 수
        scaleStepWidth : 10, //y축 각 눈금 간의 너비
        scaleStartValue : 0, //y축 시작 눈금 값
        scaleLabel : "<%=value%>%" //y축 값 뒤에 ℃를 붙이기 위해 사용
    }

    var myLine = new Chart(document.getElementById("area-chart").getContext("2d")).Line(lineChartData,options);

    var lineChartData2 = { //온습도
      labels: [<?php echo $str_3h;?>],
    //   labels: ["00시", "03시", "06시", "09시", "12시", "15시", "18시", "21시"],
      datasets: [
        {
          fillColor: "rgba(220,220,220,0.5)",
          strokeColor: "rgba(220,220,220,1)",
          pointColor: "rgba(220,220,220,1)",
          pointStrokeColor: "#fff",
          data: [<?php echo $str_temperature;?>],
          
        //   data: [28, 48, 40, 19, 96, 27, 100]
        }
        // ,
        // {
        //     fillColor: "rgba(151,187,205,0.5)",
        //     strokeColor: "rgba(151,187,205,1)",
        //     pointColor: "rgba(151,187,205,1)",
        //     pointStrokeColor: "#fff",
        //     data: [28, 48, 40, 19, 96, 27, 100]
        // }
      ]

    }

    var options = {
        scaleOverride : true, //scaleSteps를 사용하기 위해 true로 변경
        scaleSteps : 5, //y축 눈금 수
        scaleStepWidth : 10, //y축 각 눈금 간의 너비
        scaleStartValue : 0, //y축 시작 눈금 값
        scaleLabel : "<%=value%>℃", //y축 값 뒤에 ℃를 붙이기 위해 사용
    }

    var myLine = new Chart(document.getElementById("area-chart2").getContext("2d")).Line(lineChartData2,options);

    var barChartData = { //월별 통계
      labels: [<?php echo $str_soil_m;?>],
      datasets: [
        {
          fillColor: "rgba(220,220,220,0.5)",
          strokeColor: "rgba(220,220,220,1)",
          data: [<?php echo $str_soil_m_humidity;?>] //회색 그래프, 토양수분 월별 평균
        },
        {
          fillColor: "rgba(151,187,205,0.5)",
          strokeColor: "rgba(151,187,205,1)",
          data: [<?php echo $str_temp_m_temperature;?>] //파란색 그래프, 온도 월별 평균
        }
      ]

    }

    var options = {
        scaleOverride : true, //scaleSteps를 사용하기 위해 true로 변경
        scaleSteps : 10, //y축 눈금 수
        scaleStepWidth : 10, //y축 각 눈금 간의 너비
        scaleStartValue : 0, //y축 시작 눈금 값
        scaleLabel : "<%=value%>" //y축 값 뒤에 ℃를 붙이기 위해 사용
    }

    var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData, options);
    

    // jQuery(document).ready(function () {
    //     $("#modal").show();
    // });

    function closeModal() {
        $('.searchModal').hide();
    };

    $(document).ready(function() {
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();
        var calendar = $('#calendar').fullCalendar({
            header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
            },
            selectable: true,
            selectHelper: true,
            select: function(start, end, allDay) {
                jQuery(document).ready(function () {
                    $("#modal").show();
                });
            // var title = prompt('새로 키우는 작물 추가하기!');
            // if (title) {
            //     calendar.fullCalendar('renderEvent',
            //     {
            //         title: title,
            //         start: start,
            //         end: end,
            //         allDay: allDay
            //     },
            //     true // make the event "stick"
            //     );
            // }
            // calendar.fullCalendar('unselect');
            },
            editable: true,
            events: [
            <?php
                for($i=0;$i<$total_record;$i++){ 
                    $row=mysqli_fetch_array($result_user_plant);
                    $title=$row['plant3'];
                    $start_date_1=explode(" ",$row['start']);
                    $start_date_2=explode("-",$start_date_1[0]);
                    $end_date_1=explode(" ",$row['end']);
                    $end_date_2=explode("-",$end_date_1[0]);
            ?>
            {
                title: '<?=$title?>',
                start: new Date("<?=$start_date_2[0]?>", "<?=$start_date_2[1]-1?>", "<?=$start_date_2[2]?>"),
                <?php if($row['end'] != ''){?>
                end: new Date("<?=$end_date_2[0]?>","<?=$end_date_2[1]-1?>","<?=$end_date_2[2]?>")
                <?php } else {?>
                end: new Date(y,m,d)
                <?php }?>
            },
            <?php }?>

            // {
            //   title: 'Long Event',
            //   start: new Date(y, m, d+5),
            //   end: new Date(y, m, d+7)
            // },
            // {
            //   id: 999,
            //   title: 'Repeating Event',
            //   start: new Date(y, m, d-3, 16, 0),
            //   allDay: false
            // },
            // {
            //   id: 999,
            //   title: 'Repeating Event',
            //   start: new Date(y, m, d+4, 16, 0),
            //   allDay: false
            // },
            // {
            //   title: 'Meeting',
            //   start: new Date(y, m, d, 10, 30),
            //   allDay: false
            // },
            // {
            //   title: 'Lunch',
            //   start: new Date(y, m, d, 12, 0),
            //   end: new Date(y, m, d, 14, 0),
            //   allDay: false
            // },
            // {
            //   title: 'Birthday Party',
            //   start: new Date(y, m, d+1, 19, 0),
            //   end: new Date(y, m, d+1, 22, 30),
            //   allDay: false
            // },
            // {
            //   title: 'EGrappler.com',
            //   start: new Date(y, m, 28),
            //   end: new Date(y, m, 29),
            //   url: 'http://EGrappler.com/'
            // }
            ]
        });
    });

    function itemChange(){
      //1차분류 선택 후
      var a = ["---2차분류---","백합과","국화과","꿀풀과","명아주과","배추과"];
      var b = ["---2차분류---","가지과","고추과","박과"];
      var c = ["---2차분류---","배추과","미나리과","백합과", "생강과"];
      var d = ["---2차분류---","가지과","메꽃과","콩과","화본과"]
      var e = ["---2차분류---","꿀풀과","백합과","국화과"]
        
      var selectItem = $("#select1").val();

      var changeItem;
        
      if(selectItem == "잎채소"){
        changeItem = a;
      }
      else if(selectItem == "열매채소"){
        changeItem = b;
      }
      else if(selectItem == "뿌리채소"){
        changeItem =  c;
      }
      else if(selectItem == "식량작물"){
          changeItem = d;
      }
      else if(selectItem == "허브"){
          changeItem = e;
      }

      
      $('#select2').empty();

      for(var count = 0; count < changeItem.length; count++){ 
          var option = $("<option value="+ changeItem[count] + ">"+changeItem[count]+"</option>");
          $('#select2').append(option);
      }
        
  }

  function itemChange2(){
      //2차분류 선택 후
      var a1 = ["---3차분류---","부추"];
      var a2 = ["---3차분류---","상추","쑥갓","엔다이브"];
      var a3 = ["---3차분류---","잎들깨"];
      var a4 = ["---3차분류---","근대","적근대"];
      var a5 = ["---3차분류---","청경채","다채"];

      var b1 = ["---3차분류---","가지","수세미오이","오이","토마토"];
      var b2 = ["---3차분류---","고추"];
      var b3 = ["---3차분류---","호박"];

      var c1 = ["---3차분류---","적환무"];
      var c2 = ["---3차분류---","당근"];
      var c3 = ["---3차분류---","마늘"];
      var c4 = ["---3차분류---","생강"];

      var d1 = ["---3차분류---","감자"];
      var d2 = ["---3차분류---","고구마"];
      var d3 = ["---3차분류---","땅콩","콩(대두)","두류(강낭콩, 연두콩)"];
      var d4 = ["---3차분류---","옥수수","보리","벼"];
      
      var e1 = ["---3차분류---","타임","라벤더","레몬밤","로즈마리","민트","오레가노"];
      var e2 = ["---3차분류---","차이브"];
      var e3 = ["---3차분류---","캐모마일"];

      var selectItem = $("#select1").val(); 
      var selectItem2 = $("#select2").val(); 

      var changeItem;
        
      if(selectItem2 == "백합과"){
        if(selectItem == "잎채소"){
            changeItem = a1;
        }
        else if(selectItem == "뿌리채소"){ //여기만 안됨
            changeItem = c3;
        }
        else if(selectItem == "허브"){
            changeItem = e2;
        }
      }

      else if(selectItem2 == "국화과"){
          if(selectItem == "잎채소"){
              changeItem = a2;
          }
          else if(selectItem == "허브"){
              changeItem = e3;
          }
      }

      else if(selectItem2 == "꿀풀과"){
          if(selectItem == "잎채소"){
              changeItem = a3;
          }
          else if(selectItem == "허브"){
              changeItem = e1;
          }
      }

      else if(selectItem2 == "명아주과"){
          changeItem = a4;
      }

      else if(selectItem2 == "배추과"){ 
          if(selectItem == "잎채소"){
              changeItem = a5;
          }
          else if(selectItem == "뿌리채소"){
              changeItem = c1;
          }
      }

      else if(selectItem2 == "가지과"){
          if(selectItem == "열매채소"){
              changeItem = b1;
          }
          else if(selectItem == "식량작물"){
              changeItem = d1;
          }
      }

      else if(selectItem2 == "고추과"){
          changeItem = b2;
      }
      else if(selectItem2 == "박과"){
          changeItem = b3;
      }
      else if(selectItem2 == "미나리과"){
          changeItem = c2;
      }
      else if(selectItem2 == "생강과"){
          changeItem = c4;
      }
      else if(selectItem2 == "메꽃과"){
          changeItem = d2;
      }
      else if(selectItem2 == "콩과"){
          changeItem = d3;
      }
      else if(selectItem2 == "화본과"){
          changeItem = d4;
      }
      
      $('#select3').empty();

      for(var count = 0; count < changeItem.length; count++){ 
          var option = $("<option>"+changeItem[count]+"</option>");
          $('#select3').append(option);
      }
  }
</script><!-- /Calendar -->
</body>
</html>
