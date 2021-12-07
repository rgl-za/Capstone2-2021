<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    $userid = $_SESSION['userid']; 

    include "db/dbcon.php";

    $sql="select * from faq";
    $result = mysqli_query($connect,$sql);
    $total_record = mysqli_num_rows($result);
    
?>
<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>우리집 앞마당</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes">    
    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.min.css" rel="stylesheet">
    
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    <link href="css/font-awesome.css" rel="stylesheet">
    
    <link href="css/style.css" rel="stylesheet">
    
    
    <link href="css/pages/faq.css" rel="stylesheet"> 

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <style>
  .btn-primary{
      font-size: 10px;
      width:70px;
  }
  .list{
      display:inline-block !important;
      /* background-color: #0f0; */
      width:100%; 
  }
  .btn-container{
      display:inline-block;
      margin-left:93%;
  }

  /* .faq-btn{
      font-size: 1px !important;
      width:70px;
  } */
  </style>

<body>

<?php include 'header.php'?>
    
    
<div class="main">
	
	<div class="main-inner">

	    <div class="container">
	
    	<div class="row">
    	<div class="span12">
						
				<div class="widget widget-plain">
					
					<div class="widget-content">
						
						<a href="javascript:;" class="btn btn-large btn-success btn-support-ask">자주 묻는 질문들</a>	
						
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->
				
				
				
			</div> <!-- /span12 -->
         </div>	
    
	      <div class="row">
	      	
	      	<div class="span12">
	      		
	      		<div class="widget">
						
					<div class="widget-header">
						<i class="icon-exclamation-sign"></i>
						<h3>자주 묻는 질문들</h3>
                        <?php if($userid == "admin"){?>
                        <div class="btn-container">
                            <button class="btn btn-primary" onclick="location.href='notice_write.php?page=faq'">작성하기</button>
                        </div>
                        <?php }?>
					</div> <!-- /widget-header -->
					
					<div class="widget-content">
						
						<h3>Search</h3>
						
						<br />
						
						<ol class="faq-list">

                            <?php
                                for($i=0;$i<$total_record;$i++){
                                    mysqli_data_seek($result,$i);
                                    $row=mysqli_fetch_array($result);
                                    $num=$row['num'];
                                    $title=$row['title'];
                                    $content=$row['content'];
                                    $notice_num = $i + 1;
                            ?>
							<li class="list">
									<h4><?=$title?></h4>
									<p><?=$content?></p>
                                    <?php if($userid == "admin"){?>	
                                        <div class="btn-container2">
                                            <button class="btn btn-primary faq-btn" onclick="location.href='notice_write.php?page=faq&&mode=update&&num=<?=$num?>'">수정</button>
                                            <button class="btn btn-primary faq-btn" onclick="location.href='db/faq.php?sql_mode=delete&&num=<?=$num?>'">삭제</button>
                                        </div>
                                    <?php }?>
									
							</li>
                            <?php }?>
							
						</ol>
						
					</div> <!-- /widget-content -->
						
				</div> <!-- /widget -->	
				
		    </div> <!-- /spa12 -->
		    
		    
		    
		    
	      	
	      	
	      	
	      </div> <!-- /row -->
	
	    </div> <!-- /container -->
    
	</div> <!-- /main-inner -->
	    
</div> <!-- /main -->
    


<?php include 'footer.php'?>
<!-- /footer -->
    

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>
<script src="js/faq.js"></script>

<script>

$(function () {
	
	$('.faq-list').goFaq ();

});

</script>
  </body>

</html>
