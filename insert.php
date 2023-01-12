<?php
    $bid = empty($_REQUEST["bid"]) ? "free" : $_REQUEST["bid"];
    
    $title = $_REQUEST["title"];
    $writer = $_REQUEST["writer"];
    $content = $_REQUEST["content"];

    if ($title && $writer && $content) {
        require("db_connect.php");

        $regtime = date("Y-m-d H:i:s");
        
        $query = $db->exec("insert into board_$bid (writer, title, content, regtime, hits)
                            values ('$writer', '$title', '$content', '$regtime', 0)");
                            
        header("Location:list.php?bid=$bid");
        exit();
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
</head>
<body>

<script>
    alert('모든 입력란에 값이 입력되어야 합니다.');
    history.back();
</script>

</body>
</html>
