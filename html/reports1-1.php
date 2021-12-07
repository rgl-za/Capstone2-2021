<?php
    session_start();
    header('Content-type:text/html; charset=utf-8');
    include "db/dbcon.php";

    $num = $_GET['num'];
    $userid = $_SESSION['userid']; 
    
    $sql1="select * from community where num='$num'";
    $sql2="select * from comment where num='$num'";

    $result1 = mysqli_query($connect,$sql1);
    $result2 = mysqli_query($connect,$sql2);
    
    $total_record = mysqli_num_rows($result2);
    
    $row1 = mysqli_fetch_array($result1);

    $num1=$row1['num'];
    $title=$row1['subject'];
    $id1=$row1['id'];
    $img=$row1['hash'];
    $content=$row1['memo'];
    $date1=$row1['time'];

    // $num2=$row2['num'];
    // $id2=$row2['id'];
    // $comment=$row2['comment'];
    // $date2=$row2['date'];
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
                            <div class="container2">
                                <div class="row">
                                    
                                    <!-- Post content-->
                                    <div class="col-lg-8">
                                        <!-- Title-->
                                        <h1 class="mt-4"><?=$title?></h1>
                                        <!-- Author-->
                                        <p class="lead"> by <?=$id1?></p>
                                        <hr />
                                        
                                        <?php
                                            if($id1 == $userid){?>
                                               <button class="btn btn-info" onclick="location.href='editor.php?num=<?=$num?>&&sql_mode=modify'">수정</button>
                                               <button class="btn btn-success" onclick="location.href='db/view.php?num=<?=$num?>&&sql_mode=drop'">삭제</button>
                                            <?}?>
                                            
                                        <!-- Date and time-->
                                        <p><?=$date1?></p>
                                        <hr />

                                        <!-- Preview image-->
                                        <?php
                                            if($img!=''){?>
                                                <img class="img-fluid rounded" src="../files/<?=$img?>" alt="..." />
                                          <?}?>
                                        <hr />
                                       
                                        <!-- Post content-->
                                        <p class="lead"><?=$content?></p>

                                        <hr />


                                        <!-- Comments form-->
                                        <form action="db/comment_insert.php?num=<?=$num?>" method="post" name="comment">
                                        <div class="card my-4">
                                            <h5 class="card-header">댓글쓰기:</h5>
                                            <div class="card-body">
                                                <div class="form-group"><textarea class="form-control" rows="3" name="comment"></textarea></div>
                                                <button class="btn btn-primary" type="submit">저장</button>
                                
                                            </div>
                                        </form>        
                                        </div>
                                        
                                        <!-- Single comment--> 
                                        <?php
                                            for($i=0; $i<$total_record; $i++){
                                                mysqli_data_seek($result2, $i);
                                                $row2 = mysqli_fetch_array($result2);
                                                $num2=$row2['num'];
                                                $count = $row2['count'];
                                                $id2=$row2['id'];
                                                $comment=$row2['comment'];
                                                $date2=$row2['date'];?>
                                        <div class="media mb-4">
                                            <img class="d-flex mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="..." />
                                            <div class="media-body">
                                                <?if($num1==$num2){?>
                                                    <h5 class="mt-0"><?=$id2?> <p><?=$date2?></p></h5>
                                                    <?=$comment?>
                                            </div>
                                                <?php if($id2 == $userid){?>
                                                        <form action="db/view.php?num=<?=$count?>&&sql_mode=delete" method="post" name="comment">
                                                            <button class="btn btn-success">삭제</button>
                                                        </form>
                                                    <?}
                        
                                                }?>       
                                        </div>
                                    <?}?>
                                
                                </div>


                                <!-- Sidebar widgets column-->
                                <div class="col-md-4">
                                    <!-- Categories widget-->
                                    <!-- Side widget-->
                                    <div class="card my-4">
                                        <h5 class="card-header">커뮤니티 유의사항</h5>
                                        <div class="card-body">다른 이용자들에게 불쾌감을 주는 언행은 삼가합시다.</div>
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

