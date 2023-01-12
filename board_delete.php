<?php

session_start();

$userName = empty($_SESSION["userName"]) ? '로그인/회원가입' : $_SESSION["userName"];
$userId = empty($_SESSION["userId"]) ? '' : $_SESSION["userId"];

    $bid = empty($_REQUEST["bid"]) ? "student" : $_REQUEST["bid"];
    
    $board_num = $_REQUEST["board_num"];
    $page = empty($_REQUEST["page"]) ? 1 : $_REQUEST["page"];
    
    require("db_connect.php");
    $query = $db->exec("delete from board_$bid where board_num=$board_num");
                            
    header("Location:board_list.php?bid=$bid&page=$page");
    exit();
?>