<?php

require("db_connect.php");

$useremail = empty($_REQUEST["join_email"])? '' : $_REQUEST["join_email"];
$useremail2= empty($_REQUEST["join_email"]) ? '' : $_REQUEST["join_email2"];
$sended_verification_code = empty($_REQUEST["sended_verification_code"]) ? '' : $_REQUEST["sended_verification_code"];
$join_verification_code = empty($_REQUEST["join_verification_code"]) ? '' : $_REQUEST["join_verification_code"];
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
	  <div id="main" style="padding-top:89px;">>
	  	<div class="center-box">
			<div class="login_box">
  		<section>
  			<article id="login_find_wrap">
         
          <!--유저 정보 입력하는 곳-->
  				<form action="find_member_pw.php" method="get" class="login" name="memberJoin">
				  <p id="login_text1">비밀번호 찾기</p>
            <ul id="write_form">
				<li id="email_write">
  							<div style="display:flex">
  							<input style="width:200px" class="member_text" type="text" id="join_email" name="join_email" value=""
  							placeholder="이메일을 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='이메일을 입력해주세요.'">
							
							  <input style="width:210px" class="member_text" type="text" id="join_email2" name="join_email2" value="@"
  							placeholder="@" onfocus="this.placeholder=''" onblur="this.placeholder='@'">
							  </div>
  							<div id="shingu_email"></div>
  							<button type="button" onclick='emailCheck()'>인증하기</button>
  						</li>
  					<?php
  						//if (/*이메일value가 있다면*/){
  					?>
  						<li>
  							<!--<div class="find_member">인증번호</div>-->
               	 <input type="text" value="<?=$sended_verification_code?>" name="sended_verification_code" id="sended_verification_code" style="visibility : hidden; display : none;">
  							<input class="member_text" type="text" name="join_verification_code" id= "join_verification_code" value=""
  							placeholder="이메일로 전송된 인증번호를 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='이메일로 전송된 인증번호를 입력해주세요.'">
  						</li>
  					<?php
  						//}
  					?>
					
  					</ul>
					  <div class="member_btns">
						<button type="button" OnClick="location.href ='login_main.php'" class="">취소</button>
						<input type="submit" value="확인" id="login_submit">
					</div>
					
				</form> <!--join_form END-->

  			</article>
  		</section>
	  </main>
    </div> <!-- wrap END -->
	</div>



    <!-- 푸터 -->
    
  </body>
</html>
<script>
	/*세션 가져오기*/
  let loginState = '<?php echo $userName ?>';
  let loginId = '<?php echo $userId ?>';
</script>
<script src="js/campus_market_javascript.js"></script>
<script>

function emailCheck() {
  form = document.memberJoin; /*form태그의 name을 통해 input값 접근*/
  check = form.join_email.value;
  if (check == '') {
    alert('메일 주소를 입력해주세요.');
    form.join_email.focus();
    return false;
  } else {
    window.open('email_check.php?join_email='+form.join_email.value+form.join_email2.value+'&page=join','캠퍼스 마켓','width=500px,height=500px');
  }
}
</script>
















	

		
		
		
		
		
		
		
		
		
		
		
	