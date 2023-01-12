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
	<link rel="stylesheet" type="text/css" href="/campusmarket/css/index.css">
<link rel="stylesheet" type="text/css" href="/campusmarket/css/item.css">  
<link rel="stylesheet" type="text/css" href="/campusmarket/css/search_result.css">
<link rel="stylesheet" type="text/css" href="/campusmarket/css/student.css">
	<script src="https://code.jquery.com/jquery-3.6.0.slim.js"></script>
	<script type="text/javascript" src="/campusmarket/js/login.js"></script>

<link
    rel="stylesheet"
    href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	
</head>

    <script>
        List2 = [];
    </script>

    <div>
        <?php
        require("db_connect.php");
        //session_start();
//$_SESSION["userId"] = empty($_SESSION["userId"]) ? "" : $_SESSION["userId"];
        $bid = empty($_REQUEST["bid"]) ? "object" : $_REQUEST["bid"];
        $query3 = $db->query("SELECT object_name FROM board_object UNION SELECT board_title FROM board_student "); 
        //$query3 = $db->query("SELECT object_name FROM board_object");
        while ($row = $query3->fetch()) {

        ?>
        <script>
            List2.push('<?= $row['object_name']; ?>'); 
           
        </script>
        <?php
        }
        ?>

    </div>
    <script>

        $(function () {
            $(".searchInput").autocomplete({
                source: List2,
                focus: function (event, ui) {
                    return false;
                },
                minLength: 1,
                delay: 100
            });
        });
    </script>

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


            <script>
                    function Display() {
                        var asd = document.getElementById("itemDiv");
                        var qwe = document.getElementById("studentDiv");
                        var heading1 = document.getElementById("heading1");
                        var heading2 = document.getElementById("heading2");
                        
                        if (asd.style.display == 'block' && qwe.style.display == 'none') {
                            asd.style.display = 'none';
                            qwe.style.display = 'block';
                            heading1.style.color = '#898989';
                            heading2.style.color = '#000000';
                      
                            
                        } else {
                            asd.style.display = 'block';
                            qwe.style.display = 'none';
                            
                            heading1.style.color = '#000000';
                            heading2.style.color = '#898989';
                        }

                    }


                </script>



            <div id="main" style="padding-top: 48px;">
                <div class="center-box" style="    background: #FFFFFF;border-radius: 16px;min-height: 788px;">

                    <?php 
                        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
                        $cou = $db->query("SELECT count(*) as cnt from board_object where object_name LIKE '%$search%' ")->fetchColumn();
                        $cou2=$db->QUERY("SELECT count(*) as cnt FROM board_student where board_title LIKE '%$search%' ")->fetchColumn();
                        $search = $_GET['search'];
                    ?>
                        <h1 style="text-align: center;padding-top: 59px;">"<?= $search ?>" 검색결과</h1>
                        <span id="heading1" style="margin-left:372px; color:#000000;" onclick="javascript:Display();">벼룩시장</span> 
                        <span id="heading2"style="color:#898989" onclick="javascript:Display();">학생공간</span> 
                        
                            
                       
                <div style="display: block;" id="itemDiv">
                            <p style="text-align: center;">
                                <?= $cou ?>개의 결과물을 찾았습니다.
                            </p>
                            <div class="result-box">
                           
                                <?php
                     
                                $query3 = $db->query(
                                	"SELECT * from board_object where object_name like '%$search%' order by regist_date desc"
                                );


                                while ($row = $query3->fetch()) {
	                                if (mb_strlen($row["object_name"]) >= 20) { //mb_strlen("문자열")  문자열 길이 측정
                                		$row["object_name"] = substr($row["object_name"], 0, 20) . '...';
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

                                <ul class="boards" onclick="location.href='item.php?bid=<?=$bid?>&object_num=<?=$row['object_num']?>&page=<?=$page?>&share=<?=$share?>'"><!--&bnum=클릭한글번호-->
                             
                                <div class="<?php if ($row["sale_status"] == 1) {
		    echo 'overview';
	    }?>  ">


<?php if ($row["sale_status"] == 1) { ?>
<p class="overwrite">거래 완료</p>
<?php
	}?>
</div>

                                <li class="board_img"> <!--제품이미지-->
							<img src="<?=$file_src?>">
							</li>
							<li class="item_content">
								<span class="item_name"><?= mb_strimwidth($row["object_name"], 0, 13, "...", 'utf-8'); ?></span><br>
								<span class="item_price"><?=number_format($row["price"])?> 원</span>
							</li>
                                </ul>

                                <?php
	                                
                                }
                                ?>
                            </div>
                            </div>
                            <div style="display: none;" id="studentDiv">
                            <p style="text-align: center;">
                                <?= $cou2?>개의 결과물을 찾았습니다.
								
                            </p>
                            <div class="result-box">
                           
                            <table>
    <tr>
        <th class="board_num"    >번호    </th>
		<th class="board_category"  ></th>
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
    
    require("db_connect.php");

    $query = $db->query("SELECT * from board_student where board_title like '%$search%' order by write_date desc limit $start, $board_numLines");

    while ($row = $query->fetch()) {
?>
    <tr>
        <td><?=$row["board_num"]?></td>
		<td>[<?=$row["board_category"]?>]</td>
        <td style="text-align:left;"><a href="board_view.php?bid=<?=$bid?>&board_num=<?=$row["board_num"]?>&page=<?=$page?>"><?=$row["board_title"]?></a></td>
        <td><?=$row["member_num"]?></td>
		<td><?=$row["write_date"]?></td>
        <td><?=$row["hits"]?></td>
    </tr>
	
<?php    
    }
?>
</table>
</div>
<br>
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