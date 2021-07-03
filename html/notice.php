<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    $userid = $_SESSION['userid']; 

    include "db/dbcon.php";

    $sql="select * from notice";
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
    </head>
    <style>

        .btn-container{
            margin-left: 93%;
            margin-bottom: 20px;
        }

        .btn-container2{
            margin-left: 90%;
        }
        .btn {
            font-size: 10px;
        }

        .accordion-toggle{
            width:80%;
            
        }
        

    </style>

    <body>
        <?php include 'header.php'?>


        <!--추가할 내용-->
        <div class="main">

            <div class="main-inner">

                <div class="container">

                    <div class="row">

                        <div class="span12">

                            <div class="widget ">

                                <div class="widget-header">
                                    <i class="icon-bullhorn"></i>
                                    <h3>공지사항</h3>
                                </div> <!-- /widget-header -->

                                <div class="widget-content">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="formcontrols">
                                            <form id="edit-profile" class="form-horizontal"></form>
                                        </div>
                                        <div class="tab-pane active" id="jscontrols">
                                            <!-- 관리자일 경우에 작성버튼 생김 -->
                                            <?php if($userid == "admin"){?>
                                            <div class="btn-container">
                                                <button class="btn btn-primary"
                                                    onclick="location.href='notice_write.php?page=notice'">작성하기</button>
                                            </div>
                                            <?php }?>

                                            <!-- <form id="edit-profile2" class="form-vertical"> -->
                                                <fieldset>
                                                    <div class="control-group">
                                                        <div class="controls">
                                                            <div class="accordion" id="accordion2">
                                                                <?php
                                                                    for($i=0;$i<$total_record;$i++){ //공지사항의 데이터 정보 가져오기
                                                                        mysqli_data_seek($result,$i);
                                                                        $row=mysqli_fetch_array($result);
                                                                        $num=$row['num'];
                                                                        $title=$row['title'];
                                                                        $content=$row['content'];
                                                                        $notice_num = $i + 1;
                                                                ?>
                                                                <div class="accordion-group">
                                                                    <div class="accordion-heading">
                                                                        <a class="accordion-toggle"
                                                                            data-toggle="collapse"
                                                                            data-parent="#accordion2"
                                                                            href="#collapse<?=$i?>">
                                                                            <?php echo $notice_num.". ".$title; ?>
                                                                        </a>
                                                                        <!--버튼-->
                                                                        <?php if($userid == "admin"){?>
                                                                            <div class="btn-container2">
                                                                                <button class="btn btn-primary"
                                                                                onclick="location.href='notice_write.php?page=notice&&mode=update&&num=<?=$num?>'">수정</button>
                                                                                <button class="btn btn-primary"
                                                                                onclick="location.href='db/notice_insert.php?sql_mode=delete&&num=<?=$num?>'">삭제</button>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                    <div id="collapse<?=$i?>"
                                                                        class="accordion-body collapse"> <!--in 고치기-->
                                                                        <div class="accordion-inner"><?=$content?></div>
                                                                    </div>
                                                                </div><!--/accordion-group-->
                                                                <?php }?>
                                                            </div> <!-- /controls -->
                                                        </div> <!-- /control-group -->
                                                </fieldset>
                                            <!-- </form> -->
                                        </div>

                                    </div>

                                </div>

                            </div> <!-- /row -->

                        </div> <!-- /container -->

                    </div> <!-- /main-inner -->

                </div> <!-- /main -->


                <?php include 'footer.php'?>

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
                <!-- Core theme JS-->
                <script src="js/jquery-1.7.2.min.js"></script>

                <script src="js/bootstrap.js"></script>
                <script src="js/base.js"></script>
                <script src="js/scripts.js"></script>
    </body>

</html>
