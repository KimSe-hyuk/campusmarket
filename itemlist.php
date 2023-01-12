<?php
 session_start();
 require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
	$university_num = empty($_SESSION["university_num"]) ? '' : $_SESSION["university_num"];
 
?>

<!DOCTYPE html>
<html lang="ko">
 
<head>
<meta charset="UTF-8">
	<title>캠퍼스 마켓</title>
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/index.css">
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/item.css">
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
		<div class="center-box">
	

		<div class="menu-box">
			<ul>
				<li><a href="itemlist.php?category=1">전공서적</a></li>
				<li><a href="itemlist.php?category=2">실습도구</a></li>
				<li><a href="itemlist.php?category=3">방</a></li>
				<li><a href="itemlist.php?category=4">기타</a></li>
				<li><a href="itemlist.php?category=5">생활용품</a></li>
			</ul>
		</div>


		<?php
    $bid = empty($_REQUEST["bid"]) ? "object" : $_REQUEST["bid"];
   

    $numLines = 20; // 리스트 한 페이지에 나올 행의 수 (글의 수)
    $numLinks = 3; // 한 페이지에 표시할 페이지 링크 갯수
    
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    $start = ($page - 1) * $numLines;
    
	$category = empty($_REQUEST["category"]) ? "" : $_REQUEST["category"];
	switch ($category) {
		case 1:
			$category='전공서적';
			break;
		case 2:
			$category='실습도구';
			break;
		case 3:
			$category='방';
			break;
		case 4:
			$category='기타';
			break;
		case 5:
			$category='생활용품';
			break;
	}

	?>

			<div>
				<script>
                    function doDisplay() {
                        var con = document.getElementById("myDIV");
						var con2 = document.getElementById("carta");
                        if (con.style.display == 'none') {
                            con.style.display = 'block';
                        } else {
                            con.style.display = 'none';
                        }

						if (con2.style.display == 'none') {
                            con2.style.display = 'block';
                        } else {
                            con2.style.display = 'none';
                        }
                    }
            </script>
				<div style=" position: absolute; text-align: center; z-index: 3; margin-left: 750px;">
				
					<a  id="carta" href="javascript:doDisplay();"><img src="/campusmarket/image/filteroff.png" style="padding-right:11px;"/>전체</a>
				
				<div style="display: none;  padding: 15px; background: #007FFF; box-shadow: 0px 3px 3px rgb(0 0 0 / 25%); border-radius: 16px;text-align: right;" id="myDIV">
                    <ul>
                        <li><a style="color: #FFFFFF;" href="itemlist.php?category=<?=$category?>&share=1"><img src="/campusmarket/image/filteron.png" style="padding-right:11px;"/>전체</a>    </li>      
                        <li style="margin-top: 13px;padding-bottom: 12px;"><a style="color: #FFFFFF;" href="itemlist.php?category=<?=$category?>&share=2">삽니다</a>  </li>     
                        <li style="padding-bottom: 12px;"><a style="color: #FFFFFF;" href="itemlist.php?category=<?=$category?>&share=3">팝니다</a>  </li>
                        <li ><a style="color: #FFFFFF;" href="itemlist.php?category=<?=$category?>&share=4">나눔</a>    </li>         
                    </ul>
				</div>

				
				
			</div>
			
				
			</div>
				
			
		<div class="result-box">
					
	<?php

	$share = empty($_REQUEST["share"]) ? "" : $_REQUEST["share"];
	switch ($share) {
		case 1:
			$share='';
			break;
		case 2:
			$share='구매';
			break;
		case 3:
			$share='판매';
			break;
		case 4:
			$share='나눔';
			break;
	}


	//$query = $db->query("select * from board_$bid where object_category like '%$category%' and share like '%$share%' order by object_num desc limit $start, $numLines");
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

	$query = $db->query("select BO.*  from board_$bid  as BO LEFT JOIN member as Mem on BO.member_num=Mem.member_num
	 where object_category like '%$category%' and share like '%$share%'  and Mem.university_num like '$university_num%'  order by object_num desc ");
    while ($row = $query->fetch()) {
	    if (mb_strlen($row["object_name"]) >= 17) { //mb_strlen("문자열")  문자열 길이 측정
    		$row["object_name"] = substr($row["object_name"], 0, 17) . '...';
	    }

	    $img_find_count = $db->query("select count(*) from file as F, board_object as B where F.f_num = B.object_num and B.object_num = " . $row['object_num'] . "");
	    $img_find_num = $img_find_count->fetch();
	    if ($img_find_num[0] == 0) {
		    $file_src = './image/null.png';
	    } else {
		    $img_find = $db->query("select * from file as F, board_object as B where F.f_num = B.object_num and B.object_num = " . $row['object_num'] . "");
		    if ($img_one = $img_find->fetch()) {

			    $file_src = "./files/" . $img_one['fm_num'] . "/" . $img_one['f_img'] . "";
		    }
	    }

	    
    ?>
	<ul class="boards" style="position: relative;" onclick="location.href='item.php?bid=<?= $bid ?>&object_num=<?= $row['object_num'] ?>'"><!--&bnum=클릭한글번호-->
	
  <div class="<?php if ($row["sale_status"] == 1) {
		    echo 'overview';
	    }?>  ">


<?php if ($row["sale_status"] == 1) { ?>
<p class="overwrite">거래 완료</p>
<?php
	}?>
</div>
							<li class="board_img"> <!--제품이미지-->
							<img src="<?= $file_src ?>">
							</li>
							<li class="item_content">
								<span class="item_name">
									<?= mb_strimwidth($row["object_name"], 0, 13, "...", 'utf-8'); ?></span><br>
								<span class="item_price"><?= number_format($row["price"]) ?> 원</span>
							</li>
						
	
	</ul>
<?php
	 
    }
?>


					</div>

		</div>
		

			<a style="    cursor: pointer;" OnClick="objectCheck('<?=$userId?>')" class="write"><img class="write.png" src="image/write.png"/></a>
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
