<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    include "db/dbcon.php";

    $plant1 = $_GET['plant1'];
    $plant2 = $_GET['plant2'];

    $sql="select * from information, (select plant3 from plant where plant1='$plant1' and plant2='$plant2') subquery1 ";
    $sql.="where information.plant3 = subquery1.plant3";
    $result = mysqli_query($connect,$sql);
    $total_record = mysqli_num_rows($result);

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
        
        /* a:link {text-decoration: none; color: #333333;}
        a:visited {text-decoration: none; color: #333333;}
        a:active {text-decoration: none; color: #333333;}
        a:hover {text-decoration: underline wavy;} */

        .card-img-top{
            width: 100%;
            height: 45%;
            object-fit: cover;
        }
        .text-center{
            padding:10px;
            padding-left:20px;
            padding-right:20px;
        }
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
                                    <!-- Page Content-->
                                    <div class="container">
                                        <!-- Jumbotron Header-->
                                        <header class="jumbotron my-4">
                                            <h1 class="display-3"><b><?=$plant1?> 재배하기</b></h1>
                                            <!--a class="btn btn-primary btn-lg" href="#!">Call to action!</a-->
                                            <br />
                                            <br />
                                        </header>
                                        <!-- Page Features-->
                                        <div class="row text-center">
                                            <?php
                                                for($i=0;$i<$total_record;$i++){ //공지사항의 데이터 정보 가져오기
                                                    // mysqli_data_seek($result,$i);
                                                    $row=mysqli_fetch_array($result);
                                                    $plant3=$row['plant3'];
                                                    $title=$row['title'];
                                                    $content=$row['content'];
                                                    $image=$row['image'];
                                            ?>
                                            <div class="col-lg-3 col-md-6 mb-4">
                                                <div class="card h-100">
                                                    <img class="card-img-top" src="../files/<?=$image?>"
                                                        alt="..." />
                                                    <div class="card-body">
                                                        <h4 class="card-title"><?=$title?></h4>
                                                    </div>
                                                    <div class="card-footer"><a class="btn btn-primary"
                                                            href="browse1.php?plant1=<?=$plant1?>&&plant2=<?=$plant2?>&&plant3=<?=$plant3?>">읽어보기</a></div>
                                                </div>
                                            </div>
                                            <?php }?>
                                        </div><!--/row text-center-->
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
