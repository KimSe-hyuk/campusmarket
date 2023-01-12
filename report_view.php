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
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/student.css">
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
		<div class="center-box" style="    padding-top: 40px; padding-bottom: 96px;">
	
		<h1>신고접수</h1>
		
		<div class="st_write">

<?php
    $bid = empty($_REQUEST["bid"]) ? "reports" : $_REQUEST["bid"];
    
    $board_report = $_REQUEST["board_report"];
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];    
    
    require("db_connect.php");
	$query = $db->query("select * from board_$bid b INNER JOIN member m ON b.reporting_person = m.member_num where b.board_report=$board_report");
   
	   if($row = $query->fetch()){
 ?>		
      
	  <span>신고번호 <?= $row["board_report"] ?></span>
                <div class="aaa"><?=$row["report_title"]?>
          </div>

		  <div style="display: flex; align-items: center; justify-content: space-between;">
		 <div style="display: flex; align-items: center;" > 
		  <img style="width: 33px;height: 33px;background: #D9D9D9; border-radius: 50%;" src="user_img/<?=$row['member_img']?>">
		 <span style="margin-left: 10px;"> 
		  <div style="font-weight: 600; line-height: 16px;"><?= $row["nickname"]?></div>
		  <div><?=$row["write_date"]?></div>
	</span>
	</div>

	</div>

           <hr style="margin-bottom:28px"></hr>
		   <h3 style="margin: 0 auto; margin-bottom: 5px;">신고대상자</h3>
		   <?=$row["reported_person"]?>
		   <h3 style="margin: 0 auto; margin-top: 28px; margin-bottom: 5px;">자세한 내용</h3>
                <?=$row["board_contents"]?>	 
			<hr style="margin-top:34px; margin-bottom:28px"></hr>
				<h3>처리상태 <span style="padding: 4px 12px;
background: #D9D9D9;
border-radius: 10px;"><?=$row["report_check"]==0?"처리중":"처리완료" ?></span></h3>
		<?php
		}
		?>


  
   
	
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

	
	
	
	
	