<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    $userid = $_SESSION['userid'];

    include 'db/dbcon.php';
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

        <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    </head>
    <style>
        .btn{
            margin-left:93%;
            font-size:10px;
        }
        .list-group-item:link {text-decoration: none; color: #333333;}
        .list-group-item:visited {text-decoration: none; color: #333333;}
        .list-group-item:active {text-decoration: none; color: #333333;}
        .list-group-item:hover {text-decoration: none;}

        .a-tag:link {text-decoration: none; color: #000;}
        .a-tag:visited {text-decoration: none; color: #000;}
        .a-tag:active {text-decoration: none; color: #000;}
        .a-tag:hover {text-decoration: none; color: #000;}
    </style>

    <body>
        <!--header-->
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
                                    <div class="container2">
                                        <button class="btn btn-primary" onclick="location.href='editor.php?mode=browse_write'">작성하기</button>
                                    </div>
                                    <?php }?>


                                    <div class="container2">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h1 class="my-4">찾아보기 <i class="icon-leaf"></i></h1>
                                                <div class="list-group">
                                                    <?php 
                                                        $sql="select distinct plant1 from plant";
                                                        $result = mysqli_query($connect,$sql);
                                                        $total_record = mysqli_num_rows($result);

                                                        for($i=0; $i<$total_record; $i++){
                                                            $row = mysqli_fetch_array($result);

                                                            $plant1 = $row['plant1'];
                                                    ?>
                                                    <a class="list-group-item" href="browse.php?plant1=<?=$plant1?>"><?=$plant1?> 재배하기</a> 
                                                    <?php }?>
                                                    <a class="list-group-item" href="tip.php">재배하기 팁</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-9">
                                                <div class="carousel slide my-4" id="carouselExampleIndicators"
                                                    data-ride="carousel">
                                                    <ol class="carousel-indicators">
                                                        <li class="active" data-target="#carouselExampleIndicators"
                                                            data-slide-to="0"></li>
                                                        <li data-target="#carouselExampleIndicators" data-slide-to="1">
                                                        </li>
                                                        <li data-target="#carouselExampleIndicators" data-slide-to="2">
                                                        </li>
                                                    </ol>
                                                    <div class="carousel-inner" role="listbox">
                                                        <div class="carousel-item active"><img class="d-block img-fluid"
                                                                src="../img/banner1.png"
                                                                alt="First slide" /></div>
                                                        <div class="carousel-item"><img class="d-block img-fluid"
                                                                src="../img/banner2.png"
                                                                alt="Second slide" /></div>
                                                        <div class="carousel-item"><img class="d-block img-fluid"
                                                                src="../img/banner3.png"
                                                                alt="Third slide" /></div>
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExampleIndicators"
                                                        role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="sr-only">이전</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExampleIndicators"
                                                        role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon"
                                                            aria-hidden="true"></span>
                                                        <span class="sr-only">다음</span>
                                                    </a>
                                                </div>
                                                <div class="row">
                                                    <?php 
                                                        if($_GET['plant1'] != ""){
                                                            $plant1 = $_GET['plant1'];
                                                        }else{
                                                            $plant1 ="잎채소";
                                                        }
                                                        
                                                        $sql_2="select distinct plant2 from plant where plant1='$plant1'";
                                                        $result_2 = mysqli_query($connect,$sql_2);
                                                        $total_record_2 = mysqli_num_rows($result_2);
                                                        
                                                        for($i=0; $i<$total_record_2; $i++){
                                                            $row_2 = mysqli_fetch_array($result_2);

                                                            $plant2 = $row_2['plant2'];
                                                    ?>
                                                    <div class="col-lg-4 col-md-6 mb-4">
                                                        <div class="card h-100">
                                                            <a class="a-tag" href="browse1-1.php?plant1=<?=$plant1?>&&plant2=<?=$plant2?>"><img class="card-img-top"
                                                                    src="img/<?=$plant2?>.png"
                                                                    alt="..." />
                                                            <div class="card-body">
                                                                <h4 class="card-title"><?=$plant2?></h4>
                                                                <!-- <h5>$24.99</h5> -->
                                                                <p class="card-text">어쩌고</p>
                                                            </div>
                                                            </a>
                                                            <div class="card-footer"><small class="text-muted">🤔🤔🤔🤔🤔
                                                                    </small></div>
                                                        </div>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
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
