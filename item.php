<?php
 session_start();
 require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
	$userNum = empty($_SESSION["userNum"]) ? '' : $_SESSION["userNum"];
?>

<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="utf-8">
	<title>캠퍼스 마켓</title>
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/index.css">
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/item.css">
	<script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
	<script type="text/javascript" src="/campusmarket/js/login.js"></script>
	<script type="text/javascript" src="/campusmarket/js/write.js"></script>
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


		<?php
        $bid = empty($_REQUEST["bid"]) ? "object" : $_REQUEST["bid"];

		$object_num = empty($_REQUEST["object_num"]) ? '' : $_REQUEST["object_num"];

		$img_find_count = $db->query("select count(*) from file as F, board_object as B where F.f_num = B.object_num and B.object_num = $object_num");
		$slide_img_find_count = $db->query("select count(*) from file as F, board_object as B where F.f_num = B.object_num and B.object_num = $object_num");
 							  
        $query = $db->query("select * from board_object b INNER JOIN member m ON b.member_num = m.member_num where b.object_num=$object_num");
		$dips=$db->query("select count(*) from  dips where member_num='$_SESSION[userNum]' and object_num=$object_num  ")->fetchColumn();
		$db->exec("update board_$bid set hits=hits+1 where object_num=$object_num"); 
        if ($row = $query->fetch()) {

	        $object_name = str_replace(" ", "&nbsp;", $row["object_name"]);
	        $object_contents = str_replace(" ", "&nbsp;", $row["object_contents"]);
	        $object_contents = str_replace("\n", "<br>", $object_contents);
			$member_num=$row["member_num"];
        ?>



		<script>
			function move(type, check) {

				if (check == 'box1') {
					var check = '.imglist';
				}

				var jbWidth1 = $('div.imglist').width();

				var tab = document.querySelector(check)
				var marginLeft = window.getComputedStyle(tab).getPropertyValue('margin-left');
				marginLeft = parseInt(marginLeft);
				console.log(marginLeft);
				if (type === 'right' && marginLeft != -jbWidth1 + 346) {
					var a = marginLeft - 346;
					document.querySelector(check).style.marginLeft = a + 'px';
					document.querySelector(check).style.transition = `${0.1}s ease-out`;

				} else if (type === 'left' && marginLeft != 0) {
					var a = marginLeft + 346;
					document.querySelector(check).style.marginLeft = a + 'px';
					document.querySelector(check).style.transition = `${0.1}s ease-out`;
				}
			}
		</script>




		<div id="main" style="padding-bottom: 88px;">
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
	        $share = empty($_REQUEST["share"]) ? 3 : $_REQUEST["share"];


	        $numLines = 20; // 리스트 한 페이지에 나올 행의 수 (글의 수)
        	$numLinks = 3; // 한 페이지에 표시할 페이지 링크 갯수
        
	        $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
	        $start = ($page - 1) * $numLines;

	        $category = empty($_REQUEST["category"]) ? "" : $_REQUEST["category"];
	        switch ($category) {
		        case 1:
			        $category = '전공서적';
			        break;
		        case 2:
			        $category = '실습도구';
			        break;
		        case 3:
			        $category = '방';
			        break;
		        case 4:
			        $category = '기타';
			        break;
		        case 5:
			        $category = '생활용품';
			        break;
	        }
                ?>

				<div class="view-box">
				<div class="<?php if ($row["sale_status"] == 1) {
		    echo 'overview';
	    }?>  ">


<?php if ($row["sale_status"] == 1) { ?>
<p class="overwrite" style="font-size: 17px;line-height: 21px;padding: 20px;width: 246px; top:20%;">거래 완료된 게시글 입니다.<br><br>

<button class="overbtn"onClick="location.href='/campusmarket/itemlist.php'">목록으로</button>
</p>
<?php
	}?>
</div>
					<div style="padding: 74px">
						<div class="content-box">
		<div class="jb-a">

<div class="img-box">
	<img onclick='move("left","box1")' style="left:18px; width:50px; height:50px;" class="jb-c"
		src="image/left.png">
	<img onclick='move("right","box1")' style="right:18px; width:50px; height:50px;" class="jb-c"
		src="image/right.png">
		 
		<div class="imglist">
			<?php
					$file_count = 0;
						$img_num = $img_find_count->fetch();
							if ($img_num[0] == 0 && $file_count == 0){
									$file_src = "./image/null.png";
									?>
	               					<img style="width:346px; height:346px;" src="<?=$file_src?>">
	 								<?php
							} else {
								$img_find = $db->query("select * from file as F, board_object as B where F.f_num = B.object_num and B.object_num = $object_num");
								while ($img_one = $img_find->fetch()) { //이미지
									$file_src = "./files/".$img_one['fm_num']."/".$img_one['f_img']."";
									$file_count++;
									?>
		               					<img style="width:346px; height:346px;" src="<?=$file_src?>">
	 								<?php
								}
							}
							 ?>
							 </div>
							 	</div>
          </div>
		 
       



							<?php
	        if ($row["object_category"] == "방" && $row["share"] == '판매') {
				$row["object_category"]="원룸/방 빼요";
		        $cart_sall = '빼요';
		        $heman = "보증금&nbsp;";
	        } else if ($row["object_category"] == "방" && $row["share"] == '구매') {
				$row["object_category"]="원룸/방 구해요";
		        $cart_sall = '구해요';
		        $heman = "보증금&nbsp;";
	        } else if ($row["share"] == '판매') {
		        $cart_sall = '판매';
	        } else if ($row["share"] == '구매') {
		        $cart_sall = '구매';
		        $heman = "희망가&nbsp;";
	        } else if ($row["share"] == '나눔') {
		        $cart_sall = '나눔';
	        }
                            ?>
							<div class="text-box">
								<p>
								<span>
									<?= $row["object_category"] ?>
								</span>
								<span style="float: right;">
										게시글번호&nbsp;<?= $row["object_num"] ?>
									</span>
								</p>
								<h1><span><?= $cart_sall ?></span> &nbsp; <span style="font-family: 'Gothic A1';
font-style: normal;
font-weight: 400;
font-size: 23px;
line-height: 29px;">
<?=$object_name?></span>
								</h1>
								<h1>
									<?= $heman ?>
										<?= $row["price"] ?>원
								</h1>
								<hr>
								</hr>
								<p>소속대학&nbsp; 신구대학교</p>
								<p style="display: flex;align-items: center;">판매자&nbsp;&nbsp; <span><img style="width: 33px;height: 33px;background: #D9D9D9; border-radius: 50%;" src="user_img/<?=$row['member_img']?>"></span>
								&nbsp;<?= $member_num=$row["nickname"]?></p>

								<div style="justify-content: center;display: flex;align-items: center;">
							
								<?php
								if($member_num!=$userName){
	        if ($_SESSION["userId"] != "") {
				
                                ?>
								<button class="chat" style="margin-left: 55px;"
									onClick="location.href='/campusmarket/chat/chatroom_insert.php?object_num=<?= $row['object_num'] ?>&member_num=<?= $row['member_num'] ?>'"><img src="/campusmarket/image/chatimg.png"/>작성자와 채팅하기 </button>
								<?php
	        } else {

                                ?>	
								<button class="chat" style="margin-left: 55px;"
									onClick="location.href='/campusmarket/member/login_main.php'"><img src="/campusmarket/image/chatimg.png"/>작성자와 채팅하기 </button>
								
								<?php
								}
							
								?>
									
									
									<span class="like" style="margin-left: 24px;">
									
									<?php
if(	$_SESSION["userId"]!=""){
	if($dips>0){
	?>
	<img class="dips_yes" src="image/dips_yes.png"onclick="location.href='join_dips.php?object_num=<?= $object_num?>';">
    <?php
	}else{
		?>
		 	<img class="dips_yes" src="image/dips_no.png"onclick="location.href='join_dips.php?object_num=<?= $object_num?>';">
  
<?php
	}
}
								}
?></span>
</div>
							</div>
						</div>
						<div class="alam-box">
							타인에게 개인정보를 알려주지 마세요. 캠퍼스마켓은 이로인한 책임을 지지 않습니다.<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam, purus sit amet luctus
							venenatis, lectus magna<br>
							Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam

						</div>
						<div class="explanation-box">
							<?= $object_contents ?>
						</div>

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


						<div style="justify-content: space-between; display: flex; align-items: center;">
						
						<img src="image/clickup.png" style="visibility: hidden;">

						<?php
						if($member_num!=$userName){
	        if ($_SESSION["userId"] != "") {
                                ?>
								<button class="chat" 
									onClick="location.href='/campusmarket/chat/chatroom_insert.php?object_num=<?= $row['object_num'] ?>&member_num=<?= $row['member_num'] ?>'"><img src="/campusmarket/image/chatimg.png"/>작성자와 채팅하기 </button>
								<?php
	        } else {

                                ?>	
								<button class="chat" 
									onClick="location.href='/campusmarket/member/login_main.php'"><img src="/campusmarket/image/chatimg.png"/>작성자와 채팅하기 </button>
								
								<?php
	        }
						}
								?>



									<a href="javascript:doDisplay();"><img src="image/clickup.png"></a> 
									</div>
									<div style=" text-align: center; z-index: 3; position:absolute;margin-left: 650px;" >
					<div style="display: none;background: white; text-align: right; box-shadow: 0px 0px 5px rgb(0 0 0 / 20%); border-radius: 5px; padding: 9px 14px;" id="myDIV">
						<ul style="text-align: center;">
					<!--글 작성자일 경우에만-->
				
				
										<?php
									
							if($userName==$member_num){
						?>
						  <li ><a href='write3.php?object_num=<?=$row["object_num"]?>&share=<?=$row["share"]?>&object_category=<?=$row["object_category"]?>'>수정</a></li>      
                        <li style="padding-top: 8px;"><input type="button" class ="deletebtn" value="삭제" onclick='board_delete_click(<?=$row["object_num"]?>)'></li>   
					<li><a href='sale_status.php?object_num=<?=$row["object_num"]?>&share=<?=$row["share"]?>&object_category=<?=$row["object_category"]?>'>거래완료로 변경</a></li>      
                        
						 
                      
		
			<?php
							}else{
								?>
								 <li><a href="report_write.php?bid=reports&object_num=<?=$object_num?>&member_num=<?= $member_num?>">신고</a>  </li>     
                       
							
								<?php
							}
			?>
</div>
						</ul>
					</div>			
						
						</div>
					</div>
				</div>


			</div>

		</div>

		

		<?php
        }
        ?>
		<div class="foter">
			<h3>캠퍼스 마켓</h3>
			<p>사업자 등록번호: 2018-132019 | 대표: 김세혁</p>
			<p>경기도 성남시 중원구 광명로 377 신구대학교 산학관 111호</p>
			<p>고객센터: 031-740-1114</p>
		</div>
	</div>

</body>

</html>

