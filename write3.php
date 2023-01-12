<?php

 session_start();
 require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

    $bid = empty($_REQUEST["bid"]) ? "object" : $_REQUEST["bid"];

    $object_name = "";
    $writer = "";
    $object_contents = "";
	  $price ="";
	  $object_category= $_REQUEST['object_category'];
    $share = $_REQUEST["share"];
	
    $action = "item_insert.php?bid=$bid";
	
	$object_img  = "";
	
	//$member_num  = "";
	//$sale_status = "";

    $object_num = empty($_REQUEST["object_num"]) ? null : $_REQUEST["object_num"];    
  
    
    if ($object_num) {    // 글 번호가 주어졌으면
        require("db_connect.php");
        $query = $db->query("select * from board_$bid where object_num=$object_num");
        
        if ($row = $query->fetch()) {
            $object_name = $row["object_name"];
            //$writer = $row["writer"];
			$object_category = $row["object_category"];
			$price = $row["price"];
      $share = $row["share"];
            $object_contents = $row["object_contents"];
			
			$object_img  = $row["object_img "];
		
			$member_num  = $row["member_num "];
		
            $action = "item_update.php?bid=$bid&object_num=$object_num";
        }
    }
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
	<meta charset="utf-8">
	<title>캠퍼스 마켓</title>
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
  <link rel="stylesheet" type="text/css" href="/campusmarket/css/item2.css">

  <script src="/campusmarket/js/write.js"></script>
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
					<div class="bar2" style="width:70%"> </div>
				</div>
				<div class="bar-text" >자세한 정보를 입력하여 게시하세요.</div>
			
  				
          <!--판매글 입력하는 곳-->
  				<form action="<?=$action?>" class="item_form" method="post" enctype="multipart/form-data" style="padding: 0px 74px 0px 74px;">
          <input type="text" value="<?=$object_num?>" name="num" style="visibility : hidden; display : none;">
     
					<ul>
						<li id="file_li">
							<div class="img_wrap"><label for="file_upload"><img id="file_img" src="./image/file_img.png"></label><input type="file" id="file_upload" name="img_upload[]" multiple onchange="fileUploadCheck(this.value);"></div>
              <span class="upload_fileList">
                <?php
                  $img_count = 0;
                  if ($object_num != 0) {
                    ?>
                    <?php
                    $img_query = $db->query("select * from board_object as B, file as F where B.object_num = F.f_num and B.object_num = $object_num");
                    while ($row = $img_query->fetch()){
                      $file_src = "./files/".$row['fm_num']."/".$row['f_img']."";
                      ?>
                      <span class="img_file" id="<?=$img_count?>">
                        <img src="<?=$file_src?>" name="imgs">
                        <input type="text" value="<?=$row['f_img']?>" name="uploded_img[]" style="visibility : hidden; display : none;">
                        <input type="text" value="<?=$row['tmp_name']?>" name="uploded_img_tmp[]" style="visibility : hidden; display : none;">
                        <a href="#" id="removeImg" onclick="UpdateDeleteImg(<?=$img_count?>)">╳</a>
                      </span>
                    <?php
                      $img_count++;
                    }
                  }
                 ?>
              </span>
              <span class="fileList">
              </span>
						</li>

						
						<li>
							<div class=""><input class="item_text" type="text"  maxlength = "30" name="object_name" value="<?=$object_name?>"
							placeholder="제목" onfocus="this.placeholder=''" onblur="this.placeholder='제목'"></div>
							
						</li>
	
						<li>
							<div class="">	<input style="width:70%;"class="item_text" id="price" type="text" name="price" 
							placeholder="가격" onfocus="this.placeholder=''" onblur="this.placeholder='가격'"/><span id="price_unit">

              <label> <input type='checkbox' id='my_checkbox' onclick='toggleTextbox(this)'/> 나눔 </label>
           
<?php 
$money=0;
?>
<script>

function toggleTextbox(checkbox) {
  
  // 1. 텍스트 박스 element 찾기
  const textbox_elem = document.getElementById('price');
  
  // 2-1. 체크박스 선택여부 체크
  // 2-2. 체크박스 선택여부에 따라 텍스트박스 활성화/비활성화
  textbox_elem.check = checkbox.checked ?  true : false;
  
  // 3. 텍스트박스 활성화/비활성화 여부에 따라
  // - 텍스트박스가 비활성화 된 경우 : 텍스트박스 초기화
  // - 텍스트박스가 활성화 된 경우 : 포커스 이동
  if(textbox_elem.check) {
    textbox_elem.value ="<?=$money?>";
    textbox_elem.readOnly=true;
    
  }else {
    //textbox_elem.focus();
    textbox_elem.readOnly=false;
    textbox_elem.value="<?=$price?>";
  }
}

</script>


</div>
						
						</li>
						<li id="explain_li">
							<textarea class="explain_write" type="text" name="object_contents" rows="10"
								placeholder="게시글 내용 작성"
								onfocus="this.placeholder=''"
								onblur="this.placeholder='게시글 내용 작성'"><?=$object_contents?></textarea>
						</li>
					</ul>
					
					<input type = "hidden" name = "object_category" name="object_category" value ="<?=$object_category?>" />
					<input type = "hidden" name = "share" name="share" value ="<?=$share?>" />
					
					<!--버튼-->
					<div class="board_btns">
						<button type="button" onClick="history.back()">이전</button>
						<input type="submit" value="작성완료">
					</div>
				</form> <!--join_form END-->
  		
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
