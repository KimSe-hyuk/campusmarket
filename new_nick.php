<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php

	$new_nick =isset($_REQUEST["new_nick"]) ? $_REQUEST["new_nick"] : "";

	require("db_connect.php");
	session_start();
	$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
	$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];
	 $n_result = $db->query("select count(*) from member where nickname='$new_nick'")->fetchColumn();
	if(!($new_nick)) {//하나라도 빈칸 있으면
		
?>
	<script>
		alert('빈칸 없이 입력해야 합니다.');
		history.back();
	</script>

<?php			
		}else if($n_result >= '1'){
			?>
				<script>
		alert('닉네임 중복.');
		history.back();
	</script>
	<?php
		}else{
		$db->exec("update member set nickname='$new_nick' where email='$_SESSION[userId]'");
		$db->exec("update board_reports set reported_person='$new_nick' where reported_person='$_SESSION[userName]'");
		 
		$_SESSION["userName"] = $new_nick;
?>
	<script>
		alert('닉네임이 변경되었습니다.');
		location.href="myinfo.php";
	</script>	
	<?php
	}
	
	?>
</body>
</html>
