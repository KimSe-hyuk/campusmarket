 <?php
 session_start();
require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
  $userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

	$join_id = empty($_REQUEST["join_id"]) ? '' : $_REQUEST["join_id"];
	$join_name = empty($_REQUEST["join_name"]) ? '' : $_REQUEST["join_name"];
   $join_email = empty($_REQUEST["join_email"]) ? '' : $_REQUEST["join_email"];
   $sended_verification_code = empty($_REQUEST["sended_verification_code"]) ? '' : $_REQUEST["sended_verification_code"];
   $join_verification_code = empty($_REQUEST["join_verification_code"]) ? '' : $_REQUEST["join_verification_code"];
   
	?>

 <?php
   
  require("db_connect.php");

	$userName= empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
	$userNum = empty($_REQUEST["user_num"]) ? '' : $_REQUEST["user_num"];
  $login_id = empty($_REQUEST["user_id"]) ? '' : $_REQUEST["user_id"];
	
	?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>캠퍼스 마켓</title>
		<link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
		<link rel="stylesheet" type="text/css" href="/campusmarket/css/index.css">
		<link rel="stylesheet" type="text/css" href="/campusmarket/css/login.css">
    <style media="screen">

    </style>

  </head>
  <body>
  <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
  <div id="wrap">
		<header id="header">
			<div class="header-box">

				<span class="logo">
					<a href="/campusmarket/index.php"><img src="/campusmarket/image/logo.png" /></a>
				</span>
				<div class="nav-box">
					<ul>
						<li>&nbsp;</li>
						<li><a href="/campusmarket/itemlist.php">벼룩시장</a></li>
						<li><a href="/campusmarket/board_list.php">학생공간</a></li>
						<li><a href=#">지원</a></li>
						<li>&nbsp;</li>
					</ul>
				</div>
				<div style="float:right;">

					<a class="logchat" href="/"><img class="chat_btn" src="/campusmarket/image/chat.png" /></a>
					<a class="logchat" href="/campusmarket/member/login_main.php"><img class="login_btn"
							src="/campusmarket/image/user.png" /></a>

					<form class="search-box" action="search_result.php" method="get">
						<input id="searchInput" name="search" type="text" placeholder="검색" size="10"
							required="required">
						<input class="Vector" name="button" type="image" src="/campusmarket/image/Vector.png">
					</form>
				</div>
			</div>
		</header>


</style>
      <!-- 메인 -->
	  <div id="main">
	  	<div class="center-box">
			<div class="login_box">
  		<section>
  			<article id="login_find_wrap">
          <!--페이지 이름-->
  				<div class="login_text1">회원가입</div>
          <!--유저 정보 입력하는 곳-->
  				<form action="member_join.php" method="get" class="member_form" name="login">
            <ul id="write_form">
  						<li>
  							<div class="member_join_text">닉네임</div>
  							<input class="member_write" type="text" name="join_name" value="<?=$join_name?>"
  							placeholder="닉네임을 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='닉네임을 입력해주세요.'">
  						</li>
  						<li>
  							<div class="member_join_text">아이디</div>
  							<input class="member_write" type="text" name="join_id" value="<?=$join_id?>"
  							placeholder="학번을 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='학번을 입력해주세요.'">
  						</li>
  						<li>
  							<div class="member_join_pw">비밀번호</div>
  							<input class="member_write" type="password" name="join_pw" value=""
  							placeholder="비밀번호 8~12자리를 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호 8~12자리를 입력해주세요.'">
  						</li>
  						<li id="email_write">
  							<div class="member_join_text">이메일</div>
  							<input class="member_write_email" type="text" name="join_email" value="<?=$join_email?>"
  							placeholder="이메일을 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='이메일을 입력해주세요.'">
  							<div id="shingu_email">@ g.shingu.ac.kr</div>
  							<button class="verification_code" type="button" onclick='emailCheck()'>인증하기</button>
  						</li>
  					<?php
  						//if (/*이메일value가 있다면*/){
  					?>
  						<li>
  							<div class="member_join_text">인증번호</div>
                <input type="text" value="<?=$sended_verification_code?>" name="sended_verification_code" id="sended_verification_code" style="visibility : hidden; display : none;">
  							<input class="member_write" type="text" name="join_verification_code" value=""
  							placeholder="이메일로 전송된 인증번호를 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='이메일로 전송된 인증번호를 입력해주세요.'">
  						</li>
  					<?php
  						//}
  					?>
  					</ul>
					<div class="agreement">가입 시 <input type="button" value="이용약관" onclick="window.open('terms_of_service.php', 'popup', 'width=1024px, height=auto')"> 및
						<input type="button" value="개인정보 취급방침" onclick="window.open('privacy_policy.php', 'popup', 'width=1024px, height=auto')">에 동의합니다.</div>
					<!--버튼-->
					<div class="member_btns">
						<button type="button" OnClick="location.href ='login_main.php'" class="">취소</button>
						<input type="submit" value="회원가입" id="login_submit">
					</div>
				</form> <!--join_form END-->

  			</article>
  		</section>
	  </main>
    </div> <!-- wrap END -->
	</div>



    <!-- 푸터 -->
    <footer>
      <div id="footer_content">
        <div class="logo_footer">
          <img src="./img/logo_footer.png" alt="캠퍼스마켓">
        </div>
        <div class="title_footer">신구대학교 교재, 도구 중고 거래 사이트</div>
        <nav>
          <a href="privacy_policy.php" class="privacyPolicy">개인청보처리방침</a>
          <a href="terms_of_service.php" class="tos">이용약관</a>
        </nav>
      </div>
</div>
    </footer>
  </body>
</html>
<script>
	/*세션 가져오기*/
  let loginState = '<?php echo $userName ?>';
  let loginId = '<?php echo $userId ?>';
</script>
<script src="js/campus_market_javascript.js"></script>

















	

		
		
		
		
		
		
		
		
		
		
		
	