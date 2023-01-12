<?php

require("db_connect.php");

    if(isset($_REQUEST["nick"])&&isset($_REQUEST["report"])&&isset($_REQUEST["secion"])){
		$a=$_REQUEST["member"];
		$query = $db->exec("UPDATE member SET nickname='$_REQUEST[nick]',reported='$_REQUEST[report]',secession='$_REQUEST[secion]' WHERE member_num='$a[0]'");
		header("Location:myList.php?member_num='$a[0]'");                         
		exit();
	}

    if(isset($_REQUEST["nickname"])){
       $nickname=$_REQUEST["nickname"];
	   $nick = [];
       $query = $db->query("SELECT nickname FROM member  ");
			   while ($row = $query->fetch()) {
					array_push( $nick, $row[nickname]);
			   }
		$a=0;
        foreach ($nickname as $value) {
			$query = $db->exec("UPDATE member SET nickname='$value' WHERE nickname='$nick[$a]'");
			$db->exec("update board_reports set reported_person='$value' where reported_person='$nick[$a]'");
			$a=$a+1;
        }
    }else if(isset($_REQUEST["board_student"])){
        $board_student=$_REQUEST["board_student"];
        foreach ($board_student as $value) {
            $query = $db->exec("delete from board_student where board_num  =$value");
         }
    }else if(isset($_REQUEST["board_object"])){
        $board_object=$_REQUEST["board_object"];

         for($i=0; $i < count($board_object); $i++){
            echo "delete from board_object where object_num   =$board_object";
 
            $query = $db->exec("delete from board_object where object_num   ='$board_object[$i]'");
        }       
    }
 
   header("Location:list.php");                         
 
    exit();
?>