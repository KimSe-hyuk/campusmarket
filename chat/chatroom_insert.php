<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>





<?php
	$object_num =isset($_REQUEST["object_num"]) ? $_REQUEST["object_num"] : "";
	$member_num =isset($_REQUEST["member_num"]) ? $_REQUEST["member_num"] : "";
	$reg_date = date("Y-m-d H:i:s");

	require("db_connect.php");
	session_start();
 
		
	$query3 = $db->query("
select * from member where email = '$_SESSION[userId]'
");
 
	while ($row = $query3->fetch()) {
		$buyer_num= $row['member_num'];
	}
	$date=   date("Y-m-d H:i:s");
	$db->exec("insert into chatroom (seller_num,object_num,buyer_num,regist_date) 
	values('$member_num','$object_num','$buyer_num','$reg_date')"); 
	
	echo '<script>
            location.replace("chat.php");
          </script>';
?>
</body>
</html>
