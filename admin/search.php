<!DOCTYPE html>
<html lang="ko">

    <head>
        <meta charset="utf-8">

        <link rel="stylesheet" type="text/css" href="/campusmarket/css/style.css">
        <link rel="stylesheet" type="text/css" href="/campusmarket/css/index.css">
        <link rel="stylesheet" type="text/css" href="/campusmarket/css/item.css">  
        <link rel="stylesheet" type="text/css" href="/campusmarket/css/search_result.css">
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
                        <a href="/campusmarket/index.php"><img src="image/logo.png"/></a>
                    </span>
                    <div class="nav-box">
                        <ul>
                            <li>&nbsp;</li>
                            <li>
                                <a href="/campusmarket/itemlist.php">????????????</a>
                            </li>
                            <li>
                                <a href="#">????????????</a>
                            </li>
                            <li>
                                <a href="#">??????</a>
                            </li>
                            <li>&nbsp;</li>
                        </ul>
                    </div>
                    <div style="float:right;">

                        <a class="logchat" href="/"><img class="chat_btn" src="image/chat.png"/></a>
                        <a class="logchat" href="/campusmarket/member/login_main.php"><img class="login_btn" src="image/user.png"/></a>

                        <form class="search-box" action="search_result.php" method="get">
                            <input id="searchInput" name="" type="text" placeholder="??????" size="10">
                            <input class="Vector" name="button" type="image" src="image/Vector.png">

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



            <div id="main">
                <div class="center-box">

                    <?php 
                        $search = isset($_REQUEST["search"]) ? $_REQUEST["search"] : "";
                        $cou = $db->query("SELECT count(*) as cnt from board_object where object_name LIKE '%$search%' ")->fetchColumn();
                        $cou2=$db->QUERY("SELECT count(*) as cnt FROM board_student where board_title LIKE '%$search%' ")->fetchColumn();
                        $search = $_GET['search'];
                    ?>
                        <h1 style="text-align: center;padding-top: 59px;">"<?= $search ?>" ????????????</h1>
                        <span id="heading1" style="margin-left:372px; color:#000000;" onclick="javascript:Display();">????????????</span> 
                        <span id="heading2"style="color:#898989" onclick="javascript:Display();">????????????</span> 
                        
                            
                       
                <div style="display: block;" id="itemDiv">
                            <p style="text-align: center;">
                                <?= $cou ?>?????? ???????????? ???????????????.
                            </p>
                            <div class="result-box">
                           
                                <?php
                     
                                $query3 = $db->query(
                                	"SELECT * from board_object where object_name like '%$search%' order by regist_date desc"
                                );


                                while ($row = $query3->fetch()) {
	                                if (mb_strlen($row["object_name"]) >= 20) { //mb_strlen("?????????")  ????????? ?????? ??????
                                		$row["object_name"] = substr($row["object_name"], 0, 20) . '...';
	                                }
                                ?>

                                <ul class="boards" onclick="location.href='item.php?bid=<?=$bid?>&object_num=<?=$row['object_num']?>&page=<?=$page?>&share=<?=$share?>'"><!--&bnum=??????????????????-->
                             
                                    <li class="board_img">
                                        <!--???????????????-->
                                        <?php $photoArr = explode(",", $row['object_img']); ?>
                                        <img src='/campusmarket/image/<?= $photoArr[0] ?>'/>
                                    </li>

                                    <li class="item_content">
                                        <span class="item_name">
                                            <?= $row["object_name"] ?>
                                        </span><br>
                                        <span class="item_price">
                                            <?= number_format($row["price"]) ?>
                                            ???
                                        </span>
                                    </li>
                                </ul>

                                <?php
	                                
                                }
                                ?>
                            </div>
                            </div>
                            <div style="display: none;" id="studentDiv">
                            <p style="text-align: center;">
                                <?= $cou2?>?????? ???????????? ???????????????.
								
                            </p>
                            <div class="result-box">
                           
                            <table>
    <tr>
        <th class="board_num"    >??????    </th>
		<th class="board_category"  >?????????    </th>
        <th class="board_title"  >??????    </th>
		<th class="member_num"  >?????????    </th>
        <th class="write_date">????????????</th>
        <th class="hits"      >??????  </th>
    </tr>

<?php
    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];
    
    $board_numLines = 14; // ????????? ??? ???????????? ?????? ?????? ??? (?????? ???)
    $board_numLinks = 4; // ??? ???????????? ????????? ????????? ?????? ??????
    
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    $start = ($page - 1) * $board_numLines;
    
    require("db_connect.php");

    $query = $db->query("SELECT * from board_student where board_title like '%$search%' order by write_date desc limit $start, $board_numLines");

    while ($row = $query->fetch()) {
?>
    <tr>
        <td><?=$row["board_num"]?></td>
		<td><?=$row["board_category"]?></td>
        <td style="text-align:left;"><a href="board_view.php?bid=<?=$bid?>&board_num=<?=$row["board_num"]?>&page=<?=$page?>"><?=$row["board_title"]?></a></td>
        <td><?=$row["member_num"]?></td>
		<td><?=$row["write_date"]?></td>
        <td><?=$row["hits"]?></td>
    </tr>
	
<?php    
    }
?>
</table>
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

<div style="width:680px; text-align:center;">
<?php    
    if ($firstLink > 1) {
?>
        <a href="board_list.php?bid=<?=$bid?>&page=<?=$firstLink - $board_numLinks?>">??????</a>
<?php    
    }
    
    for ($i = $firstLink; $i <= $lastLink; $i++) {
?>    
        <a href="board_list.php?bid=<?=$bid?>&page=<?=$i?>"><?=($i == $page) ? "<u>$i</u>" : $i?></a>
<?php
    }
    
    if ($lastLink < $board_numPages) {
?>
        <a href="board_list.php?bid=<?=$bid?>&page=<?=$firstLink + $board_numLinks?>">??????</a>
<?php
    }
?>       
</div> 


                            </div>
</div>


                            

	









                    <div class="foter"></div>

                </div>

            </body>

        </html>