<?php
require("db_connect.php");
     $join_email = $_REQUEST["join_email"];
     $join_email2 = $_REQUEST["join_email2"];
     $page = $_REQUEST["page"];

    $send_msg = ""; //내용
    $mail_title = ""; //메일 제목
    $alter_msg = "";

  $mail_title = "캠퍼스 마켓 회원가입 인증번호";
  $send_msg = sprintf('%06d',rand(000000,999999));
  $alert_msg = "<script>
        alert('입력된 이메일로 인증번호가 전송되었습니다.');
        window.opener.document.getElementById('sended_verification_code').value = ".$send_msg .";
        window.close();
        </script>";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true); // the true param means it will throw exceptions on errors, which we need to catch $mail->IsSMTP(); // telling the class to use SMTP
$mail->IsSMTP(); // telling the class to use SMTP
try {
$mail->CharSet = "utf-8"; //한글이 안깨지게 CharSet 설정
$mail->Encoding = "base64";
$mail->Host = "smtp.gmail.com"; // email 보낼때 사용할 서버를 지정
$mail->SMTPAuth = true; // SMTP 인증을 사용함
$mail->Port = 465; // email 보낼때 사용할 포트를 지정
$mail->SMTPSecure = "ssl"; // SSL을 사용함
$mail->Username = "2018132012@g.shingu.ac.kr"; // Gmail 계정
$mail->Password = "ww970714**"; // 패스워드
$mail->SetFrom('12345678@gmail.com', '캠퍼스마켓'); // 보내는 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
$mail->AddAddress($join_email); // 받을 사람 email 주소와 표시될 이름 (표시될 이름은 생략가능)
$mail->Subject = $mail_title; // 메일 제목
$mail->Body = $send_msg; // 내용
$mail->Send(); // 발송

echo $alert_msg;

}
catch (phpmailerException $e) {
  echo '<script>
  alert("이메일이 없습니다.");
  window.close();
</script>';
} catch (Exception $e) {
  echo '<script>
  alert("이메일이 없습니다.");
  window.close();
</script>';}

 ?>
