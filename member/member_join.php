<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<?php          
require("db_connect.php");
    $pw   = $_REQUEST["join_pw"];
    $pw2   = $_REQUEST["join_pw2"];
    $nick = $_REQUEST["join_name"];
	   $email = $_REQUEST["join_email"];
     $email2 = $_REQUEST["join_email2"];
     $email5 = substr($email2, 1); 
     $sended_verification_code = $_REQUEST["sended_verification_code"];
     $join_verification_code = $_REQUEST["join_verification_code"];
 
     $pre_page = "member_join_form.php?join_id=$id&join_name=$nick&join_email=$email&join_email2=$email5&sended_verification_code=$sended_verification_code&join_verification_code=$join_verification_code";
        if ($pw && $nick && $email) {
          if ($sended_verification_code == "") {
            ?>
                      <script>
                          alert('이메일 인증이 필요합니다.');
                          location.replace("<?=$pre_page?>");
                      </script>
            <?php
          }
          if ($sended_verification_code != $join_verification_code) {
            ?>
                      <script>
                          alert('인증번호가 일치하지 않습니다.');
                          location.replace("<?=$pre_page?>");
                      </script>
            <?php
          }
         
          if ( $pw  != $pw2) {
            ?>
                <script>
                    alert('비밀번호 중복체크 하시오);
                    location.replace("<?=$pre_page?>");
                </script>
            <?php
          }

			$email = $_REQUEST["join_email"];
          $email3 = substr($email2, 3); 
          $reg_date = date("Y-m-d H:i:s");
         
          $member_img="user_img.png";
          $n_result = $db->query("select count(*) from member where nickname='$nick'")->fetchColumn();
          $e_result = $db->query("select count(*) from member where email='$email$email2'")->fetchColumn();
          $university= $db->query("SELECT university_num FROM university WHERE university_page LIKE '%$email3%'");  
          while ($row = $university->fetch()){
            $university_num=$row[university_num];
          }
           if ($n_result >= '1') { 
            ?>
                <script>
                    alert('이미 등록된 닉네임 입니다.');
                    location.replace("<?=$pre_page?>");
                </script>
            <?php
          }elseif ($e_result >= '1') {
          ?>
            <script>
            alert('이미 등록된 이메일 입니다.');
            location.replace("<?=$pre_page?>");
        </script>
        <?php
          }else{

          $query = $db->exec("insert into member (email,pw,nickname,regist_date,member_img,university_num)values('$email$email2', '$pw', '$nick', '$reg_date','$member_img','$university_num')");
?>
              <script>
                  alert('가입이 완료되었습니다.');
                  location.replace('login_main.php');
              </script>
<?php
          }

      } else {
?>
        <script>
            alert('빈칸 없이 입력해야 합니다.');
            location.replace("<?=$pre_page?>");
        </script>
<?php
      }
 ?>

</body>
</html>
