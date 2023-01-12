<?php
require("db_connect.php");


    $object_num = $_REQUEST["object_num"];
    $object_name = $_REQUEST["object_name"];
	$object_category = $_REQUEST["object_category"];
  
   
	  $query = $db->exec("update board_object set 
                            sale_status='1'
                            where object_num=$object_num");
                            ?>			
        <script>
            alert("거래 완료로 변경 되었습니다.");
            location.replace("itemlist.php");
          </script>
   

