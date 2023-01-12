<?php

session_start();

$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];
    
    $board_num = $_REQUEST["board_num"];
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    
     $board_title = $_REQUEST["board_title"];
	$board_contents = $_REQUEST["board_contents"];
    $board_category = $_REQUEST["board_category"];

    if ($board_title && $board_contents && $board_category) {
        require("db_connect.php");

        $write_date = date("Y-m-d H:i:s");
        

        
        $query = $db->exec("update board_$bid set 
                            board_title='$board_title', board_contents='$board_contents', write_date='$write_date'
                            where board_num=$board_num");
                            
        header("Location:board_view.php?bid=$bid&board_num=$board_num&page=$page");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<script>
    alert('모든 입력란에 값이 입력되어야 합니다.');
    history.back();
</script>

</body>
</html>
