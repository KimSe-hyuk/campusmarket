
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
        <link rel="stylesheet" type="text/css" href="/campusmarket/css/chat.css">
        <script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
        <script type="text/javascript" src="/campusmarket/js/login.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
		
					<form class="search-box" action="/campusmarket/search_result.php" method="get">
						<input id="searchInput" name="search" type="text" placeholder="검색" size="10"
							required="required">
						<input class="Vector" name="button" type="image" src="/campusmarket/image/Vector.png">
					</form>


					

					
				</div>

			</div>
		</header>
        </div>
        <div id="main">
            <div class="center-box">
                <div style="border: 1px solid rgba(0, 0, 0, 0.1);">
                    <div class="chatlistbox">
                        <div style="border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                            <h1 class="Whrwl">쪽지함</h1>
                        </div>
                        <div class="chatlist" style="overflow-y: scroll;">
                        <?php

$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
   $userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
   
   	$query3 = $db->query("select * from member where email = '$_SESSION[userId]'");
 #채팅방 리스트
	while ($row = $query3->fetch()) {
		$selfnum= $row['member_num'];
	}
$query3 = $db->query("
SELECT CR.*, M.nickname , OB.object_name ,M.member_img,F.*  FROM (chatroom AS CR LEFT JOIN member AS M ON ((CR.buyer_num = M.member_num or CR.seller_num = M.member_num)AND  M.member_num !=$selfnum 
) LEFT JOIN board_object AS OB on CR.object_num = OB.object_num left join file F on OB.object_num=F.f_num)
where CR.buyer_num=$selfnum or CR.seller_num=$selfnum  GROUP by object_num  
");  
 


	while ($row = $query3->fetch()) {
 
				$file_src = "../files/".$row['fm_num']."/".$row['f_img']."";
			  
			  
			 if($file_src=="../files//"){
			 $file_src = '../image/null.png';
			 }
?>  
                            <ul onclick="location.href='chat.php?id=<?=$row['chatroom_id']?>';" style="background:<?=$_REQUEST["id"] != $row['chatroom_id'] ? $colors = "white" : $colors = "#F2F3F5";?>;  cursor: pointer;display: flex;align-items: center;justify-content: space-between;padding: 22px 10px; border-bottom: 1px solid rgba(0, 0, 0, 0.1);">
                                <img class="chat_pro_img" src="/campusmarket/user_img/<?= $row['member_img']?>">
                                <div >
                                    <li><?=$row['nickname']?></li>
                                    <li><?= mb_substr($row["object_name"], 0, 10, 'utf-8'); ?>
                                    </li>
                                </div>
                                <img class="chat_pro_img" src="<?=$file_src?>">
                            </ul>
                        <?php
	}
	$query3 = $db->query("
    SELECT CR.*, M.nickname , OB.object_name  FROM (chatroom AS CR LEFT JOIN member AS M ON (CR.buyer_num = M.member_num or CR.seller_num = M.member_num)AND  M.member_num !=$selfnum
    ) LEFT JOIN board_object AS OB on CR.object_num = OB.object_num 
    where CR.buyer_num=$selfnum or CR.seller_num=$selfnum  GROUP by  CR.object_num limit 1
");  
 
	while ($row = $query3->fetch()) {
	$id = empty( $_REQUEST["id"]) ?  $row['chatroom_id'] : $_REQUEST["id"];
	}
	?>
                    </div>
                </div>
                <!--chatlist-->
                <input type="hidden" name="chatcss_javacript" id="name" value="<?= $_SESSION["userName"]?>">
                <script>
                    var value = document.getElementById('name').value;
                    var lastReceviedChatMessageId = 0;
                    var css = "";
                    function loadNewMessages() {
                        $.get("getNewMessages.php", {
                            chatRoomId: chatRoomId,
                            from: lastReceviedChatMessageId
                        }, function (data) {
                            for (var i = 0; i < data.messages.length; i++) {
                                drawMessage(data.messages[i]);
                                lastReceviedChatMessageId = data.messages[i].id;
                            }
                            setTimeout(function () {
                                loadNewMessages();
                            }, 1000);
                        }, 'json');
                    }
                    function drawMessage(message) {
                        var html = '';
                        if (value == message.nickname) {
                            css = "right";
                            lr = "lt";
                        } else {
                            css = "left";
                            lr = "rt";
                        }
                        if (message.regDate.substr(11, 2) < 12) {
                            a = "오전 ";
                            h = message.regDate.substr(11, 2);
                        } else {
                            a = "오후 ";
                            h = message.regDate.substr(11, 2) - 12;
                        }
                        if(css=="left"){
                                  html += '<img  style="width: 40px;height: 40px;border-radius: 5px;float: left;"src= "/campusmarket/user_img/'+message.member_img+'"></img>';
                    
                        }
                        
                      
                        html += '<p style="margin: 0;overflow: hidden;">' + message.body + '</p>';
                        html += '<p   class=' + lr + '>' + a + h + ":" + message.regDate.substr(14, 2) + '</p>';
                        html = $('<div>' + html + '</div>').addClass(css);
                        $('.chat-messages-body').append(html);
                        $('.chattingbox').scrollTop($('.chattingbox')[0].scrollHeight);
                    }
                    $(function () {
                        loadNewMessages();
                    });
                    function submitWriteMessageForm(form) {
                      
                        form.body.value = form
                            .body
                            .value
                            .trim();
                        if (form
                                .body
                                .value
                                .length == 0) {
                            alert('채팅을 입력해주세요.');
                            form.body.focus();
                            return false;
                        }
                        $
                            .post('doWriteMessage.php', {
                                chatRoomId: chatRoomId,
                                body: form.body.value
                            }, function (data) {}, 'json')
                            form
                            .body
                            .value = '';
                        form.body.focus();

                        
                    }
                </script>
                <div class="chatbox">
                    <div style="display: flex;align-items: center;justify-content: space-between;">
                    <div style="    display: flex; align-items: center;">
                    <?php

$query3 = $db->query("
SELECT CR.*, M.nickname , OB.object_name ,M.member_img,F.*  FROM (chatroom AS CR LEFT JOIN member AS M ON ((CR.buyer_num = M.member_num or CR.seller_num = M.member_num)AND  M.member_num !=$selfnum 
) LEFT JOIN board_object AS OB on CR.object_num = OB.object_num left join file F on OB.object_num=F.f_num)
WHERE CR.chatroom_id = {$id}
");
#채팅방 상단 바
	while ($row = $query3->fetch()) {

 
			
				$file_src = "../files/".$row['fm_num']."/".$row['f_img']."";
			   if($file_src=="../files//"){
			 $file_src = '../image/null.png';
			 }

//$titleText = "채팅방";

?>
                        <img class="chat_pro_img" style="padding: 22px 24px 21px 35px;" src="/campusmarket/user_img/<?= $row['member_img']?>">
                        <h1 class="chattitle">
                            <?=$row['nickname']?>
                        </h1>
                        
                            <script>
                                var chatRoomId = <?=$row['chatroom_id']?>;
                            </script>
                        </div>
                        <div style="margin-right: 20px;">
						<input class="chat_out_btn"  onclick="location.href='/campusmarket/chat/chatroom_out.php?num=<?=$row['chatroom_id']?>'" value="채팅방 나가기" type="button">
                        </div>
                    </div>
                    <div class="chattingbox">
                        <div class="chat-messages-body">
                            <div class="left" style="display: flex; align-items: center;">
                                <a onclick="location.href='/campusmarket/item.php?bid=object&object_num=<?=$row['object_num']?>'"> <img class="chat_pro_img" src="<?=$file_src?>"></a>
                                <div style="margin-left: 10px;">
                                    <p class="chatfirst"><?=$row["object_name"]?></p>
                                    <p style="margin:0 auto; margin-top: 10px;">대화를 시작했습니다.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                <?php
	}
?>
                <div style="width: 592px; height: 176px; position: relative;">
                    <form name="formname" style="user-select: none" method="POST" onsubmit="submitWriteMessageForm(this); return false;">
                        <div class="text-box">
                            <tr>
                                <td>
                                    <textarea class="text-area" autocomplete="off" name="body" placeholder="내용을 입력해주세요."></textarea>
                                    <input class="btnst" type="submit" value="전송"/>
                                </td>
                                <td></td>
                            </tr>
                        </div>
                    </form>
                </div>
            </div>
            <!--chabox-->
        </div>
        <div style="text-align:center; margin:18px;">
            타인에게 개인정보를 알려주지마세요. 캠퍼스마켓은 이로인한 책임을 지지 않습니다.
        </div>
    </body>
</html></div></div><div class="foter"><h3>캠퍼스 마켓</h3><p>사업자 등록번호: 2018-132019 | 대표: 김세혁</p><p>경기도 성남시 중원구 광명로 377 신구대학교 산학관 111호</p><p>고객센터: 031-740-1114</p></div></div></body></html>
    
