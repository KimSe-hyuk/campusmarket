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
		<div class="center-box" style="padding-top: 40px;">

		<h1 style="margin: 0 auto;">학생공간</h1>
		<span>학교 전반에 대한 자유로운 주제로 대화해보세요.</span>

		<div class="boardlist-box">
		
		<table>
    <tr>
        <th class="board_num"    >번호    </th>
		<th class="board_category"  >말머리<a href="javascript:doDisplay();">▼</a>    </th>
        <th class="board_title"  >제목    </th>
		<th class="member_num"  >작성자    </th>
        <th class="write_date">작성일시</th>
        <th class="hits"      >조회  </th>
    </tr>

<?php
    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];
    
    $board_numLines = 14; // 리스트 한 페이지에 나올 행의 수 (글의 수)
    $board_numLinks = 4; // 한 페이지에 표시할 페이지 링크 갯수
    
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    $start = ($page - 1) * $board_numLines;
    
	$board_category = empty($_REQUEST["board_category"]) ? "" : $_REQUEST["board_category"];
	switch ($board_category) {
		case 1:
			$board_category='';
			break;
		case 2:
			$board_category='자유';
			break;
		case 3:
			$board_category='정보';
			break;
		case 4:
			$board_category='후기';
			break;
	}
	
	?>

			<div>
				<script>
                    function doDisplay() {
                        var con = document.getElementById("myDIV");
					
                        if (con.style.display == 'none') {
                            con.style.display = 'block';
                        } else {
                            con.style.display = 'none';
                        }

						
                    }
            </script>
				<div style=" position: absolute; text-align: center; z-index: 3; margin-left: 120px;margin-top: 30px;">
				
					
				
				<div style="display: none;background: white; text-align: center;" id="myDIV">
                    <ul>
                        <li style="border: 1px solid #727272; padding: 4px 13px;"><a href="board_list.php?board_category=1">전체</a></li>      
                        <li style="border: 1px solid #727272; padding: 4px 13px;"><a href="board_list.php?board_category=2">자유</a>  </li>     
                        <li style="border: 1px solid #727272; padding: 4px 13px;"><a href="board_list.php?board_category=3">정보</a>  </li>
                        <li style="border: 1px solid #727272; padding: 4px 13px;"><a href="board_list.php?board_category=4">후기</a> </li>         
                    </ul>
				</div>

				
				
			</div>
			
				
			</div>
<?php   
    $query = $db->query("select * ,DATE(write_date) as write_date from board_$bid s INNER JOIN member m ON s.member_num = m.member_num where board_category like '%$board_category%' order by board_num desc limit $start, $board_numLines");
    
    while ($row = $query->fetch()) {
?>
    <tr>
        <td><?=$row["board_num"]?></td>
		<td>[<?=$row["board_category"]?>]</td>										
        <td style="text-align:left;"><a href="board_view.php?bid=<?=$bid?>&board_num=<?=$row["board_num"]?>&page=<?=$page?>"><?=iconv_substr($row["board_title"], 0,10, "utf-8")?></a></td>
        <td><?=$row["nickname"]?></td>
		<td><?=$row["write_date"]?></td>
        <td><?=$row["hits"]?></td>
    </tr>
	
<?php    
    }
?>
</table>
<h1>
<input class="write-btn"type="button" value="글쓰기" onclick="location.href='board_write.php?bid=<?=$bid?>'">
</h1>
<Br><br>
<?php    
    $firstLink = floor(($page - 1) / $board_numLinks) * $board_numLinks + 1;
    $lastLink = $firstLink + $board_numLinks - 1;
    
    $board_numRecords = $db->query("select count(*) from board_$bid")->fetchColumn();
    $board_numPages = ceil($board_numRecords / $board_numLines);
    if ($lastLink > $board_numPages) {
        $lastLink = $board_numPages;
    }
?>

<div style="text-align:center;padding: 11px;">
<?php    
    if ($firstLink > 1) {
?>
        <a href="board_list.php?bid=<?=$bid?>&page=<?=$firstLink - $board_numLinks?>">이전</a>
<?php    
    }
    
    for ($i = $firstLink; $i <= $lastLink; $i++) {
?>    
        <a href="board_list.php?bid=<?=$bid?>&page=<?=$i?>"><?=($i == $page) ? "<u>$i</u>" : $i?></a>
<?php
    }
    
    if ($lastLink < $board_numPages) {
?>
        <a href="board_list.php?bid=<?=$bid?>&page=<?=$firstLink + $board_numLinks?>">다음</a>
<?php
    }
?>       
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

	




















