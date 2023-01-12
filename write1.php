<?php
 session_start();
 require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>캠퍼스 마켓</title>
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/write.css">
	<script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
	<script type="text/javascript" src="/campusmarket/js/login.js"></script>
	
</head>

<body>
	

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
						<li><a onClick="reportCheck('<?=$userId?>')" style="cursor : pointer;">지원</a></li>
					</ul>
				</div>
				<div style="float:right;">

			
<?php 

if(	$_SESSION["userId"]!=""){

	$query3 = $db->query("select *  from member where email='$_SESSION[userId]' "); 
	while ($row = $query3->fetch()) {
	$iset=$row['member_img'];
	}
	
?>
              
                <img class="user_img" onclick="profileDisplay()" src="/campusmarket/user_img/<?= $iset?>">
                <?php
	   }else{
?>
<a class="logchat" href="/campusmarket/member/login_main.php"><img class="login_btn"src="/campusmarket/image/user.png"/></a>

         <?php	   
	   }
?>

<div style="display: none;" id="userDiv">
                <h3 style="margin: 14px 12px 0px 21px;"><?=$_SESSION["userName"]?></h3>
                <ul>
                    <li onclick="location.href='/campusmarket/myinfo.php';"><img class="userimg" src="/campusmarket/image/account.png">내 계정정보</li>
                    <li onclick="location.href='/campusmarket/mysell.php';"><img class="userimg" src="/campusmarket/image/mysell.png">판매 목록</li>
					<li onclick="location.href='/campusmarket/mybuy.php';"><img class="userimg" src="/campusmarket/image/mybuy.png">구매 목록</li>
                    <li onclick="location.href='/campusmarket/mydips.php';"><img class="userimg" src="/campusmarket/image/dips.png">내가 찜한 물건</li>
                    <li onclick="location.href='/campusmarket/report_list.php';"><img class="userimg" src="/campusmarket/image/report.png">신고 현황</li>
                    <li onclick="location.href='/campusmarket/member/log_out.php';"><img class="userimg" src="/campusmarket/image/logout.png">로그아웃 </li>
            </div>

			
			<a onClick="chattingCheck('<?=$userId?>')" style="cursor : pointer;"><img class="chat_btn" src="/campusmarket/image/chat.png" /></a>
		
					<form class="search-box" action="search_result.php" method="get">
						<input id="searchInput" name="search" type="text" placeholder="검색" size="10"
							required="required">
						<input class="Vector" name="button" type="image" src="/campusmarket/image/Vector.png">
					</form>


					

					
				</div>

			</div>
		</header>
		
	
	<div id="main" style="padding-top: 37px;">
		<div class="write-box">

				<div class="bar">
					<div class="bar2" style="width:10%;"></div>
				</div>
				<div class="bar-text">게시할 글의 종류를 알려주세요.</div>
				
				<form action="/campusmarket/write2.php" method="get">
					
					<div style=" display: flex; justify-content: space-between;">
						 <section class="write1-box" style="margin: 30px;">
							    <ul class="selectbox-option hide">
							   		<button style="margin-top: 120px;" type="submit" name="share" value="판매" class="option-btn" >판매하고 싶어요.</button>
								</ul>
							</section>

							<section class="write1-box" style="margin: 30px;">
							    <ul class="selectbox-option hide">
							   		<button style="margin-top: 120px;" type="submit" name="share" value="구매" class="option-btn" >구매하고 싶어요.</button>
								</ul>
							</section>
				
						
						  
						</div>

					
					
					
						
						
						</form>

						
					
				
			
			
			<div class="board_btns">
						<button type="button" onClick="history.back()">이전</button>
						
					</div>
			
			</div>
		</div>
	
		<div class="foter">
			<h3>캠퍼스 마켓</h3>
			<p>사업자 등록번호: 2018-132019 | 대표: 김세혁</p>
			<p>경기도 성남시 중원구 광명로 377 신구대학교 산학관 111호</p>
			<p>고객센터: 031-740-1114</p>
		</div>
</div>

</body>
</html>
