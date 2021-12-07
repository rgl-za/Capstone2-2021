<?php
session_start();
header('Content-type:text/html; charset=utf-8');
$user_id = $_SESSION['userid'];
include "db/dbcon.php";

$mode = $_GET['mode'];
$mode2 = $_GET['mode2'];

$sql_mode=$_GET['sql_mode'];

if($mode2 == 'update'){
    $plant3 = $_GET['plant3'];

    $sql="select * from information where plant3='$plant3'";
    $result = mysqli_query($connect,$sql);
    $row=mysqli_fetch_array($result);

    $num=$row['num'];
    $plant1=$row['plant1'];
    $plant2=$row['plant2'];
    $plant3=$row['plant3'];
    $title=$row['title'];
    $image=$row['image'];
    $content=$row['content'];
    $date=$row['date'];

    // echo $content;
    // exit;
}
if($sql_mode == 'modify'){

    $num = $_GET['num'];
    $userid = $_SESSION['userid']; 
    
    $sql1="select * from community where num='$num'";
    // $sql2="select * from comment where num='$num'";

    $result1 = mysqli_query($connect,$sql1);
    // $result2 = mysqli_query($connect,$sql2);
    
    // $total_record = mysqli_num_rows($result2);
    
    $row1 = mysqli_fetch_array($result1);

    // $num1=$row1['num'];
    $title=$row1['subject'];
    // $id1=$row1['id'];
    $image=$row1['hash'];
    $content=$row1['memo'];
    // $date1=$row1['date'];

}

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

        iframe {
            border: 0;
            width: 100%;
            margin-bottom: 5pt;
            height: 250pt;
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

        .field{
            margin-top:10px;
            margin-left:50px;
        }

        select {
            height: 30pt;
            -webkit-appearance: none;
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

        #editor {
            border: 0;
            width: 100%;
            margin-bottom: 5pt;
            height: 250pt;
            resize: none;
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
                    <h1>글쓰기 <i class="icon-pencil"></i></h1>
                    <?php 
                        if($mode == "browse_write"){
                            if($mode2 == "update"){
                    ?>
                    <form action="/db/browse_insert.php?sql_mode=update&&num=<?=$num?>" method="post" name="community" onsubmit="return check_input()" enctype="multipart/form-data">
                    <?php } else { ?>
                    <form action="/db/browse_insert.php?sql_mode=insert" method="post" name="community" onsubmit="return check_input()" enctype="multipart/form-data">
                    <?php } ?>
                        <div class="field">
                            <select name="plant1" id="select1" onchange="itemChange()" onclick="itemChange()">
                                <option value="">---1차분류---</option>
                                <?php 
                                    $sql_2="select distinct plant1 from plant";
                                    $result_2 = mysqli_query($connect,$sql_2);
                                    $total_record_2 = mysqli_num_rows($result_2);

                                    for($i=0; $i<$total_record_2; $i++){
                                        $row_2 = mysqli_fetch_array($result_2);

                                        $plant1_2 = $row_2['plant1'];
                                ?>
                                <option value="<?=$plant1_2?>" <?php if(strpos($plant1,$plant1_2) !== false){echo "selected = \"selected\"";}?>><?=$plant1_2?></option>
                                <?php }?>
                            </select>

                            <select name="plant2" id="select2" onchange="itemChange2()"> <!--수정시 불러오기 어려움-->
                                <?php// if($mode2 == "update"){?>
                                <!-- <option value="<?//=$plant2?>" selected = "selected"><?=$plant2?></option> -->
                                <?php //} else {?>
                                <option value="">---2차분류---</option>
                                <?php //}?>
                            </select>

                            <select name="plant3" id="select3" value="<?=$plant3?>">
                                <option value="">---3차분류---</option>
                            </select>
                        </div> <!-- /field -->
                        <?php } 
                            if($sql_mode=="modify"){?>
                                <form action="/db/view.php?num=<?=$num?>&&sql_mode=modify" method="post" name="community" enctype="multipart/form-data">
                            <?}
                            else{?>
                                <form action="/db/community.php" method="post" name="community" enctype="multipart/form-data">
                            <?}?>
                        <input type="text" placeholder="Title" name="title" value="<?=$title?>">
                        <!--제목-->
                        <?php if($sql_mode == "modify" || $mode2 == "update"){?>
                            <input type="file" name="file" id="imageFileOpenInput" accept="image/*">&nbsp&nbsp<?=$image?>
                            <input type="checkbox" name="del_file" value="y">삭제
                        <?php } else { ?>
                            <input type="file" name="file" id="imageFileOpenInput" accept="image/*">
                        <?php }?>
                        <!--파일-->
                        <textarea name="editor" id="editor" cols="50" rows="10"><?=$content?></textarea>
                        <!--텍스트-->
                        <div class="editor-actions">
                            <button class="btn btn-primary">저장</button>
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
                function check_input(){ //폼 유효성 검사
                    if(!document.community.select1.value)
                    {
                        alert("1차 분류를 선택해주세요.");
                        document.community.select1.focus();
                        return false;
                    }
                    if(!document.community.select2.value || document.community.select2.value == "---2차분류---")
                    {
                        alert("2차 분류를 선택해주세요.");
                        document.community.select2.focus();
                        return false;
                    }
                    if(!document.community.select3.value || document.community.select3.value == "---3차분류---")
                    {
                        alert("3차 분류를 선택해주세요.");
                        document.community.select3.focus();
                        return false;
                    }
                    if(!document.community.title.value)
                    {
                        alert("제목을 입력해주세요.");
                        document.community.title.focus();
                        return false;
                    }
                    if(!document.community.file.value && document.community.del_file.checked)
                    {
                        alert("이미지를 선택해주세요.");
                        document.community.file.focus();
                        return false;
                    }
                    if(!document.community.editor.value)
                    {
                        alert("내용을 입력해주세요.");
                        document.community.editor.focus();
                        return false;
                    }
                    document.community.submit();
                }
            </script>
            <script >
                function itemChange(){
                    //1차분류 선택 후
                    var a = ["---2차분류---","백합과","국화과","꿀풀과","명아주과","배추과"];
                    var b = ["---2차분류---","가지과","고추과","박과"];
                    var c = ["---2차분류---","배추과","미나리과","백합과", "생강과"];
                    var d = ["---2차분류---","가지과","메꽃과","콩과","화본과"]
                    var e = ["---2차분류---","꿀풀과","백합과","국화과"]
                    
                    var selectItem = $("#select1").val();

                    var changeItem;
                    
                    if(selectItem == "잎채소"){
                    changeItem = a;
                    }
                    else if(selectItem == "열매채소"){
                    changeItem = b;
                    }
                    else if(selectItem == "뿌리채소"){
                    changeItem =  c;
                    }
                    else if(selectItem == "식량작물"){
                        changeItem = d;
                    }
                    else if(selectItem == "허브"){
                        changeItem = e;
                    }

                    
                    $('#select2').empty();

                    for(var count = 0; count < changeItem.length; count++){ 
                        var option = $("<option value="+ changeItem[count] + ">"+changeItem[count]+"</option>");
                        $('#select2').append(option);
                    }
                    
                }

                function itemChange2(){
                    //2차분류 선택 후
                    var a1 = ["---3차분류---","부추"];
                    var a2 = ["---3차분류---","상추","쑥갓","엔다이브"];
                    var a3 = ["---3차분류---","잎들깨"];
                    var a4 = ["---3차분류---","근대","적근대"];
                    var a5 = ["---3차분류---","청경채","다채"];

                    var b1 = ["---3차분류---","가지","수세미오이","오이","토마토"];
                    var b2 = ["---3차분류---","고추"];
                    var b3 = ["---3차분류---","호박"];

                    var c1 = ["---3차분류---","적환무"];
                    var c2 = ["---3차분류---","당근"];
                    var c3 = ["---3차분류---","마늘"];
                    var c4 = ["---3차분류---","생강"];

                    var d1 = ["---3차분류---","감자"];
                    var d2 = ["---3차분류---","고구마"];
                    var d3 = ["---3차분류---","땅콩","콩(대두)","두류(강낭콩, 연두콩)"];
                    var d4 = ["---3차분류---","옥수수","보리","벼"];
                    
                    var e1 = ["---3차분류---","타임","라벤더","레몬밤","로즈마리","민트","오레가노"];
                    var e2 = ["---3차분류---","차이브"];
                    var e3 = ["---3차분류---","캐모마일"];

                    var selectItem = $("#select1").val(); 
                    var selectItem2 = $("#select2").val(); 

                    var changeItem;
                    
                    if(selectItem2 == "백합과"){
                    if(selectItem == "잎채소"){
                        changeItem = a1;
                    }
                    else if(selectItem == "뿌리채소"){ //여기만 안됨
                        changeItem = c3;
                    }
                    else if(selectItem == "허브"){
                        changeItem = e2;
                    }
                    }

                    else if(selectItem2 == "국화과"){
                        if(selectItem == "잎채소"){
                            changeItem = a2;
                        }
                        else if(selectItem == "허브"){
                            changeItem = e3;
                        }
                    }

                    else if(selectItem2 == "꿀풀과"){
                        if(selectItem == "잎채소"){
                            changeItem = a3;
                        }
                        else if(selectItem == "허브"){
                            changeItem = e1;
                        }
                    }

                    else if(selectItem2 == "명아주과"){
                        changeItem = a4;
                    }

                    else if(selectItem2 == "배추과"){ 
                        if(selectItem == "잎채소"){
                            changeItem = a5;
                        }
                        else if(selectItem == "뿌리채소"){
                            changeItem = c1;
                        }
                    }

                    else if(selectItem2 == "가지과"){
                        if(selectItem == "열매채소"){
                            changeItem = b1;
                        }
                        else if(selectItem == "식량작물"){
                            changeItem = d1;
                        }
                    }

                    else if(selectItem2 == "고추과"){
                        changeItem = b2;
                    }
                    else if(selectItem2 == "박과"){
                        changeItem = b3;
                    }
                    else if(selectItem2 == "미나리과"){
                        changeItem = c2;
                    }
                    else if(selectItem2 == "생강과"){
                        changeItem = c4;
                    }
                    else if(selectItem2 == "메꽃과"){
                        changeItem = d2;
                    }
                    else if(selectItem2 == "콩과"){
                        changeItem = d3;
                    }
                    else if(selectItem2 == "화본과"){
                        changeItem = d4;
                    }
                    
                    $('#select3').empty();

                    for(var count = 0; count < changeItem.length; count++){ 
                        var option = $("<option>"+changeItem[count]+"</option>");
                        $('#select3').append(option);
                    }
                }
            </script>
    </body>

</html>
