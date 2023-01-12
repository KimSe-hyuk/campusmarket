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
	
	<meta charset="utf-8">
	<title>캠퍼스 마켓</title>
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/index.css">
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
						<?php if ($userName=="admin")
							{
						?>
						<li><a href="/campusmarket/admin/list.php">관리자페이지</a></li>
						<?php
							}
						?>
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
				<div class="benner"><img src="image/benner.png" />
				</div>
				<div class="m9">캠퍼스마켓에서 일어나고 있는 일들</div>


				<script>
					function move(type, check) {

						if (check == 'box1') {
							var check = '.if-box1';
						} else if (check == 'box2') {
							var check = check = '.if-box2';
						} else if (check == 'box3') {
							var check = check = check = '.if-box3';
						}
						var tab = document.querySelector(check)
						var marginLeft = window.getComputedStyle(tab).getPropertyValue('margin-left');
						marginLeft = parseInt(marginLeft);
						console.log(marginLeft);
						if (type === 'right' && marginLeft != -666) {		//총 횟수*이미지크기 
							var a = marginLeft - 222;		//이미지크기+margin값
							document.querySelector(check).style.marginLeft = a + 'px';
							document.querySelector(check).style.transition = `${0.1}s ease-out`;

						} else if (type === 'left' && marginLeft != 0) {
							var a = marginLeft + 222;
							document.querySelector(check).style.marginLeft = a + 'px';
							document.querySelector(check).style.transition = `${0.1}s ease-out`;
						}

						else if (type === 'right1' && marginLeft != -1224) {		//총 횟수*이미지크기 
							var a = marginLeft - 306;		//이미지크기+margin값
							document.querySelector(check).style.marginLeft = a + 'px';
							document.querySelector(check).style.transition = `${0.1}s ease-out`;

						} else if (type === 'left1' && marginLeft != 0) {
							var a = marginLeft + 306;
							document.querySelector(check).style.marginLeft = a + 'px';
							document.querySelector(check).style.transition = `${0.1}s ease-out`;
						}




					}
				</script>





				<div class="tag-box">
					<div class="jb-a">
						<img onclick='move("left1","box1")' style="left:18px;" class="jb-c" src="image/left.png">
						<img onclick='move("right1","box1")' style="right:18px;" class="jb-c" src="image/right.png">



						<div class="if-box1">
							<a class="Imenu1"><img src="image/intro1.png" /></a>
							<a class="Imenu1"><img src="image/intro2.png" /></a>
							<a class="Imenu1"><img src="image/intro3.png" /></a>
							<a class="Imenu1"><img src="image/intro4.png" /></a>
							<a class="Imenu1"><img src="image/intro5.png" /></a>
							<a class="Imenu1"><img src="image/intro6.png" /></a>
							<a class="Imenu1"><img src="image/intro7.png" /></a>
						</div>

					</div>

				</div>

				<?php
                $bid = empty($_REQUEST["bid"]) ? "object" : $_REQUEST["bid"];

                $numLines = 7; // 리스트 한 페이지에 나올 행의 수 (글의 수)
                $numLinks = 3; // 한 페이지에 표시할 페이지 링크 갯수
                
                $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
                $start = ($page - 1) * $numLines;

                require("db_connect.php");
                ?>

				<div class="m9">다른 학생들이 무엇에 관심있는지 살펴보아요.</div>




				<div class="item-box">
					<div class="jb-a">

						<div class="if-box2">

							<?php
 
                $query = $db->query("select BO.*  from (board_object  BO LEFT JOIN member as Mem on BO.member_num=Mem.member_num)left join dips on dips.object_num=BO.object_num where sale_status	= 0 and Mem.university_num like '$university_num%'   GROUP by BO.object_num order by count(*) desc  limit 0, 7									");
			 
		 while ($row = $query->fetch()) {
			if (mb_strlen($row["object_name"]) >= 17) { //mb_strlen("문자열")  문자열 길이 측정
			  $row["object_name"] = substr($row["object_name"],0,17).'...';
			}

			$img_find_count = $db->query("select count(*) from file as F, board_object as B where F.f_num = B.object_num and B.object_num = ".$row['object_num']."");
			$img_find_num = $img_find_count->fetch();
			if ($img_find_num[0] == 0){
			  $file_src = './image/null.png';
			} else {
			  $img_find = $db->query("select * from file as F, board_object as B where F.f_num = B.object_num and B.object_num = ".$row['object_num']."");
			  if($img_one=$img_find->fetch()){
				
				$file_src = "./files/".$img_one['fm_num']."/".$img_one['f_img']."";
			  }
			}

                ?>
							<ul class="boards"
								onclick="location.href='item.php?bid=<?=$bid?>&object_num=<?= $row["object_num"] ?>&page=<?= $page ?>'">
								<!--&bnum=클릭한글번호-->
								
								<div class="<?php if ($row["sale_status"] == 1) {
		    echo 'overview';
	    }?>  ">


<?php if ($row["sale_status"] == 1) { ?>
<p class="overwrite">거래 완료</p>
<?php
	}?>
</div>
								<li class="board_img">
									<!--제품이미지-->
									<img src="<?=$file_src?>">
								</li>

								<li class="item_content">
									<span class="item_name">
									<?= mb_strimwidth($row["object_name"], 0, 13, "...", 'utf-8'); ?></span><br>
									<span class="item_price">
										<?= number_format($row["price"]) ?> 원
									</span>
								</li>
							</ul>
							<?php
                }
                    ?>

						</div>
						<img onclick='move("left","box2")' style="left:18px;" class="jb-c" src="image/left.png">
						<img onclick='move("right","box2")' style="right:18px;" class="jb-c" src="image/right.png">
					</div>
				</div>


				<div class="m9">새로운 주인을 찾고 있어요.</div>

				<div class="item-box">
					<div class="jb-a">

						<div class="if-box3">

							<?php
							
 $query2 = $db->query("select * from board_$bid  BO LEFT JOIN member as Mem on BO.member_num=Mem.member_num where sale_status	= 0 and Mem.university_num like '$university_num%'order by BO.regist_date desc  limit $start, $numLines");

					while ($row = $query2->fetch()) {
						if (mb_strlen($row["object_name"]) >= 17) { //mb_strlen("문자열")  문자열 길이 측정
						  $row["object_name"] = substr($row["object_name"],0,17).'...';
						}
			
						$img_find_count = $db->query("select count(*) from file as F, board_object as B where F.f_num = B.object_num and B.object_num = ".$row['object_num']."");
						$img_find_num = $img_find_count->fetch();
						if ($img_find_num[0] == 0){
						  $file_src = './image/null.png';
						} else {
						  $img_find = $db->query("select * from file as F, board_object as B where F.f_num = B.object_num and B.object_num = ".$row['object_num']."");
						  if($img_one=$img_find->fetch()){
							
							$file_src = "./files/".$img_one['fm_num']."/".$img_one['f_img']."";
						  }
						}

                ?>
							<ul class="boards"
								onclick="location.href='item.php?bid=<?= $bid ?>&object_num=<?= $row["object_num"] ?>&page=<?= $page ?>'">
								<!--&bnum=클릭한글번호-->
								
								<div class="<?php if ($row["sale_status"] == 1) {
		    echo 'overview';
	    }?>  ">


<?php if ($row["sale_status"] == 1) { ?>
<p class="overwrite">거래 완료</p>
<?php
	}?>
</div>
								<li class="board_img">
									<!--제품이미지-->
									<img src="<?=$file_src?>">
								</li>

								<li class="item_content">
									<span class="item_name">
										<?= mb_substr($row["object_name"], 0, 6, 'utf-8'); ?>
									</span><br>
									<span class="item_price">
										<?= number_format($row["price"]) ?> 원
									</span>
								</li>
							</ul>
							<?php
                }
                    ?>

						</div>
						<img onclick='move("left","box3")' style="left:18px;" class="jb-c" src="image/left.png">
						<img onclick='move("right","box3")' style="right:18px;" class="jb-c" src="image/right.png">
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

