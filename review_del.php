<?php
session_start();
require("db_connect.php");

$board_num = $_REQUEST["board_num"];

$db->query("delete from board_student_reply where member_num='$_SESSION[userNum]' and board_num=$board_num");


echo "
    <script>
        alert(\"리뷰가 삭제되었습니다.\");
        history.back();
    </script>
";
?>