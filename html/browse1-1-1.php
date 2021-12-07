<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    $userid = $_SESSION['userid'];

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
        .btn{
            margin-left:93%;
            font-size:10px;
        }
        a:link {text-decoration: none; color: #333333;}
        a:visited {text-decoration: none; color: #333333;}
        a:active {text-decoration: none; color: #333333;}
        a:hover {text-decoration: underline wavy;}
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

        <!-- Page Content-->
        <div class="container2">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <h1 class="my-4">찾아보기 <i class="icon-leaf"></i></h1>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">잎채소 재배하기</a> 
                                                    <a class="list-group-item" href="#">열매채소 재배하기</a>
                                                    <a class="list-group-item" href="#">뿌리채소 재배하기</a>
                                                    <a class="list-group-item" href="#">식량작물 재배하기</a>
                                                    <a class="list-group-item" href="#">허브 재배하기</a>
                                                    <a class="list-group-item" href="#">재배하기 팁</a>
                                                </div>
                                            </div>   
                                            <div class="col-lg-9">
                    <div class="card mt-4">
                        <img class="card-img-top img-fluid" src="https://via.placeholder.com/900x400" alt="..." />
                        <div class="card-body">
                            <h3 class="card-title">Product Name</h3>
                            <h4>$24.99</h4>
                            <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente dicta fugit fugiat hic aliquam itaque facere, soluta. Totam id dolores, sint aperiam sequi pariatur praesentium animi perspiciatis molestias iure, ducimus!</p>
                            <span class="text-warning">★ ★ ★ ★ ☆</span>
                            4.0 stars
                        </div>
                    </div>
                    <div class="card card-outline-secondary my-4">
                        <div class="card-header">Product Reviews</div>
                        <div class="card-body">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                            <small class="text-muted">Posted by Anonymous on 3/1/21</small>
                            <hr />
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                            <small class="text-muted">Posted by Anonymous on 3/1/21</small>
                            <hr />
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                            <small class="text-muted">Posted by Anonymous on 3/1/21</small>
                            <hr />
                            <a class="btn btn-success" href="#!">Leave a Review</a>
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
