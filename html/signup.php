<?
session_start();

// 이 페이지 삭제해야함.
?>

<!DOCTYPE html>
<html lang="en">
  
 <head>
    <meta charset="utf-8">
    <title>회원가입 - 우리집 앞마당</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="css/style.css" rel="stylesheet" type="text/css">
<link href="css/pages/signin.css" rel="stylesheet" type="text/css">

<script>
function check_input(){
	if(!document.signup.username.value)
	{
		alert("이름을 입력하세요");
		document.signup.username.focus();
		return false;
	}
	if(!document.signup.userid.value)
	{
		alert("아이디를 입력하세요");
		document.signup.userid.focus();
		return false;
	}
	if(!document.signup.password.value)
	{
		alert("비밀번호를 입력하세요");
		document.signup.password.focus();
		return false;
	}
	if(!document.signup.confirm_password.value)
	{
		alert("비밀번호 확인을 입력하세요");
		document.signup.confirm_password.focus();
		return false;
	}
	if(!document.signup.email.value)
	{
		alert("이메일을 입력하세요");
		document.signup.email.focus();
		return false;
	}
	if(!document.signup.phone.value)
	{
		alert("휴대폰 번호를 입력하세요");
		document.signup.phone.focus();
		return false;
	}
	if(!document.signup.farm_id.value)
	{
		alert("라즈베리파이 아이디를 입력하세요");
		document.signup.farm_id.focus();
		return false;
	}
    if(!document.signup.Field.checked)
	{
		alert("이용약관에 동의해주세요.");
		document.signup.Field.focus();
		return false;
	}

    if(document.signup.password.value!=document.signup.confirm_password.value) //실행 안됨.
    {
        alter("비밀번호가 일치하지 않습니다.");
        document.signup.password.focus();
        document.signup.confirm_password.focus();
        return false;
    }
	document.signup.submit();


}
</script>
</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.php">
				우리집 앞마당 			
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">						
						<a href="login.html" class="">
							계정이 있으신가요? 로그인 하기
						</a>
						
					</li>
					<li class="">						
						<a href="index.php" class="">
							<i class="icon-chevron-left"></i>
							메인으로 돌아가기
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->


<!--다중 셀렉트 -->
<div class="account-container register">
	
	<div class="content clearfix">
		
		<form action="/db/insert.php" method="post" name="signup" onSubmit="return check_input()">
		
			<h1>회원가입</h1>			
			
			<div class="login-fields">
				
				<p>회원가입하세요!<br> 우리집 앞마당이 편리한 농작물 재배를 도와드립니다.</p>
				
				<div class="field">
					<label for="name">이름:</label>
					<input type="text" id="name" name="username" value="" placeholder="이름" class="login" />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="username">아이디:</label>	
					<input type="text" id="userid" name="userid" value="" placeholder="아이디" class="login" />
				</div> <!-- /field -->
				
                <div class="field">
					<label for="password">비밀번호:</label>
					<input type="password" id="password" name="password" value="" placeholder="비밀번호" class="login"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="confirm_password">비밀번호 확인:</label>
					<input type="password" id="confirm_password" name="confirm_password" value="" placeholder="비밀번호 확인" class="login"/>
				</div> <!-- /field -->
				
				<div class="field">
					<label for="email">이메일:</label>
					<input type="text" id="email" name="email" value="" placeholder="이메일" class="login"/>
				</div> <!-- /field -->
				
                <div class="field">
					<label for="phone">전화번호:</label>
					<input type="number" id="phone" name="phone" value="" placeholder="전화번호" class="login"/>
				</div> <!-- /field -->
                
                <div class ="field">
                    <label for ="id">라즈베리 아이디:</label>
                    <input type="text" id="id" name="farm_id" value="" placeholder="라즈베리파이 아이디" class="login"/>
                </div>

                <div class="field">
                    <p>키우시려는 작물을 선택하세요</p>
					<select name="select1" id="select1" onchange="itemChange()">
                        <option>---1차분류---</option>
                        <option>잎채소</option>
                        <option>열매채소</option>
                        <option>뿌리채소</option>
                        <option>식량작물</option>
                        <option>허브</option>
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
					<input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
					<label class="choice" for="Field">이용약관에 동의하십니까?</label>
				</span>
									
				<button class="button btn btn-primary btn-large">등록하기</button>
				
			</div> <!-- .actions -->
			
		</form>
		
	</div> <!-- /content -->
	
</div> <!-- /account-container -->


<!-- Text Under Box -->
<div class="login-extra">
	이미 회원이신가요? <a href="login.html">로그인하기</a>
</div> <!-- /login-extra -->


<script src="js/jquery-1.7.2.min.js">

</script>
<script src="js/bootstrap.js"></script>

<script src="js/signin.js"></script>

<script >
function itemChange(){
     //1차분류 선택 후
     var a = ["---2차분류---","백합과","국화과","꿀풀과","명아주과","배추과"];
     var b = ["---2차분류---","가지과","고추과","박과"];
     var c = ["---2차분류---","배추과","미나리과","백합과", "생강과"];
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
