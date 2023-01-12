<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="/campusmaket/style.css">
    <link rel="stylesheet" type="text/css" href="/campusmaket/login.css">


    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

</head>

<script>
List = [];
</script>

<div>
<?php 
/*
	require("db_connect.php");
	session_start();
	$_SESSION["userId"] = empty($_SESSION["userId"]) ? "" : $_SESSION["userId"];
	
$query3 = $db->query("SELECT title FROM tv UNION SELECT title  FROM movie "); 
	while ($row = $query3->fetch()) {
	
	
	
*/
?>
<script>
List.push('<?=$row['title'];?>');
</script>
<?php
/*
}
*/
?>

</div>
<script>

    $(function() {
        $("#searchInput").autocomplete({
            source: List,
            focus: function(event, ui) {
                return false;
            },
            minLength: 1,
            delay: 100,


        });
    });
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
    function re_check_email() {
        $.ajax({
            url: "rechecke_mail_ajax.php",
            type: "post",
            data: {
                email: $('#lo1').val(),
            }
        }).done(function(data) {
            $('#result').text(data);
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
<body>

<div id="wrap">

	<header id="header">
		<div class="header-box">
			<a class="logo" href="/campusmaket/index.php"><img src="image/logo.png"/></a>

			<a class="nav_item" href="/"><img class="login_btn" src="image/user.png"/></a>
			<a class="nav_item" href="/"><img class="chat_btn" src="image/chat.png"/></a>
			<form class="search-box" action="/" method="get">
				<input id="searchInput" type="text" placeholder="검색" size="10" style="border:none; background-color: #f3f3f3; text-align:center; margin-top:7px;">
				<input class="Vector" name="button" type="image" src="image/Vector.png">
			</form>
			<a class="nav_item" href="/">지원</a>
			<a class="nav_item" href="/">학생공간</a>
			<a class="nav_item" href="/">벼룩시장</a>		
		</div>
	</header>
		
		
		
		

	<div id="main">
		<div class="center-box">
		<div class="abox"></div>
		<form method="post" action="member_join_in.php" name="memform" class="login_join">
            

                    <p id="login_text1">회원가입</p>
                
                <input style="margin-top: 114px; width: 263px;	" class="member_join_text" id="lo1" type="text" name="id" placeholder="아이디 입력">
                <div onclick="re_check_email()"style="cursor: pointer; margin-top: 114px " class="re_check">중복확인</div>
                <p id="result"></p>

                <input style="margin-top: 200px;" class="member_join_pw" type="password" id="pw1"name="pw" placeholder="비밀번호 입력">
                <input style="margin-top: 286px;" class="member_join_pw" type="password" id="pw2"name="pw" placeholder="비밀번호 확인">
               <p class="pwrepl"id="pw_check"style="">비밀번호 중복확인</p>
			   
			   <input style="margin-top: 372px;width: 263px;" class="member_join_text" id="lo2" type="text" name="name" placeholder="닉네임 입력">
               
			   <div onclick="re_check_name()" style="cursor: pointer;margin-top: 372px;" class="re_check">중복확인</div>
                <p id="result2"></p>
				
				<input style="margin-top: 458px;width: 263px;" class="member_join_text" id="lo2" type="text" name="name" placeholder="인증번호 입력">
               
			   <div onclick="re_check_name()" style="cursor: pointer;margin-top: 458px;" class="re_check">중복확인</div>
                <p id="result2"></p>

                <input type="submit" class="memberjoin_btn" value="회원가입" />
            
        </form>
		
			





		</div>
		

		
	</div>
	<div class="foter">

		</div>
</div>

</body>
</html>




  </body>
 
</html>

<script src="js/campus_market_javascript.js"></script>
<script>
function emailCheck() {
  form = document.memberJoin; /form태그의 name을 통해 input값 접근/
  check = form.join_email.value;
  if (check == '') {
    alert('메일 주소를 입력해주세요.');
    form.join_email.focus();
    return false;
  } else {
    window.open('email_check.php?join_email='+form.join_email.value+'@g.shingu.ac.kr&page=join','캠퍼스 마켓','width=500px,height=500px');
  }
}

</script>
