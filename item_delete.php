<?php
  session_start();

  $userName = $_SESSION["userName"];
  $userId = $_SESSION["userId"];

  $object_num = $_REQUEST["object_num"];
  
  require("db_connect.php");
  $query = $db->exec("delete from file where f_num = $object_num");
  $query = $db->exec("delete from board_object where object_num = $object_num");
?>
<script>alert("게시물이 삭제되었습니다.");
location.replace('itemlist.php');
</script>
