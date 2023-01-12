<?php
 session_start();
 require("db_connect.php");
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
	$chattingA =$db->query("select count(*) from chatroom where seller_num='$_SESSION[userNum]' ")->fetchColumn();
	$chattingB =$db->query("select count(*) from chatroom where buyer_num='$_SESSION[userNum]' ")->fetchColumn();
	$chattingC=$chattingA+$chattingB;
	$objectC=$db->query("select count(*) from board_object where member_num='$_SESSION[userNum]'  ")->fetchColumn();
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




<style>
.profile-box{
	box-sizing: border-box;

margin-top:61px;

height: 602px;
padding:77px;

background: #FFFFFF;
border: 1px solid rgba(0, 0, 0, 0.2);
border-radius: 15px;
}

#check-btn { display: none; }
#check-btn:checked ~ .menubars { display: block; } 
.menubars { display: none; }

.profile{
	box-sizing: border-box;

width: 198px;
height: 192px;
float:left;
border: 1px solid rgba(0, 0, 0, 0.2);
border-radius: 7px;
}



#dropdown a {										

    text-decoration: none;
    
    font-family: 'Gothic A1';
    font-style: normal;
    font-weight: 700;
    font-size: 17px;
    line-height: 21px;
    color: #FFFFFF;
}


/*가로메뉴형*/

#menu {

height: 50px;

}



.main1 {

width: 600px;

height: 100%;

margin: 0 auto;

}



.main1>li {

float: left;

line-height: 50px;

text-align: center;

position: relative;

}



.main1>li:hover .main2 {

left: 0;

}





.main1>li a:hover {



color: #fff;

font-weight: bold;

}



.main2 {

position: absolute;

top: 50px;

left: -9999px;

background: #69B3FF;
border-radius: 4px;

width: 100%;
font-family: 'Gothic A1';
font-style: normal;
font-weight: 700;
font-size: 17px;
line-height: 21px;

color: #FFFFFF;

}



.main2>li {

position: relative;
padding: 13px;
text-align: center;
}



.main2>li:hover .main3 {

left: 100%;

}



.main2>li a, .main3>li a {

border-radius: 10px;

}



.main3 {

position: absolute;

top: 0;

background: #6BD089;

width: 80%;

left: -9999px;

/*left: 100%;*/

/*display: none;*/

}



.main3>li a:hover {

background: #085820;

color: #fff;

}

.btnsty{
margin:15px;
width: 118px;

background: #007FFF;
border-radius: 4px;
font-family: 'Gothic A1';
font-style: normal;
font-weight: 700;
font-size: 17px;
line-height: 21px;

color: #FFFFFF;

}

.btn-upload {
    width: 96px;
    height: 28px;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #FFFFFF;
    border: 1px solid #A6A6A6;
    border-radius: 14px;
	font-family: 'Gothic A1';
font-style: normal;
font-weight: 400;
font-size: 13px;
line-height: 16px;

color: #000000;

}

#file {
  display: none;
}

.usernick{
	margin: 0 auto;
    font-family: 'Gothic A1';
    font-style: normal;
    font-weight: 700;
    font-size: 43px;
    line-height: 54px;
    color: #000000;
}
p{
font-family: 'Gothic A1';
font-style: normal;
font-weight: 400;
font-size: 13px;
line-height: 16px;

color: #000000;
}
</style>


<script>
$(document).ready(function(){
  var fileTarget = $('.filebox .upload-hidden');

    fileTarget.on('change', function(){
        if(window.FileReader){
            var filename = $(this)[0].files[0].name;
        } else {
            var filename = $(this).val().split('/').pop().split('\\').pop();
        }

        $(this).siblings('.upload-name').val(filename);
    });
}); 


function doDisplay() {
                        var con = document.getElementById("myDIV");
						
                        if (con.style.visibility == 'hidden') {
                            con.style.visibility = 'inherit';
                        } else {
                            con.style.visibility = 'hidden';
                        }

					
                    }
function doDisplay2() {
						var con2 = document.getElementById("myDIV2");
						if (con2.style.visibility == 'hidden') {
                            con2.style.visibility = 'inherit';
                        } else {
                            con2.style.visibility = 'hidden';
                        }
                    }

  </script>	 
	 
	 
	 


		<div id="main">
			<div class="center-box" style="padding-top: 48px;">
			
				<div class="profile-box">
				<div style="height: 200px;display: flex;">
				<div><img class="profile" src="user_img/<?= $iset?>"/></div>
	<div style="margin-left: 98px;">
				<h1 class="usernick"><?=$_SESSION["userName"]?></h1>
				<p><?=$_SESSION["userId"]?></p>
			
				<p style="margin-top:34px">활성화된 채팅 <?=$chattingC?> </p>
				<p>거래를 위해 내놓은 물건 <?=$objectC?></p>
			</div>
				</div>

			<div style="display:flex; justify-content: space-between; margin-top: 10px;">
			<div style="visibility: hidden; " id="myDIV">
			<form name='tmp_name' method="post" action="img_plus.php" enctype="multipart/form-data">
	 
	 <div class="filebox" style="display: flex;">
	
	 <label for="file">
	 
	 <div class="btn-upload">이미지 변경</div>
	 
</label>

<input type="file"name="imgFile" id="file"class="upload-hidden">
<!--<input class="upload-name" value="" placeholder="첨부파일" >-->
    
	<button style="margin-left: 20px; " class="submit" type="submit">저장</button>
	</div> 
	 </form>
				</div>
	 <div style="visibility: hidden;" id="myDIV2">
	 <form class="newnick" action="new_nick.php" method="post">
	 <div style="display: flex;">
	 <div class="btn-upload">닉네임 변경</div>


	 
<input style="margin-left: 20px;" class="pw_boxs"name="new_nick"  id="new_nick" type="id" placeholder="변경할 닉네임을 입력하세요." >

<button class="infores" name="submit">수정</button>
</div>

  </form>
  </div>
</div>

			
				<div id="dropdown">
    <!--가로형 3단 드롭다운 메뉴-->

<div id="menu" style="margin-top: 73px;">


	 

<ul class="main1">

	<li class="btnsty"><a href="#">프로필 수정</a>

		<ul class="main2">

			<li><a href="javascript:doDisplay2();">닉네임 변경</a></li>

			<li><a href="javascript:doDisplay();">이미지 변경</a></li>

		</ul>

	</li>


	<li class="btnsty"><a href="#">물건 목록</a>

		<ul class="main2">

			<li><a href="/campusmarket/mysell.php">판매 목록</a></li>
			<li><a href="/campusmarket/mybuy.php">구매 목록</a></li>
			<li><a href="/campusmarket/mydips.php">찜 목록</a></li>

		</ul>

	</li>

	<li class="btnsty"><a href="/campusmarket/report_list.php">신고 현황</a></li>

		

	<li class="btnsty"><a href="chattingCheck('<?=$userId?>')">채팅으로</a></li>

	

</ul>

</div>
				
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