<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    include "db/dbcon.php";

    $page = $_GET['page'];
    $mode = $_GET['mode'];

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

    </head>
    <style>
        .body {
            height: 100%;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Helvetica', 'Arial', sans-serif;
            color: #333;
        }

        .wrapper {
            background-color: #fff;
            width: 600pt;
            padding-left: 10pt;
            padding-right: 10pt;
            padding-top: 20pt;
            border-radius: 10px;
            box-shadow: 0px 0px 40px rgba(0, 0, 0, 0.1);
        }

        h1 {
            margin: 0;
            padding-bottom: 5pt;
            border-bottom: 1px solid #ddd;
        }

        input[type="text"] {
            height: 20pt;
            width: 100%;
            padding: 0;
            border: 0;
            box-shadow: none !important;
            border-bottom: 1px solid #ddd;
            outline: none;
            font-size: 14px;
            margin-top: 5pt;
        }

        input[type="file"] {
            height: 20pt;
            width: 100%;
            padding: 0;
            border: 0;
            outline: none;
            font-size: 14px;
            margin-top: 5pt;
        }

        .options {
            width: 100%;
            height: 30pt;
            margin-top: 5pt;
            border-top: 1px solid #ddd;
        }

        #editor {
            border: 0;
            width: 100%;
            margin-bottom: 5pt;
            height: 250pt;
            resize: none;
        }

        .seperator {
            display: inline;
            border-left: 1px solid #ddd;
            height: 30pt;
        }

        button {
            margin: 0;
            padding: 0;
            height: 30pt;
            width: 30pt;
            background-color: #fff;
            border: 0;
            cursor: pointer;
            color: #333;
        }

        button:active {
            color: #333;
        }

        select {
            height: 30pt;
            -webkit-appearance: none;
            border: 0;
            padding-left: 5pt;
            padding-right: 5pt;
            outline: none;
        }

        input[type="number"] {
            width: 60px;
            height: 30pt;
            border: 0;
            padding: 0;
            padding-left: 5pt;
            padding-right: 5pt;
            outline: none;
        }

        .btn {
            width: 60px;
            height: 20pt;
        }

        .editor-actions {
            padding: 17px 20px 18px;
            padding-left: 80%;
            margin-top: 18px;
            margin-bottom: 18px;
            border-top: 1px solid #ddd;
            *zoom: 1;
        }

        .editor-actions:before,
        .editor-actions:after {
            display: table;
            content: "";
        }

        .editor-actions:after {
            clear: both;
        }

    </style>

    <body>
        <!--header-->
        <?php include 'header.php'?>

        <!-- Navigation-->

        <div class="body">
            <div class="wrapper">
                <?php if($page == "notice"){?>
                <h1>공지사항 <i class="icon-warning-sign"></i></h1>
                <?php 
                    
                    if($mode == 'update'){
                        $num = $_GET['num'];
                        $sql="select * from notice where num = $num";
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result);

                        $title = $row['title'];
                        $content = $row['content'];
                ?>
                <form action="/db/notice_insert.php?sql_mode=update&&num=<?=$num?>" method="post" name="notice" enctype="multipart/form-data">
                <?php } else {?>
                <form action="/db/notice_insert.php?sql_mode=insert" method="post" name="notice" enctype="multipart/form-data">
                <?php } }?>
                <!--/공지사항-->
                <?php if($page == "faq") {?>
                <h1>자주 묻는 질문 <i class="icon-warning-sign"></i></h1>
                <?php 
                    // $mode = $_GET['mode'];
                    if($mode == 'update'){
                        $num = $_GET['num'];
                        $sql="select * from faq where num = $num";
                        $result = mysqli_query($connect,$sql);
                        $row = mysqli_fetch_array($result);

                        $title = $row['title'];
                        $content = $row['content'];
                ?>
                <form action="/db/faq.php?sql_mode=update&&num=<?=$num?>" method="post" name="notice" enctype="multipart/form-data">
                <?php } else {?>
                <form action="/db/faq.php?sql_mode=insert" method="post" name="notice" enctype="multipart/form-data">
                <?php } }?>
                    <input type="text" placeholder="Title" name="title" value="<?=$title?>">
                    <textarea name="editor" id="editor" cols="50" rows="10"><?=$content?></textarea>

                    <div class="editor-actions">
                        <button type="submit" class="btn btn-primary">저장</button>
                        <button type="button" class="btn">취소</button>
                    </div> <!-- /editor-actions -->
                </form>
            </div>
        </div>


        <?php include 'footer.php'?>
        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>

        <script defer src="https://use.fontawesome.com/releases/v5.5.0/js/all.js"
            integrity="sha384-GqVMZRt5Gn7tB9D9q7ONtcp4gtHIUEW/yG7h98J7IpE3kpi+srfFyyB/04OV6pG0"
            crossorigin="anonymous"></script>

        <script>
            editor.document.designMode = "On";

            function transform(option, argument) {
                editor.document.execCommand(option, false, argument);
            }
        </script>
    </body>

</html>
