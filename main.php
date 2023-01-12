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
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/main.css">
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

		
		
	
	
	
	
	<div id="main">
	

		<div class="content1">
		
				<h1 class="content1_intro">
					  대학생만을 위한 거래공간, 
					  <br>
					  우리는 캠퍼스마켓입니다
				</h1>
			<img src="image/main1.png"/>
		
		</div>



		<div class="content2">
		
		
		
		<div id="ClogoboxL">
			   <div class="Clogo1">
				  <div>
					  <img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>
					  </div>        

					<!--   clone     -->
	 
	 
						<img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>				  
				
				</div>
			</div>
			
			<div id="ClogoboxL">
			   <div class="Clogo2">
				  <div>
				  <img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>
					  </div>        

					<!--   clone     -->
	 
	 
						<img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>		
				  
				</div>
			</div>
			
			
			
			
			
		
			<div id="ClogoboxR">
			   <div class="Clogo1">
				  <div>
			 <img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>
					  </div>        

					<!--   clone     -->
	 
	 
						<img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>		
				  
				</div>
			</div>
			<div id="ClogoboxR">
			   <div class="Clogo2">
				  <div>
			 <img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>
					  </div>        

					<!--   clone     -->
	 
	 
						<img src="image/university_logo/1.png"/>
					  <img src="image/university_logo/2.png"/>
					  <img src="image/university_logo/3.png"/>
					  <img src="image/university_logo/4.png"/>
					  <img src="image/university_logo/5.png"/>
					  <img src="image/university_logo/6.png"/>
					  <img src="image/university_logo/7.png"/>
					  <img src="image/university_logo/8.png"/>
					  <img src="image/university_logo/9.png"/>
					  <img src="image/university_logo/10.png"/>
					  <img src="image/university_logo/11.png"/>
					  <img src="image/university_logo/12.png"/>
					  <img src="image/university_logo/13.png"/>
					  <img src="image/university_logo/14.png"/>
					  <img src="image/university_logo/15.png"/>
					  <img src="image/university_logo/16.png"/>
					  <img src="image/university_logo/17.png"/>
					  <img src="image/university_logo/18.png"/>
					  <img src="image/university_logo/19.png"/>
					  <img src="image/university_logo/20.png"/>
					  <img src="image/university_logo/21.png"/>
					  <img src="image/university_logo/22.png"/>
					  <img src="image/university_logo/23.png"/>
					  <img src="image/university_logo/24.png"/>		
				  
				</div>
			</div>
			
			
			
<div class="content2-1"> 
</div>

			<h1 class="content2_intro">
		  전국의 대학교 400여곳에서 
		  <br>
		  거래가 이뤄지고 있어요
		</h1>

		<p class="content2_intro2">
		  소속 대학이 아닌 다른 대학 장터로도
			<br>		  
			방문할 수 있어요
		</p>
		</div>



	<div class="content3">
		
	<div class="content3-1">
	
	<div style="width:350px; height:350px; left: 0px; margin: 50px;"><img src= "image/main3.png"/></div>
	<div>
	<h1 class="content3_intro">
			  필요없는 물품 처분은 
			  <br>
			  우리에게 맡기세요
		</h1>
		<button class="start_btn" onClick="location.href='/campusmarket/index.php'">지금 시작하기</button>
		
	</div>
		
	
		
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

	
  
  
  
