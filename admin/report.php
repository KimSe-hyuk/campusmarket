<?php
 require("db_connect.php");
 $reports=$_REQUEST["board_reports"];


 

  foreach ($reports as $value) {
 
			  $query = $db->exec(" UPDATE board_reports SET report_check=1 WHERE board_report=$value");

			   $query = $db->query("SELECT member_num FROM board_reports LEFT JOIN member ON board_reports.reported_person=member.nickname  WHERE board_report=$value");
			   if ($row = $query->fetch()) {
				   $name=$row[member_num];

				     $query = $db->exec(" UPDATE member SET reported=reported+1 WHERE member_num= $name");
 
			   }
			 
        }
		  $query = $db->query("SELECT * FROM board_reports LEFT JOIN member ON board_reports.reported_person=member.nickname  WHERE board_report=$value");
			   if ($row = $query->fetch()) {
				   $names=$row[reported];
					if(3<=$names)
				     $query = $db->exec(" UPDATE member SET secession=1 WHERE member_num= $name");
 
			   }
			   header("Location:list.php");                         
 
			   exit();
 
?>

