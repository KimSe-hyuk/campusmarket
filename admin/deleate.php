<?php

require("db_connect.php");
    

    if(isset($_REQUEST["member"])){
        $member=$_REQUEST["member"];
        foreach ($member as $value) {
            $query = $db->exec("delete from member where member_num =$value");
            
         }
    }else if(isset($_REQUEST["board_student"])){
        $board_student=$_REQUEST["board_student"];
        foreach ($board_student as $value) {
            $query = $db->exec("delete from board_student where board_num  =$value");
         }
    }else if(isset($_REQUEST["board_object"])){
        $board_object=$_REQUEST["board_object"];

         for($i=0; $i < count($board_object); $i++){
  
            $query = $db->exec("delete from board_object where object_num   ='$board_object[$i]'");
        }       
    }else if(isset($_REQUEST["board_reports"])){
        $board_reports=$_REQUEST["board_reports"];

         for($i=0; $i < count($board_reports); $i++){
            echo "delete from board_reports where board_report   =$board_reports";
 
            $query = $db->exec("delete from board_reports where object_num   ='$board_reports[$i]'");
        }       
    }
 
 
?>

<script>
  
  location.replace("list.php");
</script>