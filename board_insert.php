<?php

session_start();
require("db_connect.php");
$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
$userNum = empty( $_SESSION["userNum"]) ? '' :  $_SESSION["userNum"];

    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];
    
    $board_title = $_REQUEST["board_title"];
	$board_contents = $_REQUEST["board_contents"];
	$board_category = $_REQUEST["board_category"];
		$board_category = $_REQUEST["board_category"];

    if ($board_title && $board_contents && $board_category) {
        require("db_connect.php");

        $write_date = date("Y-m-d H:i:s");

        $query = $db->exec("insert into board_$bid (member_num, board_title, board_contents, write_date, board_category, hits)
                            values ('$userNum', '$board_title', '$board_contents', '$write_date', '$board_category', 0)");
                            
        header("Location:board_list.php?bid=$bid");
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
