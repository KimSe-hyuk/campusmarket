<?php
session_start();
   $userName = $_SESSION["userName"];
   $userId = $_SESSION["userId"];
   $userNum = $_SESSION["userNum"];

     $save_path="./files/".$userNum."/";

     if(!is_dir($save_path)){
       mkdir($save_path, 0777, true);
     };
	
     $object_name = $_REQUEST["object_name"];
     $price = $_REQUEST["price"];
     $object_contents = $_REQUEST["object_contents"];	
     $object_category = $_REQUEST["object_category"];
  
       if($price==0){
          $share='나눔';
          $m1='무료';
       }else{
          $share=  $_REQUEST["share"];
       }

       
       $regist_date = date("Y-m-d H:i:s");
	
    if ($object_name && ($price || $m1) && $object_contents ) {
        require("db_connect.php");
        if (!is_numeric($price)) {
?>
            <script>
              alert("가격은 숫자만 입력할 수 있습니다.");
              location.replace('write3.php?share=<?=$share?>&object_category=<?=$object_category?>');
            </script>
<?php
          }

     $countfiles = isset($_FILES['img_upload']['name'])?count($_FILES['img_upload']['name']) : 0;

     // for($i=0; $i<=$countfiles; $i++){
     // $img_tmp[$i] = $_FILES["img_upload"]["tmp_name"][$i];
        // $img_name[$i] = $_FILES["img_upload"]["name"][$i];
        // $img_type[$i] = $_FILES["img_upload"]["type"][$i];
        // $img_error[$i] = $_FILES["img_upload"]["error"][$i];
      // }

 	  $query = $db->exec("insert into board_object (object_name, object_contents, price, object_category, share, member_num, regist_date) 
			values ('$object_name', '$object_contents', '$price', '$object_category', '$share', '$userNum', '$regist_date')");


        $num = $db->query("select object_num from board_object where member_num = '$userNum' and regist_date = '$regist_date'");
       if (json_encode($_FILES['img_upload']['name']) != '[""]'){
         if ($row = $num->fetch()){
          for($i=0; $i<$countfiles; $i++){
            $img_tmp = $_FILES["img_upload"]["tmp_name"][$i];
            $img_name = $_FILES["img_upload"]["name"][$i];

           
                move_uploaded_file($img_tmp, "./files/".$userNum."/$img_name");
                $query = $db->exec("insert into file (fm_num, f_img, f_num, tmp_name) values ($userNum, '{$img_name}', ".$row['object_num'].", '{$img_tmp}')");
            
            }
          }
        }

   
   ?>
        <script>
          alert("업로드가 완료되었습니다.");
          location.replace("write4.php");
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
    
    location.replace('write3.php?share=<?=$share?>&object_category=<?=$object_category?>');
</script>

</body>
</html>
