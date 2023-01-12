<?php
	session_start();
	unset($_SESSION["userId"]);
	unset($_SESSION["userName"]);
	unset($_SESSION["userPw"]);
	unset($_SESSION["userNum"]);
	unset($_SESSION["secession"]);
	unset($_SESSION["university_num"]);
	 
	 
	 
	//login_main.php로 이동
	header("Location:/campusmarket/index.php");
	exit();
?>
