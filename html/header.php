<?php
    session_start();
	header('Content-type:text/html; charset=utf-8');

    $userid = $_SESSION['userid'];

?>
<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="brand" href="index.php">우리집 앞마당 모니터링</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-cog"></i> 계정 <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="account.php"> 개인정보 수정</a></li>
              <!--li><a href="plant_log.php">나의 작물 이력</a></li-->
            </ul>
          </li>
          <?php
            if(!$userid){
          ?>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> 회원가입 / 로그인<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="login.html">로그인</a></li>
              <li><a href="signup.html">회원가입</a></li>
            </ul>
          </li>
          <?php
            }
            else{
          ?>
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i
                            class="icon-user"></i> <?=$userid?>님 반갑습니다!<b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="/db/logout.php">로그아웃</a></li>
            </ul>
          </li>
          <?php
            }
          ?>
        </ul>
        <!--검색-->
        <!--form class="navbar-search pull-right">
          <input type="text" class="search-query" placeholder="Search">
        </form-->
      </div>
      <!--/.nav-collapse --> 
    </div>
    <!-- /container --> 
  </div>
  <!-- /navbar-inner --> 
</div>
<!-- /navbar -->
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <?php if(strpos($_SERVER['REQUEST_URI'],"/index.php") !== false){?>
            <li class="active"><a href="index.php"><i class="icon-dashboard"></i><span>모니터링</span> </a> </li>
        <?php } else{ ?>
          <li><a href="index.php"><i class="icon-dashboard"></i><span>모니터링</span> </a> </li>
        <?php } ?>

        <?php if(strpos($_SERVER['REQUEST_URI'],"/reports.php") !== false){?>
          <li class="active dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-group"></i><span>커뮤니티</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--<li><a href="icons.html">Icons</a></li>-->
            <li><a href="editor.php">글쓰기</a></li>
            <li><a href="reports.php">게시판</a></li>
          </ul>
        </li>
        <?php } else{ ?>
          <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-group"></i><span>커뮤니티</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--<li><a href="icons.html">Icons</a></li>-->
            <li><a href="editor.php">글쓰기</a></li>
            <li><a href="reports.php">게시판</a></li>
          </ul>
        </li>
        <?php } ?>

        <?php if(strpos($_SERVER['REQUEST_URI'],"/browse") !== false){?>
          <li class="active"><a href="browse.php"><i class="icon-leaf"></i><span>찾아보기</span> </a></li>
        <?php } else{ ?>
          <li><a href="browse.php"><i class="icon-leaf"></i><span>찾아보기</span> </a></li>
        <?php } ?>

        <?php if(strpos($_SERVER['REQUEST_URI'],"/notice.php" || "/guidely.php" || "faq.php" || "qna.php") !== false){?>
          <li class="active dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-comments-alt"></i><span>고객센터</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--<li><a href="icons.html">Icons</a></li>-->
            <li><a href="/notice.php">공지사항</a></li>
            <li><a href="guidely.php">제품 사용설명서</a></li>
            <li><a href="faq.php">자주 묻는 질문</a></li>
            <li><a href="qna.php">1:1 문의하기</a></li>
          </ul>
        </li>
        <?php } else{ ?>
          <li class="dropdown"><a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-comments-alt"></i><span>고객센터</span> <b class="caret"></b></a>
          <ul class="dropdown-menu">
            <!--<li><a href="icons.html">Icons</a></li>-->
            <li><a href="/notice.php">공지사항</a></li>
            <li><a href="guidely.php">제품 사용설명서</a></li>
            <li><a href="faq.php">자주 묻는 질문</a></li>
            <li><a href="qna.php">1:1 문의하기</a></li>
          </ul>
        </li>
        <?php } ?>
      </ul>
    </div>
    <!-- /container --> 
  </div>
  <!-- /subnavbar-inner --> 
</div>