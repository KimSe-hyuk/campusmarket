<?php

require("db_connect.php");

$pw1 = empty($_REQUEST["present_pw"])? '' : $_REQUEST["present_pw"];
$pw2 = empty($_REQUEST["new_pw"])? '' : $_REQUEST["new_pw"];



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

		<?php
		?>

</style>
      <!-- 메인 -->
	  <div id="main">
	  	<div class="center-box">
			<div class="login_box">
  		<section>
  			<article id="login_find_wrap">
         
          <!--유저 정보 입력하는 곳-->
  				<form action="find_member_pw.php" method="get" class="login" name="memberJoin">
				  <p id="login_text1">비밀번호 변경</p>
            <ul id="pw_form">
						<li>
  							<div style="display:flex">
  							<input class="member_text" type="text" name="present_pw" id= "present_pw" value=""
  							placeholder="새로운 비밀번호 입력" onfocus="this.placeholder=''" onblur="this.placeholder='새로운 비밀번호 입력'">
							
  						</li>
  					<?php
  						
  					?>
  						<li>
  							
               	 		
  							<input class="member_text" type="text" name="new_pw1" id= "new_pw1" value=""
  							placeholder="새로운 비밀번호 입력" onfocus="this.placeholder=''" onblur="this.placeholder='새로운 비밀번호 입력'">
  						</li>
						  <li>
  							
						  <input class="member_text" type="text" name="new_pw2" id= "new_pw2" value=""
  							placeholder="새로운 비밀번호 재입력" onfocus="this.placeholder=''" onblur="this.placeholder='새로운 비밀번호 재입력'">
							</li>
  					<?php
  						
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















	

		
		
		
		
		
		
		
		
		
		
		
	