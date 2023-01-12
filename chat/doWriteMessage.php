
<?php
require("db_connect.php");
	session_start();
$chatRoomId = $_REQUEST['chatRoomId'];
$body = $_REQUEST['body'];
$memberId = $_SESSION['userId'];

 $query3 = $db->query("select * from member where email = '$memberId'");
 
	while ($row = $query3->fetch()) {
		$selfnum= $row['member_num'];
	};

$query = $db->exec("INSERT INTO chatroomessge
SET regDate = NOW(),
memberId = $selfnum,
chatRoomId = $chatRoomId,
body = '$body'"); 

$resultCode = "S-1";

$rsData = [];
$rsData['msg'] = $msg;
$rsData['resultCode'] = $resultCode;

echo json_encode($rsData);
?>