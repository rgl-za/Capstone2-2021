<?php
session_start();

$user_id = $_SESSION['userid'];
include "db/dbcon.php";

$sql="select * from user where id='$user_id'";
$result = mysqli_query($connect,$sql);
$row=mysqli_fetch_array($result);

$username=$row['username'];
$id=$row['id'];
$email=$row['email'];
$phone=$row['phone'];
$farm_id=$row['farm_id'];
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



    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <script>
    function checked(){ //실행 안됨.
        window.alter("비밀번호");
        // if(document.account.password.value != document.account.confirm_password.value)
        // {
        //     window.alter("비밀번호가 일치하지 않습니다.");
        //     document.account.password.focus();
        //     document.account.password.select();
        //     return;
        // }else{
        //     window.alter("비밀번호가 일치");
        //     //document.account.submit();
        // }
    }
    </script>

</head>

<body>

    <?php include 'header.php'?>



    <div class="main">

        <div class="main-inner">

            <div class="container">

                <div class="row">

                    <div class="span12">

                        <div class="widget ">

                            <div class="widget-header">
                                <i class="icon-user"></i>
                                <h3><?=$username?>님의 계정</h3>
                            </div> <!-- /widget-header -->

                            <div class="widget-content">
                                <!--박스 안 정보수정 폼-->
                                <div class="tab-pane" id="formcontrols">
                                    <form id="edit-profile" class="form-horizontal" method="post" name="account" action="/db/account_update.php" onsubmit="return checked()">
                                        <fieldset>

                                            <div class="control-group">
                                                <label class="control-label" for="username">이름</label>
                                                <div class="controls">
                                                    <input type="text" class="span6" id="username" name="username" value="<?=$username?>">
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->

                                            <div class="control-group">
                                                <label class="control-label" for="userid">아이디</label>
                                                <div class="controls">
                                                    <input type="text" class="span6 disabled" id="userid" name="userid"
                                                        value="<?=$id?>" disabled>
                                                    <p class="help-block" style="color:red; font-size: 4px">*아이디는 수정하실 수 없습니다.</p>
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->

                                            <div class="control-group">
                                                <label class="control-label" for="password">비밀번호</label>
                                                <div class="controls">
                                                    <input type="password" class="span4" id="password" name="password"
                                                        value="">
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->

                                            <div class="control-group">
                                                <label class="control-label" for="confirm_password">비밀번호 확인</label>
                                                <div class="controls">
                                                    <input type="password" class="span4" id="confirm_password" name="confirm_password"
                                                        value="">
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->

                                            <div class="control-group">
                                                <label class="control-label" for="email">이메일</label>
                                                <div class="controls">
                                                    <input type="text" class="span4" id="email" name="email"
                                                        value="<?=$email?>">
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->


                                            <div class="control-group">
                                                <label class="control-label" for="phone">전화번호</label>
                                                <div class="controls">
                                                    <input type="text" class="span6" id="phone" name="phone" value="<?=$phone?>">
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->


                                            <div class="control-group">
                                                <label class="control-label" for="phone">스마트팜 id</label>
                                                <div class="controls">
                                                    <input type="text" class="span6" id="farm_id" name="farm_id" value="<?=$farm_id?>">
                                                </div> <!-- /controls -->
                                            </div> <!-- /control-group -->


                                            <div class="form-actions">
                                                <button type="submit" class="btn btn-primary">저장</button>
                                                <button class="btn">취소</button>
                                            </div> <!-- /form-actions -->
                                        </fieldset>
                                    </form>
                                </div>
                                <!--/박스 안 정보수정 폼-->




                            </div> <!-- /widget-content -->

                        </div> <!-- /widget -->

                    </div> <!-- /span8 -->




                </div> <!-- /row -->

            </div> <!-- /container -->

        </div> <!-- /main-inner -->

    </div> <!-- /main -->




  <?php include 'footer.php'?>



<script src="js/jquery-1.7.2.min.js"></script>

<script src="js/bootstrap.js"></script>
<script src="js/base.js"></script>

</body>

</html>