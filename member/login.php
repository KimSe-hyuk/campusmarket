
<?php
   require("db_connect.php");
    
    $id = $_REQUEST["id"];
    $pw = $_REQUEST["pw"];
 
    if ($id && $pw) {
		$query = $db->query("select * from member where email='$id' and pw='$pw'");
		 if ($row = $query->fetch()) {
			 if(1==$row["secession"]){
			 echo '<script>
            alert("신고 누적으로 아이디 정지.");
            location.replace("../index.php");
          </script>';
		  exit;
			 }
		 }
        $query = $db->query("select * from member where email='$id' and pw='$pw'");
        if ($row = $query->fetch()) {
            session_start();
            
            $_SESSION["userId"] = $row["email"];
            $_SESSION["userName"] = $row["nickname"];
            $_SESSION["userNum"]	=		$row["member_num"];
            $_SESSION["secession"]	=		$row["secession"];
            $_SESSION["university_num"]	=		$row["university_num"];
            if ($row["id"] == 12345678) {
              //header("Location:./admin/admin.php");
              //exit;S
            }else{
			echo '<script>
            alert("로그인.");
            location.replace("../index.php");
        
          </script>';
            }
        }
        echo '<script>
            alert("등록되지 않은 계정입니다.");
            location.replace("login_main.php");
          </script>';
      } else {
          echo '<script>
              alert("아이디 또는 비밀번호가 입력되지 않았습니다.");
              location.replace("login_main.php");
            </script>';
      }
?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

  <script>
    alert('아이디 또는 비밀번호가 틀렸습니다.');
    history.back();
  </script>

</body>
</html>


