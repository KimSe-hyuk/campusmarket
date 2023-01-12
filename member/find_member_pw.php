
<?php

require("db_connect.php");

	$useremail = $_REQUEST["join_email"];
	$useremail2 = $_REQUEST["join_email2"];
	$join_verification_code = $_REQUEST["join_verification_code"];

	if($useremail){		 
			if ($sended_verification_code ="" ){
				echo "<script>
				alert('이메일 인증이 필요합니다.');
				location.replace('find_member_pw_form.php');
				</script>";
					 
			}
			if ($_REQUEST["sended_verification_code"] != $join_verification_code) {
				echo "<script>
				alert('인증번호가 일치하지 않습니다.');
                location.replace('find_member_pw_form.php');
				</script>";
					
			}
		
		$e_result = $db->query("select count(*) from member where email like '%$useremail$useremail2%'")->fetchColumn();
		if($e_result >= '1'){
				$result = $db->query("select pw from member where email like'%$useremail$useremail2%'");
				while ($row = $result->fetch()){
					echo "<script>
					alert('현재비밀번호는$row[0]입니다.');
					alert('로그인화면으로이동합니다.');
					location.replace('login_main.php');
					</script>";
				  }
					}else{
			echo "<script>
				alert('등록되지않은계정입니다.');
				location.replace('find_member_pw_form.php');
				</script>";
		}
	}else { //빈칸있을시

	echo "<script>
	alert('빈칸을 입력해주세요');
	location.replace('find_member_pw_form.php');
	</script>";
	}
			

?>
