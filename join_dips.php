<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php
session_start();
	require("db_connect.php");
  	$object_num =isset($_REQUEST["object_num"]) ? $_REQUEST["object_num"] : "";

	$dips_date =   date("Y-m-d H:i:s");

  $query3 = $db->query("select *  from dips where member_num=$_SESSION[userNum]");

  while ($row = $query3->fetch()) {
      if($row['object_num']==$object_num){
        $db->query("delete from dips where member_num=$_SESSION[userNum] and object_num=$object_num");
        echo "
            <script>
                alert(\"찜 삭제가 되었습니다.\");
                history.back();
            </script>
        ";
		 exit;
	  }
	  
  }
  
  

$db->exec("insert into dips(member_num,object_num,dips_date) values('$_SESSION[userNum]',$object_num,'$dips_date')");
	echo "
            <script>
                alert(\"찜 추가가 되었습니다.\");
                history.back();
            </script>
        ";
  
  
?>



</body>
</html>
