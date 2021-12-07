<!DOCTYPE html>
<html lang="en">
  
<head>
    <meta charset="utf-8">
    <title>우리집 앞마당 모니터링</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

<script>
function check_input(){ //폼 유효성 검사
    if(!document.qna.farm_id.value)
	{
		alert("라즈베리파이 아이디를 입력하세요.");
		document.qna.farm_id.focus();
		return false;
	}
	if(!document.qna.email.value)
	{
		alert("이메일을 입력하세요.");
		document.qna.email.focus();
		return false;
	}
	if(!document.qna.phone.value)
	{
		alert("휴대폰번호을 입력하세요.");
		document.qna.phone.focus();
		return false;
	}
    if(!document.qna.question.value)
    {
        alert("질문을 입력하세요.");
        document.qna.question.focus();
        return false;
    }
    if(!document.qna.Field.checked)
	{
		alert("이용약관에 동의해주세요.");
		document.qna.Field.focus();
		return false;
	}
	document.qna.submit();
}
</script>

</head>

<body>
<?php include 'header.php'?>
    
<!--다중 셀렉트 -->
<div class="account-container register">
	
	<div class="content clearfix">
		
		<form action="/db/qna_insert.php" method="post" name="qna" onsubmit="return check_input()">
		
			<h1>1:1 문의센터</h1>			
			
			<div class="login-fields">
				
				<p>질문을 보내주세요!<br> 이메일이나 전화번호로 질문 답변해드립니다.</p>
                <div class ="field">
                    <label for ="id">라즈베리 아이디:</label>
                    <input type="text" id="id" name="farm_id" value="" placeholder="라즈베리파이 아이디" class="login"/>
                </div>
                
				<div class="field">
					<label for="email">이메일:</label>
					<input type="text" id="email" name="email" value="" placeholder="이메일" class="login"/>
				</div> <!-- /field -->
				
                <div class="field">
					<label for="phone">전화번호:</label>
					<input type="number" id="phone" name="phone" value="" placeholder="전화번호" class="login"/>
				</div> <!-- /field -->
                
                <div class="filed">
                    <textarea class="form-control" style="width:95%;" rows="10" name="question" placeholder="질문" class="qna"></textarea> 
                </div>                                
                <br>
                <div class="field">
                    <p>키우고 계신 작물을 선택하세요</p>
					<select name="select1" id="select1" onchange="itemChange()">
                        <option>---1차분류---</option>
                        <option>잎채소 재배</option>
                        <option>열매채소 재배</option>
                        <option>뿌리채소 재배</option>
                        <option>식량작물 재배</option>
                        <option>허브 재배</option>
                        </select>
                         
                        <select name="select2" id="select2" onchange="itemChange2()">
                            <option>---2차분류---</option>
                        </select>

                        <select name="select3" id="select3">
                            <option>---3차분류---</option>
                        </select>

                        
				</div> <!-- /field -->

			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				
				<span class="login-checkbox">
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" tabindex="4" />
					<label class="choice" for="Field">이용약관에 동의하십니까?</label>
				</span>
									
				<button class="button btn btn-primary btn-large">질문하기</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->





<script src="js/jquery-1.7.2.min.js"></script>
<script src="js/bootstrap.js"></script>
<script src="js/signin.js"></script>

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
       
     if(selectItem == "잎채소 재배"){
       changeItem = a;
     }
     else if(selectItem == "열매채소 재배"){
       changeItem = b;
     }
     else if(selectItem == "뿌리채소 재배"){
       changeItem =  c;
     }
     else if(selectItem == "식량작물 재배"){
         changeItem = d;
     }
     else if(selectItem == "허브 재배"){
         changeItem = e;
     }

     
    $('#select2').empty();

    for(var count = 0; count < changeItem.length; count++){ 
        var option = $("<option>"+changeItem[count]+"</option>");
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
       if(selectItem == "잎채소 재배"){
           changeItem = a1;
       }
       else if(selectItem == "뿌리채소 재배"){ //여기만 안됨
           changeItem = c3;
       }
       else if(selectItem == "허브 재배"){
           changeItem = e2;
       }
    }

    else if(selectItem2 == "국화과"){
        if(selectItem == "잎채소 재배"){
            changeItem = a2;
        }
        else if(selectItem == "허브 재배"){
            changeItem = e3;
        }
    }

    else if(selectItem2 == "꿀풀과"){
        if(selectItem == "잎채소 재배"){
            changeItem = a3;
        }
        else if(selectItem == "허브 재배"){
            changeItem = e1;
        }
    }

    else if(selectItem2 == "명아주과"){
        changeItem = a4;
    }

    else if(selectItem2 == "배추과"){ 
        if(selectItem == "잎채소 재배"){
            changeItem = a5;
        }
        else if(selectItem == "뿌리채소 재배"){
            changeItem = c1;
        }
    }

    else if(selectItem2 == "가지과"){
        if(selectItem == "열매채소 재배"){
            changeItem = b1;
        }
        else if(selectItem == "식량작물 재배"){
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

    
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/jquery-1.7.2.min.js"></script>
	
    <script src="js/bootstrap.js"></script>
    <script src="js/base.js"></script>
    <script src="js/scripts.js"></script>
</body>

 </html>
