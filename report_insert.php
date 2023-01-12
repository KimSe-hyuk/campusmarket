<?php
session_start();
require("db_connect.php");
$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
$userNum = empty( $_SESSION["userNum"]) ? '' :  $_SESSION["userNum"];

    $bid = empty($_REQUEST["bid"]) ? "reports" : $_REQUEST["bid"];
    $board_num = empty($_REQUEST["board_num"]) ? "" : $_REQUEST["board_num"];
    $object_num = empty($_REQUEST["object_num"]) ? "" : $_REQUEST["object_num"];
	
    $reported_person = empty($_REQUEST["reported_person"]) ? "" : $_REQUEST["reported_person"];
	$board_contents = $_REQUEST["board_contents"];
	$board_category = $_REQUEST["board_category"];
    $report_title = $_REQUEST["report_title"];

 
    if ($board_contents && $report_title) {
        require("db_connect.php");

        $write_date = date("Y-m-d H:i");

        $query = $db->exec("insert into board_$bid (report_title, reporting_person, reported_person, board_num, object_num, board_contents, write_date, board_category)
                            values ('$report_title', '$userNum', '$reported_person', '$board_num' ,'$object_num','$board_contents', '$write_date', '$board_category')");
                            
        header("Location:report_list.php?bid=$bid");
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
