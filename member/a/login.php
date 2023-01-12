<!DOCTYPE html>
<html lang="ko">
  <head>
 <meta charset="utf-8">

<link rel="stylesheet" type="text/css" href="/campusmaket/style.css">
<link rel="stylesheet" type="text/css" href="/campusmaket/login.css">
</head>


<script>
List = [];
</script>

<div>

<?php
/* 
	require("db_connect.php");
	session_start();
$query3 = $db->query("SELECT title FROM tv UNION SELECT title  FROM movie "); 
	while ($row = $query3->fetch()) {
	
	
	

?>
<script>
List.push('<?=$row['title'];?>');
</script>
<?php
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
			
			<form class="login" action="log_in.php" method="post">

	<div id="login_text1">로그인</div>
		
<?php
$nonid = empty($_REQUEST["nonid"]) ? "aaaaaaaa" : $_REQUEST["nonid"];

	if($nonid=='no'){
?>
	<div class="non_id">존재하지 않는 아이디입니다</div>
<?php
	}
?>
		<input id="id"type="text" name="id" placeholder="아이디">

		<input style="margin-top: 260px;" id="id" type="password" name="pw" placeholder="비밀번호">

	<input type="image" name="submit"  class="next"src="img/next.png" border="0">
	<p style="cursor:pointer;"class="find"onclick="location.href='id_pw_find.php';">아이디/ <a style="color: white;"href="pw_find.php">비밀번호 찾기</a></p>
	<p style="top: 476px;cursor:pointer;" class="find"onclick="location.href='member_join.php?bid=';">계정이 없으신가요?가입</p>

		<!--<div class="google_login"><img class="google"src="img/google.png">Google로 로그인</div>-->

</form>
			
			
			



		</div>
	</div>
	<div class="foter">

		</div>
</div>

</body>
</html>