<?php
    $bid = empty($_REQUEST["bid"]) ? "free" : $_REQUEST["bid"];
    
    $num = $_REQUEST["num"];
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    
    require("db_connect.php");
    $query = $db->exec("delete from board_$bid where num=$num");
                            
    header("Location:list.php?bid=$bid&page=$page");
    exit();
?>