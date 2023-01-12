<?php

session_start();

$userName = $_SESSION["userName"];
$userId = $_SESSION["userId"];
$userNum = $_SESSION["userNum"];

$save_path="./files/".$userNum."/";

if(!is_dir($save_path)){
  mkdir($save_path, 0777, true);
};

    $object_num = $_REQUEST["object_num"];
    $object_name = $_REQUEST["object_name"];
	$price = $_REQUEST["price"];
    $object_contents = $_REQUEST["object_contents"];	

	$object_category = $_REQUEST["object_category"];

    $uploaded_img = empty($_POST["uploded_img"]) ? null : $_POST["uploded_img"];
    $uploded_img_tmp =  empty($_POST["uploded_img_tmp"]) ? null : $_POST["uploded_img_tmp"];


     if($price==0){
        $share='나눔';
        $m1='무료';
     }else{
        $share= $_POST['share'];
     }

    if ($object_name && ($price || $m1) && $object_contents) {
        if (!is_numeric($price)) {
            ?>
            <script>
              alert("가격은 숫자만 입력할 수 있습니다.");
              location.replace('write3.php');
            </script>
            <?php
          }

        require("db_connect.php");

        $regist_date = date("Y-m-d H:i:s");
	
	    $query = $db->exec("delete from file where f_num = $object_num");
        if($uploaded_img != null) {
          for($i=0; $i<count($uploaded_img); $i++){
          $query = $db->exec("insert into file (fm_num, f_img, f_num, tmp_name) values ($userNum, '$uploaded_img[$i]', $object_num, '$uploded_img_tmp[$i]')");
          }
        }

        if (json_encode($_FILES['img_upload']['name']) != '[""]'){
        $countfiles = isset($_FILES['img_upload']['name'])?count($_FILES['img_upload']['name']) : 0;

        for($i=0; $i<$countfiles; $i++){
           $img_tmp = $_FILES["img_upload"]["tmp_name"][$i];
           $img_name = $_FILES["img_upload"]["name"][$i];
           $img_type = $_FILES["img_upload"]["type"][$i];
           $img_error = $_FILES["img_upload"]["error"][$i];
           echo $img_tmp;
           echo $img_name;
           echo $img_type;
           echo $img_error;
             move_uploaded_file($img_tmp, "./files/".$userNum."/$img_name");
             $query = $db->exec("insert into file (fm_num, f_img, f_num, tmp_name) values ($userNum, '{$img_name}', $object_num, '{$img_tmp}')");
         }
       }

	  $query = $db->exec("update board_object set 
                            object_name='$object_name', object_contents='$object_contents', price='$price', object_category='$object_category', share='$share', regist_date='$regist_date'
                            where object_num=$object_num");
                            ?>			
        <script>
            alert("게시물 수정이 완료되었습니다.");
            location.replace("item.php?bid=object&object_num=<?=$object_num?>");
          </script>
        <?php
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
