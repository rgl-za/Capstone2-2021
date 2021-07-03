<?php
//수정중
    session_start();
	header('Content-type:text/html; charset=utf-8');

    $userid = $_SESSION['userid']; 

    include "db/dbcon.php";

    $sql="select * from community order by num desc";
    $sql2="select * from notice";
    $result = mysqli_query($connect,$sql);
    $result2=mysqli_query($connect,$sql2);
    $total_record = mysqli_num_rows($result);
    $total_record2=mysqli_num_rows($result2);

    // $num=$row['num'];
    // $title=$row['subject'];
    // $id=$row['id'];

    // $img=$row['hash'];
    // $content=$row['memo'];
    // $date=$row['time'];

    $search=$_GET['search'];
    
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

<?php include 'header.php'?>    
<div class="main">
	<div class="main-inner">
	    <div class="container">
	        <div class="row">
	      	    <div class="span12">
	                <div class="info-box">
                        <div class="row-fluid stats-box">
                            <!--정보입력-->
                            <div class="container2">
                                <div class="row">
                                    <!-- Blog entries-->
                                    <div class="col-md-8">
                                        <h1 class="my-4">
                                            자유게시판
                                            <small><?=$keyworld?>에서 </small>
                                        </h1>
                                        <!-- Blog post-->
                                        <?php
                                                for($i=0; $i<$total_record; $i++){
                                                    mysqli_data_seek($result, $i);
                                                    $row = mysqli_fetch_array($result);
                                                    $num=$row['num'];
                                                    $title=$row['subject'];
                                                    $id=$row['id'];

                                                    $img=$row['hash'];
                                                    $content=$row['memo'];
                                                    $date=$row['time'];
                                            ?>
                                        <div class="card mb-4">
                                            
                                            <?php
                                                if($img!=''){?>
                                                    <img class="card-img-top" src="../files/<?=$img?>"/>
                                              <?}?>
                                                <div class="card-body">
                                                    <h2 class="card-title"><?=$title?></h2>
                                                    <!--p class="card-text"><//?=$strim?></p-->
                                                    <a class="btn btn-primary" href="reports1-1.php?num=<?=$num?>">읽어보기</a>
                                                </div>
                                                <div class="card-footer text-muted">
                                                    <?=$date?> by <a><?=$id?></a>
                                                </div>
                                              
                                        </div>
                                        <?}?>
                        
                        

                                        <!-- Blog post-->
                                        <!-- Pagination-->
                                        <!-- <ul class="pagination justify-content-center mb-4">
                                        <li class="page-item"><a class="page-link" href="reports.php?page=$prev">이전 </a></li> -->
                                            
                                        </ul>
                                    </div>
                                    <!--Side widgets -->
                                    <div class="col-md-4">
                                       
                                        <!-- Search widget-->
                                        <div class="card my-4">
                                            <h5 class="card-header">검색</h5>
                                            <form action="#" method="GET">
                                            <div class="card-body">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" placeholder="Search for..." />
                                                    <span class="input-group-append" required="require"><button class="btn btn-secondary" type="button">검색</button></span>
                                                </div>
                                            </div>
                                        </div>
                            
                                        <!-- Side widget-->
                                        
                                        <div class="card my-4">
                                            <h5 class="card-header">공지사항</h5>
                                            <?php
                                            for($i=0; $i<$total_record2;$i++){
                                                mysqli_data_seek($result2,$i);
                                                $row2=mysqli_fetch_array($result2);
                                                $notice_num=$i+1;
                                                $title2=$row2['title'];
                                            
                                        ?>
                                            <div class="card-body"><?=$notice_num."." .$title2?>
                                                </div><?}?>
                                        </div>
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
	    </div> <!-- /container -->  
	</div> <!-- /main-inner -->   
</div> <!-- /main -->
    
<?php include 'footer.php'?>

<!-- /footer -->
    

<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/excanvas.min.js"></script>
<script src="js/chart.min.js" type="text/javascript"></script>
<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
<script src="js/scripts.js"></script>


</body>

</html>