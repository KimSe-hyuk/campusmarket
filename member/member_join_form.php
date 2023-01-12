<?php
 session_start();
require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
  $userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

	$join_id = empty($_REQUEST["join_id"]) ? '' : $_REQUEST["join_id"];
	$join_name = empty($_REQUEST["join_name"]) ? '' : $_REQUEST["join_name"];
   $join_email = empty($_REQUEST["join_email"]) ? '' : $_REQUEST["join_email"];
   $join_email2 = empty($_REQUEST["join_email"]) ? '' : $_REQUEST["join_email2"];
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
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

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
	  <div style="margin: 41px auto;padding-top: 89px;"id="main">
	  	<div class="center-box">
			<div class="login_box">
  		<section>
  			<article id="login_find_wrap">
         
          <!--유저 정보 입력하는 곳-->
  				<form action="member_join.php" method="post" class="login" name="memberJoin">
				  <p id="login_text1">회원가입</p>
            <ul id="write_form">
				<li id="email_write">
  							<div  style="diplay:flex;display: flex;justify-content: center;align-items: flex-end;">
  							<input style="width:165px" class="member_text" type="text" name="join_email" value="<?=$join_email?>"
  							placeholder="이메일을 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='이메일을 입력해주세요.'">
							
							  <input style="width:165px" class="member_text" type="text" name="join_email2" value="@<?=$join_email2?>"
  							 onfocus="this.placeholder=''">
							   <button  style="    width: 50px;
    height: 58px;"type="button" onclick='emailCheck()'>인증하기</button>
							  </div>
  							
  						</li>
  					<?php
  						//if (/*이메일value가 있다면*/){
  					?>
  						<li>
  							<!--<div class="member_join_text">인증번호</div>-->
                <input type="text" value="<?=$sended_verification_code?>" name="sended_verification_code" id="sended_verification_code" style="visibility : hidden; display : none;">
  							<input class="member_text" type="text" name="join_verification_code" value=""
  							placeholder="이메일로 전송된 인증번호를 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='이메일로 전송된 인증번호를 입력해주세요.'">
  						</li>
  					<?php
  						//}
  					?>
					
  						
  						<li style="    display: flex;    flex-direction: column;   align-items: center;">
  							<!--<div class="member_join_pw">비밀번호</div>-->
  							<input id="pw1"class="member_join_pw" type="password" name="join_pw" value=""
  							placeholder="비밀번호 8~12자리를 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호 8~12자리를 입력해주세요.'">
  					 
  							<!--<div class="member_join_pw">비밀번호</div>-->
  							<input id="pw2" class="member_join_pw" type="password" name="join_pw2" value=""
  							placeholder="비밀번호 8~12자리를 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='비밀번호 8~12자리를 입력해주세요.'">
							  <p style="top: 550px;position:absolute"id="pw_check"></p>
					 
  						</li>	
						
						  <li style="display:flex;align-items: flex-end;justify-content: center">
  							<!--<div class="member_join_text">닉네임</div>-->
  							<input style="    width: 340px;" id="lo2"class="member_text" type="text" name="join_name" value="<?=$join_name?>"
  							placeholder="닉네임을 입력해주세요." onfocus="this.placeholder=''" onblur="this.placeholder='닉네임을 입력해주세요.'">
							  <div  style="position: relative;left:0px" onclick="re_check_name()" style="cursor: pointer; " class="re_check">중복확인</div>
							 
  						</li>
						  <p style="display: block;text-align: center;color: black;position: relative;left:0px;top:0px;"id="result2"></p>

  					</ul>

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


	</div>
    <!-- 푸터 -->

	<div class="foter">


			<p>캠퍼스 마켓</p>
			<p>사업자 등록번호: 2018-132019 | 대표: 김세혁</p>
			<p>경기도 성남시 중원구 광명로 377 신구대학교 산학관 111호</p>
			<p>고객센터: 031-740-1114</p>
		</div>
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

<script>
    function re_check_name() {
        $.ajax({
            url: "rechecke_name_ajax.php",
            type: "post",
            data: {
                name: $('#lo2').val(),
            }
        }).done(function(data) {
            $('#result2').text(data);
        });
    }
</script>
<script>
var new_pw,ps_ok;
$(document).ready(function(e) { 

$(".member_join_pw").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this); 
		
		if(self.attr("id") === "pw1"){ 
			new_pw = self.val(); 
		} 
		
		if(self.attr("id") === "pw2"){ 
			ps_ok = self.val(); 

		if(new_pw==ps_ok){
			ps_ok='ok';
		}else{
			ps_ok='no';
		}

		
			$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
			"pw_check_ajax.php",
			{ ps_ok : ps_ok }, 
			function(data){ 
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("#pw_check").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
					self.parent().parent().find("#pw_check").css("color", "#F00"); //div 태그를 찾아 css효과로 빨간색을 설정합니다
				}
			}
		);
}
	});


});
</script>















	

		
		
		
		
		
		
		
		
		
		
		
	