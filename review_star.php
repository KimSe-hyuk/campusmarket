<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
session_start();
	if(!$_SESSION["userId"]){
		?>
	<script>
		alert('로그인 후 이용 가능');
		history.back();
	</script>
<?php
	}

	$tr =isset($_REQUEST["textreview"]) ? $_REQUEST["textreview"] : "";

	$board_num =isset($_REQUEST["board_num"]) ? $_REQUEST["board_num"] : "";
	require("db_connect.php");

	if(!($tr)) {
?>
	<script>
		alert('별점과 리뷰가 빈 곳 없이 입력해야 합니다.');
		history.back();
	</script>
<?php
	}else{

		$count=$db->query("select count(*) from board_student_reply")->fetchColumn()+1;
			$date =   date("Y-m-d H:i:s");

	$re=$db->query("select count(*) from board_student_reply where board_num=$board_num and member_num=$_SESSION[userNum]")->fetchColumn();
		
if($re>0){

 $db->exec("update board_student_reply set  
								write_date = '".$date."'	,
								member_num = '".$_SESSION['userNum']."'	,
								reply_contents = '".$tr."', 
								board_num = '".$board_num."'	
						where board_num='".$board_num."' and member_num='".$_SESSION['userNum']."'");
}else{

$db->exec("insert into board_student_reply(
		  write_date, member_num, reply_contents, board_num)
	values('$date','$_SESSION[userNum]','$tr','$board_num')");
	
}
 echo "
      <script>
          alert('리뷰가 작성되었습니다');
          location.href = 'board_view.php?board_num=$board_num';
      </script>
  ";
}
?>
</body>
</html>
