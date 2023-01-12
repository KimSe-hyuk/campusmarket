<?php

	session_start();
	require("db_connect.php");
   $userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
   $userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];

    $board_title = "";
    //$writer = "";
    $board_contents = "";
	$board_category ="";
    $action = "board_insert.php?bid=$bid";

    $board_num = empty($_REQUEST["board_num"]) ? "" : $_REQUEST["board_num"];    
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    
    if ($board_num) {    // 글 번호가 주어졌으면
        require("db_connect.php");
        $query = $db->query("select * from board_$bid where board_num=$board_num");
        
        if ($row = $query->fetch()) {
            $board_title = $row["board_title"];
            //$writer = $row["writer"];
			$board_category = $row["board_category"];
            $board_contents = $row["board_contents"];
            $action = "board_update.php?bid=$bid&board_num=$board_num&page=$page";
        }
    }
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
		<div class="center-box" style="padding-top: 40px;padding-bottom: 96px;">
	
		
		
		<h1> 학생공간 글쓰기 </h1>
		
		
		<div class="st_write">
		
		<form method="post" action="<?=$action?>">
   
            
            <input type="text" name="board_title" style="width:550px; border:0; border-bottom: 1px solid #A8A8A8; "  placeholder="제목을 입력해 주세요."  maxlength="80" value="<?=$board_title?>">
            <select name="board_category" id="board_category" style="float:right; background: #F3F3F3; border: 1px solid #A8A8A8;">
			  <option value="">말머리 선택</option>
			  <option value="전체"<?= ( $board_category== "전체" ) ? "selected" : "" ?>>전체</option>
			  <option value="자유"<?= ( $board_category== "자유" ) ? "selected" : "" ?>>자유</option>
			  <option value="정보"<?= ( $board_category== "정보" ) ? "selected" : "" ?>>정보</option>
			  <option value="후기"<?= ( $board_category== "후기" ) ? "selected" : "" ?>>후기</option>
			
			</select>
        
      
            <td><textarea style="width:716px; margin-top: 17px; resize: none; padding: 27px 9px 60px 9px;border: 1px solid #A8A8A8;" placeholder="내용을 입력하세요." name="board_contents" rows="20"><?=$board_contents?></textarea>
        <div style="display: flex;justify-content: center;">
		<input class="writesave" type="submit" value="등록">
	</div>
    <!--<input type="button" value="취소" onclick="history.back()">-->

</form>
	
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

	
	
	
	
	

