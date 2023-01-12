<?php
    $num = $_REQUEST["num"];
  
    require("db_connect.php");
    $query = $db->exec("delete from chatroom where chatroom_id =$num");
                      
    header("Location:chat.php");
    exit();
?>