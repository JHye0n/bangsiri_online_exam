<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/lib/userlib.php';

$session = $_SESSION['name'];

$is_login = login_check($session);

if(!$is_login){
  die("<script>alert('로그인이 필요한 서비스 입니다.'); location.href='index'; </script>");
}

$time = time_check();
$date = date('Y-m-d H:i:s');
$start_time = $time['start_time'];
$end_time = $time['end_time'];

if($start_time >= $date){
    die("<script>alert('시험 시작 시간이 아닙니다. 2020-06-18 18:00'); location.href='welcome'; </script>");
}

if($end_time <= $date){
    die("<script>alert('시험이 종료되었습니다.'); location.href='welcome'; </script>");
}

if($is_login['submit'] === '제출'){
    die("<script>alert('이미 시험을 제출 하셨습니다.'); location.href='welcome'; </script>");
}

$file = $_POST['file'];
$fname = $_FILES['file']['name'];

require_once "PHPMailer/src/PHPMailer.php";
require_once "PHPMailer/src/SMTP.php";
require_once "PHPMailer/src/Exception.php";

$mail = new PHPMailer(true);

try {
    $mail -> SMTPDebug = 0;
    $mail -> isSMTP();

    $mail -> Host = "smtp.naver.com";
    $mail -> SMTPAuth = true;
    $mail -> Username = "****";
    $mail -> Password = "****";
    $mail -> SMTPSecure = "ssl";
    $mail -> Port = 465;
    $mail -> CharSet = "utf-8";
    $mail -> setFrom("****", $is_login['name']);
    $mail -> addAddress("****");
    $mail -> addattachment($_FILES['file']['tmp_name'],$fname);
    $mail -> isHTML(true);
    $mail -> Subject = "$is_login[name] 신입생 시험 결과 제출 합니다.";
    $mail -> Body = "$is_login[name] 신입생 시험 결과 제출 합니다.";
    $mail -> send();

    $submit = "제출";

    updateuser($submit, $session);
    
    echo "<script>alert('시험 제출이 완료 되었습니다.'); location.href='welcome'; </script>";

} catch (Exception $e) {
    die("<script>alert('오류가 발생하였습니다'); location.href='welcome'; </script>");
}
?>