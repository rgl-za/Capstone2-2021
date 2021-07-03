<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');
    include 'db/dbcon.php';

    $plant3 = $_GET['plant3'];

    $sql="select * from information where plant3='$plant3'";
    $result = mysqli_query($connect,$sql);

    $row = mysqli_fetch_array($result);

    $num = $row['num'];
    $title = $row['title'];
    $content = $row['content'];
    $image= $row['image'];
    // $date = ;
    $date = explode(" ",$row['date']);
?>
<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <title>우리집 앞마당 모니터링</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet">

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
        <link href="css/font-awesome.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet">

        <link href="css/pages/reports.css" rel="stylesheet">
        <link href="css/comunity_styles.css" rel="stylesheet" />

    </head>
    <style>
        .btn_container {
            margin-left: 85%;
        }
        .btn{
            font-size:10px;        }

        a:link {
            text-decoration: none;
            color: #333333;
        }

        a:visited {
            text-decoration: none;
            color: #333333;
        }

        a:active {
            text-decoration: none;
            color: #333333;
        }

        a:hover {
            text-decoration: none;
        }

        .card-img-top {
            width:100%;
            /* height:auto !important; */
            object-fit: cover;
        }

    </style>

    <body>
        <!-- Navigation-->
        <?php include 'header.php'?>

        <div class="main">

            <div class="main-inner">
                <div class="container">

                    <div class="row">

                        <div class="span12">

                            <div class="info-box">
                                <div class="row-fluid stats-box">
                                    <!-- 관리자일 경우에 작성버튼 생김 -->
                                    <?php if($userid == "admin"){?> 
                                    <div class="btn_container">
                                        <button class="btn btn-primary" onclick="location.href='editor.php?mode=browse_write&&mode2=update&&plant3=<?=$plant3?>'">수정하기</button>
                                        <button class="btn btn-primary" onclick="location.href='db/browse_insert.php?sql_mode=delete&&num=<?=$num?>'">삭제</button>
                                    </div>
                                    
                                    <?php }?>
                                    <!-- Page Content-->
                                    <div class="container2">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h1 class="my-4">찾아보기 <i class="icon-leaf"></i></h1>
                                                <div class="list-group">
                                                        <a class="list-group-item" href="#">실내 텃밭 가꾸기</a>
                                                        <a class="list-group-item" href="#">텃밭 해충 관리</a>
                                                        <a class="list-group-item" href="#">새싹작물 기르기</a>

                                                    <?php //}?>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="card mt-4">
                                                    <img class="card-img-top"
                                                        src="../files/<?=$image?>" alt="..." />
                                                    <div class="card-body">
                                                        <h3 class="card-title">실내 텃밭 가꾸기</h3>
                                                        <p class="card-text">텃밭 가꾸기는 취미와 여가활동, 먹거리 생산을 넘어서 마음을 안정시키는 효과가 있습니다.<br>
                                                                            코로나19와 미세먼지로 외출이 쉽지 않아 우울감을 느끼는 요즘,<br> 
                                                                            집안 텃밭을 가꾸면 자연이 주는 위로와 기쁨을 얻을 수 있습니다.<br><br>
                                                                            우리집 앞마당은 바깥 활동을 자제하고 집 안에 머무는 동안 우울과 무기력증을 느끼는 이들에게<br> 
                                                                            주거 공간을 활용한 실내 텃밭 가꾸기를 제안해 봅니다.<br><br>
                                                                            농촌진흥청이 2015~2017년 유아·아동 자녀를 둔 부모에게 텃밭 프로그램(식물 기르고 수확물 이용 활동)을 적용한 결과,<br> 
                                                                            부모는 스트레스 지표인 ‘코르티솔’ 농도가 참여 전보다 56.5% 줄었고, 자녀 우울감은 20.9%p 감소했습니다.<br> 
                                                                            자녀, 부모가 함께 텃밭 활동을 하면 부모 양육 스트레스는 9.9%p 낮아지고, 자녀의 공감 수준은 4.1%p 높아졌습니다.<br><br></p>
                                                        <!-- <span class="text-warning">★ ★ ★ ★ ☆</span>
                                                        4.0 stars -->
                                                    </div>
                                                </div>
                                                <div class="card card-outline-secondary my-4">
                                                    <div class="card-header">STEP 1) 실내 텃밭 작물 선택하기</div>
                                                    <div class="card-body">
                                                        <p>🔘 실내 텃밭 조성하려면 씨앗으로 심거나 모종을 사서 옮겨 심는 방법이 있습니다.<br> 씨앗을 심을 경우, 모종을 이용하는 경우보다 한 달 정도 일찍 심어야 합니다.<br>
                                                           🔘 초보자는 재배가 쉬운 잎채소와 허브 등은 쉽게 도전할 수 있습니다.<br> 특히 케일, 다채, 부추, 쪽파는 계절에 상관없이 재배할 수 있으며, 허브 식물인 바질, 루꼴라, 민트도 키우기 쉽고 요리에 이용할 수 있어 좋습니다.<br><br>
                                                        </p>
                                                        <hr />
                                                    </div>

                                                    <div class="card-header">STEP 2) 실내 텃밭 조성하기</div>
                                                    <div class="card-body">
                                                        <p>🔘 장소: 우리집 앞마당은 어디서든지 전원 연결만 가능하다면 사용 가능합니다<br>
                                                           🔘 시기: 온도의 변화가 작아 작물 재배에 좋은 조건으로 실외보다 좀 더 이른 봄부터 늦가을까지 재배 가능합니다.<br>
                                                           🔘 환경: 일반적으로 채소가 잘 자라는 온도는 18~25℃로 우리집 앞마당이 반자동 제어를 통해 조절해주어 실내 텃밭 가꾸기에 용이합니다<br><br>
                                                        </p>
                                                        <hr /> 
                                                    </div>

                                                    <div class="card-header">STEP 3) 실내 텃밭 준비물</div>
                                                    <div class="card-body">
                                                        <p>🔘 </p>
                                                        <hr /> 
                                                    </div>

                                                    <div class="card-header">STEP 4) 실내 텃밭 조성 방법</div>
                                                    <div class="card-body">
                                                        <p>🔘 </p>
                                                        <hr /> 
                                                    </div>

                                                    <div class="card-header">STEP 5) 실내 텃밭 재배 관리</div>
                                                    <div class="card-body">
                                                        <p>🔘 </p>
                                                        <hr /> 
                                                    </div>

                                                </div>
                                                <a class="btn btn-success" href="javascript:history.back();">목록</a>
                                            </div><!--col-lg-9-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include 'footer.php'?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
    </body>

</html>
