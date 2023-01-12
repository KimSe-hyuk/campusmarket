
<?php
require("db_connect.php");
	session_start();
$chatRoomId = $_REQUEST['chatRoomId'];
$from = $_REQUEST['from'];
 
   	$query3 = $db->query("
select * from member where email = '$_SESSION[userId]'
");
 
	while ($row = $query3->fetch()) {
		$selfnum= $row['member_num'];
	}

$query3 = $db->query("SELECT CRM.*,
M.nickname,M.regist_date,M.member_img   
FROM chatroomessge AS CRM
LEFT JOIN member AS M
ON CRM.memberId =  M.member_num
WHERE CRM.chatRoomId  = '{$chatRoomId}'
AND CRM.id > '{$from}'
ORDER BY CRM.id ASC ");  
$chatRoomMessages = [];

while ( $chatRoomMessage = $query3->fetch(PDO::FETCH_ASSOC) ) {
    $chatRoomMessages[] = $chatRoomMessage;
}
 
$rsData['messages'] = $chatRoomMessages;

echo json_encode($rsData);
?>

 