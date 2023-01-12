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
						<?php if ($userName=="admin")
							{
						?>
						<li><a onclick="location.href='/campusmarket/admin/list.php'">관리자페이지</a></li>
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
		<div class="center-box" style="padding-top: 40px; padding-bottom: 96px;">
	<h1>학생공간</h1>
		
		<div class="st_write">
	
		
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

		
<?php
    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];
    $board_num = $_REQUEST["board_num"];
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];    
    
    require("db_connect.php");
	
    $query = $db->query("select * from board_$bid b INNER JOIN member m ON b.member_num = m.member_num where b.board_num=$board_num");
    if ($row = $query->fetch()) {
        $db->exec("update board_$bid set hits=hits+1 where board_num=$board_num"); 
        
        $board_title   = str_replace(" ", "&nbsp;", $row["board_title"  ]);
        $board_contents = str_replace(" ", "&nbsp;", $row["board_contents"]);
        $board_contents = str_replace("\n", "<br>", $board_contents);
		$member_num=$row["member_num"];
?>		
      
	  <span>게시글번호&nbsp;<?= $row["board_num"] ?></span>
        <div class="aaa">[<?= $row["board_category"] ?>]&nbsp;<?=$board_title?></div>

		<div style="display: flex; align-items: center; justify-content: space-between;">
		  <div style="display: flex; align-items: center;" >
		  <img style="width: 33px;height: 33px;background: #D9D9D9; border-radius: 50%;" src="user_img/<?=$row['member_img']?>">
		  <span style="margin-left: 10px;"> 
		  <div style="font-weight: 600; line-height: 16px;"><?= $member_num=$row["nickname"]?></div>
		  <div><?=$row["write_date"]?></div>
		</span>
			</div>
			<a href="javascript:doDisplay();"><img src="image/clickup.png"></a> 
		</div>
	

	<div style=" text-align: center; z-index: 3; position:absolute;margin-left: 655px;" >
		<div style="display: none;background: white; text-align: right; box-shadow: 0px 0px 5px rgb(0 0 0 / 20%); border-radius: 5px; padding: 9px 14px;" id="myDIV">
		

			<ul>
			<!--글 작성자일 경우에만-->
				<?php 
					if($userName==$member_num){
				?>
				<li ><a href='board_write.php?bid=<?=$bid?>&board_num=<?=$board_num?>&page=<?=$page?>'>수정</a></li>      
                <li style="padding-top: 8px;"><a href="board_delete.php?bid=<?=$bid?>&board_num=<?=$board_num?>&page=<?=$page?>">삭제</a></li>
			<?php
					}else{
			?>
				<li><a href="report_write.php?bid=reports&board_num=<?=$board_num?>&member_num=<?= $member_num?>">신고</a>  </li>     
            <?php
					}
			?>

			</ul>
		
			</div>	
	</div>

    <hr style="margin-bottom:34px"></hr>
	<div style="height: 500px;">
		<?=$board_contents?>	
	</div> 
	<?php    
		}
	?>    
		

<hr style="margin-bottom:34px"></hr>


<!-------------------------댓글 추가--------------------------------------------------->
<?php 
$pougodd=empty($_REQUEST["pougodd"]) ? "asc" : $_REQUEST["pougodd"];
$review_count=$db->query("SELECT count(*) from board_student_reply where board_num=$board_num")->fetchColumn();

?>

<div style="display: flex;align-items: center;">
	<div class="sinup"><div style="font-weight: 600;font-size: 17px; line-height: 21px;color: #000000;">댓글&nbsp;<?=$review_count?>개</div></div>
	<div style="margin-left: 27px; font-weight: 600;font-size: 13px; color: <?php if($pougodd=='asc'){echo'#000000';} else{echo'#A8A8A8';}?>;" id="pop" onclick="location.href='board_view.php?board_num=<?=$board_num?>&pougodd=asc#pop';">등록순</div>
	<div style="margin-left: 11px; font-weight: 600;font-size: 13px; color: <?php if($pougodd=='desc'){echo'#000000';} else{echo'#A8A8A8';}?>;" id="new" onclick="location.href='board_view.php?board_num=<?=$board_num?>&pougodd=desc#new';">최신순</div>
</div>
    

<div style="margin-top:39px;">
     <?php

	$numLines= 10;
	$numLinke= 5;

	$page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
	$stat = ($page -1) * $numLines;

	$count=0;

$query4 = $db->query("select * from board_student_reply AS sr, member AS mb WHERE sr.member_num=mb.member_num and board_num='$board_num' order by sr.write_date $pougodd LIMIT $stat , $numLines");
while ($row = $query4->fetch()) {
		$content = str_replace(" ", "&nbsp;", $row['reply_contents']);
		$row['reply_contents'] = str_replace("\n", "<br>", $content);
	$count=$count+1;
	    //if ($_SESSION["userId"] != "") {
     ?>
            <div class="other_review" style="display:flex; justify-content: space-between;">
			<div>
				<div class="nickname"><?= $row['nickname'] ?></div>
				<div class="review"><?= $row['reply_contents'] ?></div>
                <p class="date"><?= $row['write_date'] ?></p>
			</div>
			

			<script>
				var member_num = "<? echo $row["member_num"];?>";
	function doDisplay2(member_num) {
						
                        var con = document.getElementById("myDIV"+member_num);
					
                        if (con.style.display == 'none') {
                            con.style.display = 'block';
                        } else {
                            con.style.display = 'none';
                        }
					}
  </script>
  <div style="float: right;">
				<a href="javascript:doDisplay2(<?= $row["member_num"] ?>);"><img src="image/clickup.png"></a>
				
				<div style=" text-align: center; z-index: 3; position:absolute;" >
					<div style="display: none;background: white; text-align: right; box-shadow: 0px 0px 5px rgb(0 0 0 / 20%); border-radius: 5px; padding: 9px 14px;" id="myDIV<?= $row["member_num"] ?>">
					
					<ul>
					<!--글 작성자일 경우에만-->
						<?php
		     if ($userName == $row['nickname']) {
                        ?>
							<li ><a href='board_view.php?board_num=<?= $board_num ?>&re=re'>수정</a></li>      
                        	<li style="padding-top: 8px;"><a href="review_del.php?board_num=<?= $board_num ?>">삭제</a>  </li>
						<?php
		     } else {
                        ?>
							<li><a href="report_write.php?bid=reports&board_num=<?= $board_num ?>&member_num=<?= $row['nickname'] ?>&report_title=댓글신고">신고</a>  </li>     
                       <?php
		     }
                       ?>

						</ul>
						</div>
						</div>
						</div>
					</div>	<!--</div>-->
					<hr style="margin-bottom:34px"></hr>
            <?php
	   //  }
}
?>
		
 <?php
	$firstLink = floor(($page - 1)/$numLinke)*$numLinke+1;
	$lastLink = $firstLink + $numLinke -1;

	$numRecords = $db->query("select count(*) from board_student_reply where board_num='$board_num'")->fetchColumn();
	$numPage = ceil($numRecords / $numLines);

	if($lastLink  >$numPage){
	   $lastLink = $numPage;
	}//올림은 ceil

?>
<div class="page_num" style="text-align: center;">
            <?php
		if($firstLink>1){
?>
            <a class="nones" href="board_view.php?board_num=<?=$board_num?>&page=<?= $firstLink -1 ?>"> 이전 </a>
            <?php
	 }

		for ($i=$firstLink; $i <= $lastLink; $i++){
?>
            <a class="nones" href="board_view.php?board_num=<?=$board_num?>&page=<?=$i?>"> <?=($i == $page) ? "<u>$i</u>" : $i?> </a>
            <?php
		}

		if($lastLink<$numPage){
?>
            <a class="nones" style='margin:0;' href="board_view.php?board_num=<?=$board_num?>&page=<?=$lastLink +1?>"> 다음 </a>
            <?php
		}
?>

</div>


<div style="margin-top:100px;"></div>
		<?php
#로그인시 작성글이 없을시
	$_SESSION["userNum"] = empty($_SESSION["userNum"]) ? " " : $_SESSION["userNum"];
	
	if($_SESSION["userNum"]==" "){	

	?>
	<div onclick="location.href='member/login_main.php';" style="margin-top:40px;     cursor: pointer;color: grey;padding:40px 0 0 20px;" id="text_crear" class="text_review" name="textreview" value="" readonly>작품의 감상평을 작성하려면 <b>로그인</b> 해주세요</div>
<div style="height:40px;"></div> 
<?php
	}
	$myreiview=$db->query("select count(*) from board_student_reply where member_num='$_SESSION[userNum]' and board_num='$board_num'")->fetchColumn();
	
	if(!$myreiview and $_SESSION["userNum"]!= " "){
?>
        <form class="" action="review_star.php" method="post">
	  	<input name="board_num" type="hidden" value="<?=$board_num?>">
            <textarea id="text_crear" class="text_review" placeholder="댓글을 입력하세요." name="textreview" value=""></textarea>

           <!-- <input id="A" type="button" class="noi" value="취소" />-->
		   <div style="float: right;margin-right: 64px;">
            <button class="yesi">등록</button>
	</div>
        </form>
        <?php
	}else{
		#로그인시 작성글이 있을시
$query3 = $db->query("select * from board_student_reply AS sr, member AS mb WHERE sr.member_num=mb.member_num and mb.member_num='$_SESSION[userNum]' and sr.board_num='$board_num'");

while ($row = $query3->fetch()) {
$content = str_replace(" ", "&nbsp;", $row['reply_contents']);
$content = str_replace("\n", "<br>", $content);
$re = empty($_REQUEST["re"]) ? "" : $_REQUEST["re"];
	if($re==""){
?>
        <?php
			}else{
		#수정 페이지
			?>      
		<form class="" action="review_star.php" method="post">
	  	<input name="board_num" type="hidden" value="<?=$board_num?>">
      
            <textarea id="text_crear" class="text_review" placeholder="댓글을 입력하세요." name="textreview" value=""><?=$row['reply_contents']?></textarea>

            <!--<input onclick="history.back()"type="button" class="noi" value="취소" />-->
			<div style="float: right;margin-right: 64px;">
            	<button class="yesi">등록</button>
			</div>
        </form>

 <?php
	}
}
	}
?>
  			</div>
		</div><!-----------------------st_write end-------------------------------------->
	</div><!--centerbox-->
</div><!--main-->

	<div class="foter">
			<h3>캠퍼스 마켓</h3>
			<p>사업자 등록번호: 2018-132019 | 대표: 김세혁</p>
			<p>경기도 성남시 중원구 광명로 377 신구대학교 산학관 111호</p>
			<p>고객센터: 031-740-1114</p>
		</div>

</div><!--web-->
</body>
</html>

